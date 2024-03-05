<?php

namespace Tests\Feature;

use App\Models\Trainers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTrainerViaIdTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $trainer = Trainers::factory()->create();   
        $id = $trainer->id;
        $response = $this->get("api/trainers/${id}");

        $response->assertStatus(200);
    }
}
