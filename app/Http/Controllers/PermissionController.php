<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\Datatables;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permission', ['only' => ['index']]);
        $this->middleware('permission:create permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:update permission', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    /*public function index()
    {
        $permissions = Permission::get();
        return view('role-permission.permission.index', ['permissions' => $permissions]);
    }*/
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permissions = Permission::all();
            return DataTables::of($permissions)
                ->addColumn('action', function ($permission) {
                    return '<a href="' . route('permissions.edit', $permission->id) . '" class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i> Editar</a>
                            <button class="btn btn-danger btn-sm delete-permission" data-id="' . $permission->id . '"><i class="bi bi-trash-fill"></i> Eliminar</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('role-permission.permission.index');
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Updated Successfully');
    }

    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status', 'Permission Deleted Successfully');
    }
}
