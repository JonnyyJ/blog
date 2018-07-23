<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\user;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   public function testRequiresEmailAndLogin()
   {
       $this->json('POST','api/login')
           ->assertStatus(422)
           ->assertJson([
               'email'=>['The email field is required.'],
               'password'=>['The password field is required.'],
           ]);
   }
   public function testUserLoginSuccessfully()
   {
       $user=factory(User::class)->create([
           'email'=>'test@jc.com',
           'password'=>bcrypt(123123),
       ]);

       $payload = ['email' => 'test@jc.com', 'password' => '123123'];

       $this->json('POST', 'api/login', $payload)
           ->assertStatus(200)
           ->assertJsonStructure([
               'data' => [
                   'id',
                   'name',
                   'email',
                   'created_at',
                   'updated_at',
                   'api_token',
               ],
           ]);

   }

}
