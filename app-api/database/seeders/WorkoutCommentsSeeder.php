<?php

namespace Database\Seeders;

use App\Models\WorkoutComment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkoutCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkoutComment::factory()->count(20)->create();
    }
}
