<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PermissionAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks and truncate relevant tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('role_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Define roles and their respective permissions
        $rolePermissions = [
            config('constants.USER_ROLES.SUPERADMIN') => [
                'dashboard_view',
                'user_view', 'user_edit', 'user_delete',
                'role_view', 'role_edit', 'role_delete',
                'permission_view',
                'employee_view', 'employee_edit', 'employee_delete',
                'workreport_create', 'workreport_view', 'workreport_delete', 'workreport_list',
                
            ],
            config('constants.USER_ROLES.ADMIN') => [
                'dashboard_view',
                'user_view', 'user_edit', 'user_delete',
                'role_view', 'role_edit', 'role_delete',
                'permission_view',
                'employee_view', 'employee_edit', 'employee_delete',
                'workreport_create', 'workreport_view', 'workreport_delete', 'workreport_list',
                
            ],
            config('constants.USER_ROLES.GENERALUSER') => [
                'dashboard_view',
                'workreport_create', 'workreport_view', 'workreport_delete',
            ],
        ];

        // Assign permissions to roles
        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $role->syncPermissions($permissions);
            }
        }
    }
}
