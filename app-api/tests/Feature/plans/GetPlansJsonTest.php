<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Plan;

class GetPlansJsonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $plans = Plan::factory()->create()->toArray();
        $response = $this->get('api/user/plans', ['All plans: ' => $plans]);
        $response->assertStatus(200);
    }
}
