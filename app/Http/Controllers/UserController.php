<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\Datatables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all()->map(function ($user) {
                $roles = $user->roles->pluck('name')->implode(', ');
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'ci' => $user->ci,
                    'email' => $user->email,
                    'roles' => $roles,
                    'action' => '<a href="' . url('users/' . $user->id . '/edit') . '" class="btn btn-success"><i class="far fa-lg fa-fw m-r-10 fa-edit"></i> Editar</a>'
                        . (auth()->user()->can('delete user') ? '<a href="' . url('users/' . $user->id . '/delete') . '" class="btn btn-danger mx-2"><i class="fas fa-lg fa-fw m-r-10 fa-trash-alt"></i> Eliminar</a>' : ''),
                ];
            });
            return response()->json(['data' => $users]); // Cambiado 'users' a 'data'
        }

        // Si no es una solicitud AJAX, renderizamos la vista como antes
        return view('role-permission.user.index');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255', // Nuevo campo last_name
            'ci' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name, // Asignar last_name
            'ci' => $request->ci, // Asignar ci
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User created successfully with roles');
    }


    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'ci' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)], // Corregir esta línea
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)], // Corregir esta línea
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'last_name' => $request->last_name, // Asignar last_name
            'ci' => $request->ci, // Asignar ci
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect('/users')->with('status', 'User Updated Successfully with roles');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'User Delete Successfully');
    }
}
