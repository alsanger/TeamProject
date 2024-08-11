<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status=collect(['Candidate',
            'Seeker',
            'Rejected',
            'Appointed']);

        foreach($status as $status){
            Status::create([
                'name'=>$status
            ]);
        }
    }
}
