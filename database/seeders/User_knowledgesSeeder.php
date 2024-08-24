<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Knowledge;

class User_knowledgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получение существующих пользователей и знаний
        $userIds = User::pluck('id')->toArray();
        $knowledgeIds = Knowledge::pluck('id')->toArray();

        // Генерация данных
        foreach ($userIds as $userId) {
            // Генерация случайного количества знаний для каждого пользователя (от 1 до 5)
            $knowledgeCount = rand(1, 5);

            // Вставка записей для каждого знания
            for ($i = 0; $i < $knowledgeCount; $i++) {
                DB::table('user_knowledges')->insert([
                    'user_id' => $userId,
                    'knowledge_id' => $knowledgeIds[array_rand($knowledgeIds)],
                ]);
            }
        }
    }
}
