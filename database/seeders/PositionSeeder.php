<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = collect([
            'Web Development Instructor',
            'Mobile Development Instructor (iOS/Android)',
            'Data Science Instructor',
            'Software Engineering Instructor',
            'DevOps Instructor',
            'Cybersecurity Instructor',
            'Game Development Instructor',
            'UI/UX Design Instructor',
            'Database Management Instructor',
            'Networking Instructor',
            'Project Management Instructor',
            'Systems Administration Trainer',
            'Robotics Engineering Instructor',
            'AI Ethics Instructor',
            'HR Manager',
            'Accountant',
            'Website and Database Administrator',
            'CEO'
        ]);

        // Создание данных для вставки в таблицу
        $positionsData = $positions->map(function ($position, $index) {
            return [
                'name' => $position,
                'department_id' => $index < 17 ? $index + 1 : null,    // department_id от 1 до 16, для CEO null
                'salary' => fake()->randomFloat(2,20000,200000),
                'description' => fake()->realText(50),
                'is_vacancy'=>fake()->boolean(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        })->toArray();

        // Вставка данных в таблицу
        DB::table('positions')->insert($positionsData);
    }
}
