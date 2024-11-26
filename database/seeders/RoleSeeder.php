<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'Tester']);
        // Role::create(['name' => 'Manager']);
        // Role::create(['name' => 'Developer']);

        // Permission::create(['name' => 'view bugs']);
        // Permission::create(['name' => 'create bugs']);
        // Permission::create(['name' => 'assign bugs']);
        // Permission::create(['name' => 'edit bugs']);
        // Permission::create(['name' => 'close bugs']);

        // Permission::create(['name' => 'view projects']);
        // Permission::create(['name' => 'create projects']);
        // Permission::create(['name' => 'edit projects']);
        // Permission::create(['name' => 'delete projects']);

        // permission settings

        // Permission::create(['name' => 'settings']);

        // edit role Admin to include settings permission
        $admin = Role::findByName('Super Admin');
        $admin->givePermissionTo(['settings']);




        // Permission::create(['name' => 'view users']);
        // Permission::create(['name' => 'create users']);
        // Permission::create(['name' => 'edit users']);
        // Permission::create(['name' => 'delete users']);
        
        // // Assign permissions to roles
        // $admin = Role::findByName('Admin');
        // $admin->givePermissionTo([
        //     'view bugs', 'create bugs', 'assign bugs', 'close bugs',
        //     'view projects', 'create projects', 'edit projects', 'delete projects',
        //     'view users', 'create users', 'edit users', 'delete users'
        // ]);
        
        // $tester = Role::findByName('Tester');
        // $tester->givePermissionTo(['view bugs', 'create bugs', 'close bugs']);
        
        // $manager = Role::findByName('Manager');
        // $manager->givePermissionTo(['view bugs', 'assign bugs', 'close bugs', 'view projects', 'create projects', 'edit projects', 'delete projects']);
        
        // $developer = Role::findByName('Developer');
        // $developer->givePermissionTo(['view bugs', 'edit bugs']);

    }
}
