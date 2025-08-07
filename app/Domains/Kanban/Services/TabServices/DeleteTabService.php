<?php

namespace App\Domains\Kanban\Services\TabServices;

use App\Models\Tab;
use Exception;

class DeleteTabService
{
    /**
     * @throws Exception
     */
    public function delete(int $id)
    {
        $tab = Tab::query()->findOrFail($id);
        if ($tab->cards()->count() > 0) {
            throw new Exception('Tab has cards, cannot delete');
        }
        $tab->delete();
        return $tab;
    }
}
