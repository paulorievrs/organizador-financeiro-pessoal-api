<?php

namespace Tests;

use App\Models\ExpenseTypes;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class Utilities
{
    public static function getAuthHeaders($returnUser = false): array
    {
        $user = User::factory()->create();

        $headers = [
            'Authorization' => 'Bearer ' . JWTAuth::fromUser($user),
            'Accept' => 'application/json'
        ];

        if($returnUser) {
             $headers['user'] = $user;
             return $headers;
        }

        return $headers;
    }

    public static function generateStandards()
    {
        ExpenseTypes::insert([
            [
                'name' => 'fixed'
            ],
            [
                'name' => 'variable'
            ]

        ]);
    }
}
