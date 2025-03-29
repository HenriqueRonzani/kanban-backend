<?php

namespace App\Domains\Auth\Services\UserServices;

use App\Models\User;

class QueryUserService
{
    public function find(array $filters)
    {
        $q = data_get($filters, 'q');
        $paginated = data_get($filters, 'paginated', true);

        $query = User::query();

        $query->when($q, function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
            ->orWhere('email', 'like', "%$q%");
        });

        if ($paginated) {
            return $query->paginate();
        } else {
            return $query->get();
        }
    }

    public function findById(int $id): User
    {
        return User::query()->findOrFail($id);
    }
}
