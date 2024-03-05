<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
class UserRegistrationTest extends TestCase
{
    use WithFaker;

    public function testIsUserRegistered()
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'admin123',
        ];

       
        $user = Factory::factoryForModel(User::class)->create($userData);

        $this->assertEquals($userData['email'], $user->email);
        $this->assertTrue($user->exists); 
    }
}
