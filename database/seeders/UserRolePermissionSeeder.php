<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{

    public function run()
    {
        // Paso 1: Crear permisos para las vistas de las rutas
        $permissions = [
            'view documentos',
            'create documentos',
            'edit documentos',
            'delete documentos',
            'download documentos',

            'view documentosReci',
            'create documentosReci',
            'edit documentosReci',
            'delete documentosReci',
            'download documentosReci',

            'view programas',
            'create programas',
            'edit programas',
            'delete programas',

            'view tipo-tramites',
            'create tipo-tramites',
            'edit tipo-tramites',
            'delete tipo-tramites',

            'view flujotramites',
            'create flujotramites',
            'edit flujotramites',
            'delete flujotramites',

            'view flujo-documentos',
            'create flujo-documentos',
            'edit flujo-documentos',
            'delete flujo-documentos',
        ];

        // Crear los permisos
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Paso 2: Crear roles
        $roles = [
            'super-admin',
            'admin',
            'staff',
            'user',
        ];

        // Crear los roles
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Paso 3: Asignar los permisos al rol 'super-admin'
        $superAdminRole = Role::where('name', 'super-admin')->first();
        $superAdminRole->syncPermissions($permissions);

        // Paso 4: Asignar permisos específicos a otros roles si es necesario
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->givePermissionTo([
            'create documentos',
            'view documentos',
            'edit documentos',
            'delete documentos',
            'download documentos',

            'create documentosReci',
            'view documentosReci',
            'edit documentosReci',
            'delete documentosReci',
            'download documentosReci',

            'create programas',
            'view programas',
            'edit programas',
            'delete programas',

            'create tipo-tramites',
            'view tipo-tramites',
            'edit tipo-tramites',
            'delete tipo-tramites',

            'create flujotramites',
            'view flujotramites',
            'edit flujotramites',
            'delete flujotramites',

            'create flujo-documentos',
            'view flujo-documentos',
            'edit flujo-documentos',
            'delete flujo-documentos',
        ]);

        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);
        $userRole = Role::create(['name' => 'user']);

        // Paso 5: Crear usuarios y asignar roles
        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'Super Admin',
            'last_name' => 'Lastname',
            'password' => Hash::make('12345678'),
        ]);
        $superAdminUser->assignRole($superAdminRole);

        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin',
            'last_name' => 'Lastname',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $adminUser->assignRole($adminRole);


        $staffUser = User::firstOrCreate([
            'email' => 'staff@gmail.com',
        ], [
            'name' => 'Staff',
            'last_name' => 'Lastname',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $staffUser->assignRole($staffRole);
    }
}
