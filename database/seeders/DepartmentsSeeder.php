<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = collect([
            'Department of Software Engineering',
            'Department of DevOps and Cloud Computing',
            'Human Resources Department (HR Department)',
            'Finance Department',
            'Technical Support and Database Management Department'
        ]);

        foreach ($departments as $department) {
            Department::firstOrCreate(['name' => $department]);
        }

    }
}
