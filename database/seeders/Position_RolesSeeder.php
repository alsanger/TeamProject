<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Position_RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('position_roles')->insert([
                [
                'position_id' => 17,
                'role_id' => 1,
                ],
                [
                    'position_id' => 15,
                    'role_id' => 2,
                ],
                [
                    'position_id' => 18,
                    'role_id' => 3,
                ],
        ]);
    }
}
