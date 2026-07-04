<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks and truncate permissions table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Define permissions
        $permissions = [
            ['name' => 'dashboard_view', 'title' => 'View', 'group' => 'Dashboard', 'guard_name' => 'web'],

            // User permissions
            ['name' => 'user_view', 'title' => 'View', 'group' => 'User', 'guard_name' => 'web'],
            ['name' => 'user_edit', 'title' => 'Edit', 'group' => 'User', 'guard_name' => 'web'],
            ['name' => 'user_delete', 'title' => 'Delete', 'group' => 'User', 'guard_name' => 'web'],

            // Role permissions
            ['name' => 'role_view', 'title' => 'View', 'group' => 'Role', 'guard_name' => 'web'],
            ['name' => 'role_edit', 'title' => 'Edit', 'group' => 'Role', 'guard_name' => 'web'],
            ['name' => 'role_delete', 'title' => 'Delete', 'group' => 'Role', 'guard_name' => 'web'],

            // Permission permissions
            ['name' => 'permission_view', 'title' => 'View', 'group' => 'Permission', 'guard_name' => 'web'],
    
            
            // Employee permissions
            ['name' => 'employee_view', 'title' => 'View', 'group' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee_edit', 'title' => 'Edit', 'group' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee_delete', 'title' => 'Delete', 'group' => 'Employee', 'guard_name' => 'web'],
            ['name' => 'employee_list', 'title' => 'View', 'group' => 'Employee List', 'guard_name' => 'web'],

            //Workreport permissions
            ['name' => 'workreport_create', 'title' => 'Create', 'group' => 'WorkReport', 'guard_name' => 'web'],
            ['name' => 'workreport_view', 'title' => 'View', 'group' => 'WorkReport', 'guard_name' => 'web'],
            //['name' => 'workreport_edit', 'title' => 'Edit', 'group' => 'WorkReport'],
            ['name' => 'workreport_delete', 'title' => 'Delete', 'group' => 'WorkReport', 'guard_name' => 'web'],
            ['name' => 'workreport_list', 'title' => 'View', 'group' => 'WorkReport List', 'guard_name' => 'web'],

        ];

        // Insert permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
