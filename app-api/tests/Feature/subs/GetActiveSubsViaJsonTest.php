<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Subscription;

class GetActiveSubsViaJsonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $subs = Subscription::factory()->create(['active' => '1']);
        $subArray = $subs->toArray();
        $response = $this->getJson('api/user/active-subs', ['success' => $subArray]);
        $response->assertStatus(200);
        

        
    }
}
