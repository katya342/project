<?php

namespace Tests\Feature;

use App\Models\User;
use Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Hash;
class UserAuthenticationTest extends TestCase
{
    

    public function testIsUserAuthorized()
    {
        
        $user = Factory::factoryForModel(User::class)->create([
            'email' => 'katyabezv25@gmail.com',
            'password' => bcrypt('admin'), 
        ]);
        $this->actingAs($user);
        $authUser = Auth::user();

        $response = $this->post('/authorize', [
            'email' => 'katyabezv25@gmail.com',
            'password' => 'adminks', 
        ]);
        $this->assertInstanceOf(User::class, $authUser);
        $this->assertTrue(Hash::check('admin', $authUser->password));
       



    }
}
