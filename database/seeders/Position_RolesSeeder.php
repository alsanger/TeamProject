<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Position;
use App\Models\Role;

class Position_RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Определение позиций и связанных ролей
        $positionsRoles = [
            'Website and Database Administrator' => 'administrator',
            'HR Manager' => 'HR_manager',
            'CEO' => 'CEO',
        ];

        // Вставка данных в таблицу
        foreach ($positionsRoles as $positionName => $roleName) {
            $positionId = Position::where('name', $positionName)->value('id');
            $roleId = Role::where('name', $roleName)->value('id');

            if ($positionId && $roleId) {
                DB::table('position_roles')->insert([
                    'position_id' => $positionId,
                    'role_id' => $roleId,
                ]);
            }
        }
    }
}
