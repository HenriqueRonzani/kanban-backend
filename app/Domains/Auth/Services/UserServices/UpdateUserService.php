<?php

namespace App\Domains\Auth\Services\UserServices;

use App\Models\User;

class UpdateUserService
{
    public function update(int $id, array $data): bool
    {
        return User::query()->findOrFail($id)->update($data);
    }
}
