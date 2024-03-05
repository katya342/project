<?php

namespace Tests\Feature;

use App\Models\Workout;
use Database\Factories\WorkoutFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;

class WorkoutDeletingTest extends TestCase
{


    public function testWorkoutDeletion(): void
    {
        $workout = Factory::factoryForModel(Workout::class)->create();
        $this->assertDatabaseHas('workouts', [
            'id' => $workout->id,
        ]);
        $workout->delete();

        $this->assertDatabaseMissing('workouts', [
            'id' => $workout->id,

        ]);

        

 
    }
}
