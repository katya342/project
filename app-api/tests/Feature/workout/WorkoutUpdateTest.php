<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Workout;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $user = User::factory()->create();
        $this->actingAs($user);
        $workout = Workout::factory()->create()->toArray();
        $id = $workout['id'];
        $response = $this->put("api/workouts/{$id}", $workout);
        $response->assertStatus(200);
    }
}
