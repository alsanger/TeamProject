<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем ID для департамента "Technical Support and Database Management Department"
        $technicalSupportDepartmentId = Department::where('name', 'Technical Support and Database Management Department')->value('id');

        // Названия позиций
        $positions = [
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
        ];

        foreach ($positions as $position) {
            // Определение department_id
            $departmentId = match ($position) {
                'Website and Database Administrator' => $technicalSupportDepartmentId,
                'CEO' => null,
                default => Department::inRandomOrder()->value('id') // Случайное распределение по департаментам
            };

            // Проверка существования позиции перед созданием
            Position::firstOrCreate(
                ['name' => $position], // Условие уникальности
                [
                    'department_id' => $departmentId,
                    'salary' => fake()->randomFloat(2, 20000, 200000),
                    'description' => fake()->realText(50),
                    'is_vacancy' => fake()->boolean(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
        }
    }
}
