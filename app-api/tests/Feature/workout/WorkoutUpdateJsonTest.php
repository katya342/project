<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Workout;
use App\Models\User;

class WorkoutUpdateJsonTest extends TestCase
{
    public function testUpdateWorkout()
    {
        
        $user = User::factory()->create();
        $this->actingAs($user);
        $workout = Workout::factory()->create()->toArray();
        $id = $workout['id'];
        $response = $this->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->json('PUT', "/api/workouts/{$id}", $workout);

        $response->assertStatus(200);

        $response->assertJson([
            'workout' => $workout
        ]);

    
        $this->assertDatabaseHas('workouts', $workout);
    }
}
