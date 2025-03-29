<?php

namespace App\Domains\Auth\Http\Routes;

use App\Domains\Auth\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('login')
    ->group(function () {
        Route::post('/', [AuthController::class, 'login']);
    });

Route::prefix('register')
    ->group(function () {
        Route::post('/', [AuthController::class, 'register']);
    });
