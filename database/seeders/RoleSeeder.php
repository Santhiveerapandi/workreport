<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Config;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            config('constants.USER_ROLES.SUPERADMIN', 'SuperAdmin'),
            config('constants.USER_ROLES.USER', 'GeneralUser'),
            config('constants.USER_ROLES.ADMIN', 'Admin'),
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($roles as $value) {
            if (!empty($value)) {
                Role::create(['name' => $value]);
            }
        }
    }
}
