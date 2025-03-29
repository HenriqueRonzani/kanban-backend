<?php

namespace App\Domains\Auth\Services\UserServices;

use App\Models\User;

class DeleteUserService
{
    public function delete(int $id): bool
    {
        return User::query()->findOrFail($id)->delete();
    }
}
