<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'first_name' => 'Boby',
            'last_name' => 'Sull',
            'email' => 'boby@sull.com',
            'password' => 'epfc1234',
            'password_confirmation' => 'epfc1234',
            'rules' => 'rules',
            'age' => 18,

        ]);

        $response->assertRedirect('/');
    }
}
