<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create Roles
        $roles = [
            'Admin',
            'Tester',
            'Manager',
            'Developer',
            'Super Admin',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create Permissions
        $permissions = [
            // Bug Permissions
            'view bugs',
            'create bugs',
            'assign bugs',
            'edit bugs',
            'close bugs',

            // Project Permissions
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',

            // User Permissions
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Settings Permission
            'settings',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign Permissions to Roles
        $rolesPermissions = [
            'Admin' => [
                'view bugs', 'create bugs', 'assign bugs', 'close bugs',
                'view projects', 'create projects', 'edit projects', 'delete projects',
                'view users', 'create users', 'edit users', 'delete users',
                'settings',
            ],
            'Tester' => [
                'view bugs', 'create bugs', 'close bugs',
            ],
            'Manager' => [
                'view bugs', 'assign bugs', 'close bugs',
                'view projects', 'create projects', 'edit projects', 'delete projects',
            ],
            'Developer' => [
                'view bugs', 'edit bugs',
            ],
        ];

        foreach ($rolesPermissions as $roleName => $rolePermissions) {
            $role = Role::findByName($roleName);
            $role->syncPermissions($rolePermissions);
        }

        // Create Super Admin and Assign All Permissions
        $superAdminRole = Role::findByName('Super Admin');
        $superAdminRole->syncPermissions(Permission::all());

        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ]
        );

        $superAdmin->assignRole($superAdminRole);

        $this->command->info('Super Admin, roles, and permissions have been successfully initialized!');
    }
}
