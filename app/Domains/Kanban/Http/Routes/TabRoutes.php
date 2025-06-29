<?php

namespace App\Domains\Kanban\Http\Routes;

use App\Domains\Kanban\Http\Controllers\TabController;
use Illuminate\Support\Facades\Route;

Route::prefix('tabs')
    ->group(function () {
        Route::get('/', [TabController::class, 'findUserTabs']);
        Route::post('/', [TabController::class, 'create']);
        Route::put('/{id}', [TabController::class, 'update']);
        Route::delete('/{id}', [TabController::class, 'delete']);
    });
