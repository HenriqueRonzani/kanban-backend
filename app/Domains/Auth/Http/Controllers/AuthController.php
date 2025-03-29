<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Http\Requests\CreateOrUpdateUserRequest;
use App\Domains\Auth\Http\Requests\LoginRequest;
use App\Domains\Auth\Services\AuthServices\LoginService;
use App\Domains\Auth\Services\AuthServices\RegisterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AuthController
{
    public function login(LoginService $loginService, LoginRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $user = $loginService->validateCredentials($data['email'], $data['password']);
            $token = $loginService->createAccessToken($user);
            DB::commit();
            return response()->json([
                'token' => $token,
                'user' => $user->only(['id', 'name', 'email']),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(
                ['message' => $e->getMessage()],
                401
            );
        }
    }

    public function register(RegisterService $registerService, LoginService $loginService, CreateOrUpdateUserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $newUser = $registerService->createNewUser($data);
            $token = $loginService->createAccessToken($newUser);
            DB::commit();
            return response()->json([
                'token' => $token,
                'user' => $newUser->only(['id', 'name', 'email']),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(
                ['message' => $e->getMessage()],
                401
            );
        }
    }
}
