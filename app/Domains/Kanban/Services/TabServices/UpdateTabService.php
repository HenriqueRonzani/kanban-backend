<?php

namespace App\Domains\Kanban\Services\TabServices;

use App\Models\Tab;

class UpdateTabService
{
    public function update(int $id, array $data): Tab
    {
        $tab = Tab::query()->findOrFail($id);
        $tab->update($data);
        return $tab;
    }
}
