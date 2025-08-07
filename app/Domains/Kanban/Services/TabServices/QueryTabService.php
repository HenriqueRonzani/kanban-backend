<?php

namespace App\Domains\Kanban\Services\TabServices;

use App\Models\User;
use Exception;

class QueryTabService
{
    /**
     * @throws Exception
     */
    public function getUserTabs(?User $user): ?object
    {
        if(!$user) {
            throw new Exception('User not found');
        }
        return $user->tabs()->with(['cards' => function ($query) {
            $query->select(['id', 'title', 'status']);
        }])->get();
    }
}
