<?php

namespace App\Domains\Kanban\Services\TabServices;

use App\Models\Tab;
use App\Models\User;
use Exception;

class CreateTabService
{
    /**
     * @throws Exception
     */
    public function create(?User $user, array $data): Tab
    {
        if(!$user) {
            throw new Exception('User not found');
        }
        return $user->tabs()->create($data);
    }
}
