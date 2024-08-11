<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_knowledgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($userId = 1; $userId <= 10; $userId++) {
            // Генерация случайного количества знаний для каждого пользователя (от 1 до 5)
            $knowledgeCount = rand(1, 5);

            // Вставка записей для каждого знания
            for ($i = 0; $i < $knowledgeCount; $i++) {
                DB::table('user_knowledges')->insert([
                    'user_id' => $userId,
                    'knowledge_id' => rand(1, 25),
                ]);
            }
        }

    }
}
