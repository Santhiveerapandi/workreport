<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Config;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'              => config('constants.USER_ROLES.SUPERADMIN', 'superadmin'),
                'email'             => 'superadmin@gmail.com',
                'password'          => bcrypt('super@123'),
            ],
            [
                'name'              => config('constants.USER_ROLES.ADMIN', 'admin'),
                'email'             => 'admin@gmail.com',
                'password'          => bcrypt('admin@123'),
            ],
        ];

        foreach ($userData as $data) {
            User::create($data);
        }

        $users = User::whereIn('email', ['superadmin@gmail.com', 'admin@gmail.com'])->get();

        foreach ($users as $user) {
            if($user->name==config('constants.USER_ROLES.SUPERADMIN',  'SuperAdmin')){
                $user->syncRoles([config('constants.USER_ROLES.SUPERADMIN', 'SuperAdmin')]);
            }else if($user->name==config('constants.USER_ROLES.ADMIN', 'Admin')){
                $user->syncRoles([config('constants.USER_ROLES.ADMIN', 'Admin')]);
            }else if($user->name==config('constants.USER_ROLES.USER', 'GeneralUser')){
                $user->syncRoles([config('constants.USER_ROLES.USER', 'GeneralUser')]);
            }
        }
    }
}
