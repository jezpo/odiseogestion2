<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\Datatables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update role', ['only' => ['update','edit']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::all()->map(function ($role) {
                $actions = [];
                $actions[] = '<a href="'.url('roles/'.$role->id.'/give-permissions').'" class="btn btn-warning"><i class="bi bi-shield-shaded"></i> Agregar / Editar Permiso de Rol</a>';
                if (auth()->user()->can('update role')) {
                    $actions[] = '<a href="'.url('roles/'.$role->id.'/edit').'" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</a>';
                }
                if (auth()->user()->can('delete role')) {
                    $actions[] = '<a href="'.url('roles/'.$role->id.'/delete').'" class="btn btn-danger mx-2"><i class="bi bi-trash"></i> Eliminar</a>';
                }
                
                
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'action' => implode(' ', $actions)
                ];
            });
            return response()->json(['data' => $roles]);
        }

        // Si no es una solicitud AJAX, renderizamos la vista como antes
        $roles = Role::all();
        return view('role-permission.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('role-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status','Role Created Successfully');
    }

    public function edit(Role $role)
    {
        return view('role-permission.role.edit',[
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status','Role Updated Successfully');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status','Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view('role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status','Permissions added to role');
    }
}
