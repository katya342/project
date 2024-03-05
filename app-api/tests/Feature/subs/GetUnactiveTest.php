<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;

class GetUnactiveTest extends TestCase
{
   
    public function test_example(): void
    {
        $unactiveSubs = Factory::factoryForModel(Subscription::class)->create(['active' => '0']);
        $this->assertDatabaseHas('subscriptions', [
            'id' => $unactiveSubs->id,
        ]);
    }
}
