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
            'Department of Web Development',
            'Department of Mobile Development',
            'Department of Data Science and AI',
            'Department of Software Engineering',
            'Department of DevOps and Cloud Computing',
            'Department of Cybersecurity',
            'Department of Game Development',
            'Department of UI/UX Design',
            'Department of Database Management',
            'Department of Networking',
            'Department of Project Management',
            'Department of IT Support and System Administration',
            'Department of Robotics and IoT',
            'Department of Artificial Intelligence Ethics',
            'Human Resources Department (HR Department)',
            'Finance Department',
            'Technical Support and Database Management Department'
        ]);

        foreach ($departments as $department) {
            Department::firstOrCreate(['name' => $department]);
        }
    }
}
