<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ProjectSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_time = Carbon::now();
        for ($i = 0; $i < 10; $i++) {
            DB::table('projects')->insert([
                [
                    'name'=> Faker::create()->text(50),
                    'description' => Faker::create()->text(100),
                    'created_at' => $current_time,
                    'updated_at' => $current_time,
                    'deleted_at' => null,

                ]
            ]);
        }

    }
}
