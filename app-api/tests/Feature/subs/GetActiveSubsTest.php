<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class GetActiveSubsTest extends TestCase
{
    
    public function test_example(): void
    {
        $activeSub = Factory::factoryForModel(Subscription::class)->create(['active' => '1']);
        $unActiveSub = Factory::factoryForModel(Subscription::class)->create(['active' => '0']);
        $this->assertDatabaseHas('subscriptions', [
            'id' => $activeSub->id,
            'active' => '1',

        ]);
        $this->assertDatabaseHas('subscriptions', [
            'id' => $unActiveSub->id,
            'active' => '0',
        ]);
    }
}
