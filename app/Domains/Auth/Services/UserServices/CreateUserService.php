<?php

namespace App\Domains\Auth\Services\UserServices;

use App\Models\User;

class CreateUserService
{
    public function create(array $data): User
    {
        return User::query()->create($data);
    }
}
