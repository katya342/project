<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
class SubscriptionCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $sub = Factory::factoryForModel(Subscription::class)->create();   
        $this->assertDatabaseHas('subscriptions', [
            'id' => $sub->id,
        ]);
        
    }
}
