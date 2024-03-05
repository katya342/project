<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Plan;
use App\Models\Subscription;

class SubCreateJsonPathTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $plan = Plan::factory()->create()->toArray();
        $plan_id = $plan["id"];
        $sub = Subscription::factory()->create()->toArray();
        $response = $this->postJson("api/user/add-subscription/{$plan_id}", $sub);

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('message', 'Subscription successful');


    }
}
