<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Knowledge;
class KnowledgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $knowledges=collect([
            'C++',
            'C#',
            'PHP',
            'Python',
            'JavaScript',
            'Java',
            'Laravel',
            'Symphony',
            'React',
            'Angular',
            'ASP .Net',
            'Windows Form',
            'WPF',
            'Ruby',
            'Swift',
            'HTML & CSS',
            'Vue.js',
            'MySQL',
            'PostgresSQL',
            'MongoDB',
            'Version control(Git)',
            'Docker',
            'Kubernetes',
            'Azure',
            'Postman']);

        $description=collect([
            'Expert knowledge with extensive professional experience in real-world projects',
            'Proficient with several years of hands-on experience in various applications',
            'Intermediate understanding with practical experience in medium-sized projects',
            'Familiar with basic concepts and some experience in personal or academic projects',
            'Beginner, with theoretical knowledge and limited hands-on experience']);

        foreach ($knowledges as $knowledge) {
            Knowledge::create([
                'name' => $knowledge,
                'description' => $description->random()
            ]);
        }
    }
}
