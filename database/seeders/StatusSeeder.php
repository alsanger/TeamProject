<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = collect([
            'Candidate',
            'Seeker',
            'Rejected',
            'Appointed'
        ]);

        foreach ($statuses as $status) {
            // Проверяем, существует ли уже запись с таким именем
            if (!Status::where('name', $status)->exists()) {
                Status::create([
                    'name' => $status
                ]);
            }
        }
    }
}
