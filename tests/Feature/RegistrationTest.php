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
            'first_name' => 'Bob',
            'last_name' => 'Sull',
            'email' => 'boby@sull.com',
            'password' => 'epfcepfc',
            'password_confirmation' => 'epfcepfc',
            'rules' => 'rules',
            'age' => 18,

        ]);

        $response->assertRedirect('/');
    }
}
