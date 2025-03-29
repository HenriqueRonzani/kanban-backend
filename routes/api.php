<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->group(function () {
        // Removed the user routes for now (no user will should have access)
//        require base_path('app/Domains/Auth/Http/Routes/UserRoutes.php');
        require base_path('app/Domains/Auth/Http/Routes/AuthRoutes.php');
    });

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
