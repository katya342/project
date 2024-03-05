<?php

namespace Tests\Feature;

use App\Models\Trainers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GettingTrainersTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $trainers = Factory::factoryForModel(Trainers::class)->create();
        $this->assertDatabaseHas('trainers', [
            'id' => $trainers->id,
        ]);
    }
}
