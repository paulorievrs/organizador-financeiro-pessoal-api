<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Utilities;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $payload = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->post('/api/auth/login', $payload);
        $response->assertOk();

    }

    public function test_user_can_logout()
    {
        $response = $this->post('/api/auth/logout', [], Utilities::getAuthHeaders());
        $response->assertOk();
    }

}
