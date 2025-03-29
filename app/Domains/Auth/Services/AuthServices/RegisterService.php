<?php

namespace App\Domains\Auth\Services\AuthServices;

use App\Domains\Auth\Services\UserServices\CreateUserService;
use App\Models\User;

class RegisterService
{
    public function createNewUser($data): User
    {
        return (new CreateUserService)->create($data);
    }
}
