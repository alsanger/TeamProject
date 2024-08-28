<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect([
            'administrator',
            'HR_manager',
            'CEO' // Chief Executive Officer
        ]);

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role
            ]);
        }
    }
}
