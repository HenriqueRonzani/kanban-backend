<?php

namespace App\Domains\Auth\Http\Controllers;

use App\Domains\Auth\Http\Requests\CreateOrUpdateUserRequest;
use App\Domains\Auth\Services\UserServices\CreateUserService;
use App\Domains\Auth\Services\UserServices\DeleteUserService;
use App\Domains\Auth\Services\UserServices\QueryUserService;
use App\Domains\Auth\Services\UserServices\UpdateUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function create(CreateUserService $service, CreateOrUpdateUserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $user = $service->create($data);
            DB::commit();
            return response()->json(
                $user->only(['id']),
                201
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
    public function update(int $id, UpdateUserService $service, CreateOrUpdateUserRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $service->update($id, $data);
            DB::commit();
            return response()->json(
                null,
                204
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
    public function find(Request $request, QueryUserService $service): JsonResponse
    {
        $data = $service->find($request->validate([
            'q' => 'string',
            'paginated' => 'boolean'
        ]));
        return response()->json(
            $data,
            200)
        ;
    }
    public function findById(int $id, QueryUserService $service): JsonResponse
    {
        $model = $service->findById($id);
        return response()->json(
            $model,
            200
        );
    }
    public function delete(int $id, DeleteUserService $service): JsonResponse
    {
        try {
            DB::beginTransaction();
            $service->delete($id);
            DB::commit();
            return response()->json(
                null,
                204
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
}
