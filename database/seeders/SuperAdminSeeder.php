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
        // // Create Super Admin user
        // $superAdmin = User::create([
        //     'name' => 'Super Admin',
        //     'email' => 'superadmin@example.com',
        //     'password' => bcrypt('password'), // Replace with a secure password
        // ]);

        // // Create Super Admin role
        // $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);

        // // Assign all permissions to the Super Admin role
        $permissions = Permission::all(); // Get all permissions
        // $superAdminRole->syncPermissions($permissions);

        // // Assign the Super Admin role to the user
        // $superAdmin->assignRole($superAdminRole);

        // $this->command->info('Super Admin created successfully!');
        // get the user
        $user = User::where('email', 'superadmin@example.com' )->first();
        // get the role
        $role = Role::where('name', 'Super Admin')->first();
        // assigne all permissions to the role
        $role->syncPermissions($permissions);
        // assign the role to the user
        $user->assignRole($role);
    }
}
