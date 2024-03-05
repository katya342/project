<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSeeder extends Seeder
{
    // use RefreshDatabase;
    
    public function run(): void
    {
        User::factory()->count(3)->create();
    }
}
