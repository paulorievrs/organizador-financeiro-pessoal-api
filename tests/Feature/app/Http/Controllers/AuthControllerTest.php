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
            'password' => 'password',
            'passwordConfirm' => 'password',
        ];

        $response = $this->post('/api/auth/register', $payload);
        $response->assertOk();
        unset($payload['passwordConfirm']);
        unset($payload['password']);

        $responseArray = json_decode($response->getContent(), true);
        $user = User::find($responseArray['id']);
        $this->assertEquals($responseArray, $user->toArray());
    }

    public function test_user_can_get_his_data()
    {
        $headers = Utilities::getAuthHeaders(true);

        $response = $this->get('/api/auth/me', $headers);
        $response->assertOk();
    }

}
