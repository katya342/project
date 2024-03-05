<?php

namespace Tests\Feature;

use App\Models\WorkoutComment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreateCommentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $comment = Factory::factoryForModel(WorkoutComment::class)->create();
        $this->assertDatabaseHas('workout_comments', [
            'id' => $comment->id,
        ]);
        
    }
}
