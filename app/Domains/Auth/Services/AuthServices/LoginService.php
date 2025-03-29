<?php

namespace App\Domains\Auth\Services\AuthServices;


use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    /**
     * @throws Exception
     */
    public function validateCredentials(string $email, string $password): User
    {
        $user = User::query()->where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new Exception('Invalid credentials');
        }

        return $user;
    }

    public function createAccessToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
