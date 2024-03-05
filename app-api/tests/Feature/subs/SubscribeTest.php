<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Plan;
use App\Models\User;
use Auth;
use App\Models\Subscription;
use Tests\TestCase;

class SubscribeTest extends TestCase
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
        $response = $this->post("api/user/add-subscription/{$plan_id}", $sub);

        $response->assertStatus(200);
    }
}
