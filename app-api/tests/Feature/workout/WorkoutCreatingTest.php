<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workout;
use Database\Factories\WorkoutFactory;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;

// use Faker\Provider\Address;
class WorkoutCreatingTest extends TestCase
{


    public function testIsWorkoutCreated()
    {
        $workout = Factory::factoryForModel(Workout::class)->create();
        $this->assertDatabaseHas('workouts', [
            'id' => $workout->id,
        ]);

        
    }
}
