<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WorkoutComment;
use Tests\TestCase;

class DeleteCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $comment = Factory::factoryForModel(WorkoutComment::class)->create();
        $comment->delete();
        $this->assertDatabaseMissing('workout_comments', [
            'id' => $comment->id,
        ]);

    }
}
