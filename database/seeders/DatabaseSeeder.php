<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // Запуск пользовательских сидеров
        $this->call([
            DepartmentsSeeder::class,
            KnowledgesSeeder::class,
            PositionSeeder::class,
            RolesSeeder::class,
            Position_RolesSeeder::class,
            User_knowledgesSeeder::class,
        ]);
    }
}
