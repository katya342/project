<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Subscription;

class GetUnactiveSubsJsonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $subs = Subscription::factory()->create(['active' => '0']);
        $subArray = $subs->toArray();
        $response = $this->getJson('api/user/active-subs', ['success' => $subArray]);
        $response->assertStatus(200);
    }
}
