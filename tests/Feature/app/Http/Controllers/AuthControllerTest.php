<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Utilities;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

    public function test_user_can_register()
    {
        $payload = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];

        $response = $this->post('/api/auth/register', $payload);
        $response->assertOk();
        $this->assertDatabaseHas('users', $payload);
    }

}
