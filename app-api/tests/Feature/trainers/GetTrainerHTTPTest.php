<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Trainers;
use Tests\TestCase;

class GetTrainerHTTPTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $trainers = Trainers::factory()->create()->toArray();
        $response = $this->get('api/trainers', $trainers);

        $response->assertStatus(200);
    }
}
