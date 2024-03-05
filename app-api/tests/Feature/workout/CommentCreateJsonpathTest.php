<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutComment;

class CommentCreateJsonpathTest extends TestCase
{
    /**
     * A basic feature test example.
     */
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
        $response->assertStatus(201)
        ->assertJsonPath('comment.comment', $comment['comment']); // Изменение этой строки


    }
}
