<?php

namespace App\Domain\Auth\Http\Routes;

use App\Domains\Auth\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('user')
    ->group(function () {
        Route::middleware('auth:sanctum')->get('/', [UserController::class, 'find']);
        Route::middleware('auth:sanctum')->get('/', [UserController::class, 'create']);
        Route::middleware('auth:sanctum')->get('/{id}', [UserController::class, 'findById']);
        Route::middleware('auth:sanctum')->get('/{id}', [UserController::class, 'update']);
        Route::middleware('auth:sanctum')->get('/{id}', [UserController::class, 'delete']);
    });
