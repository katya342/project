<?php

namespace Tests\Feature;

use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;
use App\Models\WorkoutComment;

class CreateCommentViaHTTPTest extends TestCase
{
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $workout = Workout::factory()->create();
        $existingWorkoutId = $workout->id;
        $comment = WorkoutComment::factory()->create([
            'workout_id' => $existingWorkoutId,
        ])->toArray();
        $response = $this->post("api/user/add-comment/{$existingWorkoutId}", $comment);
        $response->assertStatus(201);
    }




}
