<?php

namespace Tests;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class Utilities
{
    public static function getAuthHeaders()
    {
        $user = User::factory()->create();

        return [
            'Authorization' => 'Bearer ' . JWTAuth::fromUser($user),
            'Accept' => 'application/json'
        ];
    }
}
