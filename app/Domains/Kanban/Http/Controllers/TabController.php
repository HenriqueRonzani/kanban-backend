<?php

namespace App\Domains\Kanban\Http\Controllers;

use App\Domains\Kanban\Http\Requests\CreateOrUpdateTabRequest;
use App\Domains\Kanban\Services\TabServices\CreateTabService;
use App\Domains\Kanban\Services\TabServices\DeleteTabService;
use App\Domains\Kanban\Services\TabServices\QueryTabService;
use App\Domains\Kanban\Services\TabServices\UpdateTabService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TabController
{
    public function create(CreateTabService $service, CreateOrUpdateTabRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $user = Auth::user();
            $tab = $service->create($user, $data);
            DB::commit();
            return response()->json(
                $tab->only(['id']),
                201
            );
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
    public function update(int $id, UpdateTabService $service, CreateOrUpdateTabRequest $request): JsonResponse
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
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
    public function findUserTabs(QueryTabService $service): JsonResponse
    {
        try {
            $user = Auth::user();
            $tabs = $service->getUserTabs($user);
            return response()->json(
                $tabs
            );
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
    public function delete(int $id, DeleteTabService $service): JsonResponse
    {
        try {
            DB::beginTransaction();
            $service->delete($id);
            DB::commit();
            return response()->json(
                null,
                204
            );
        } catch (Exception $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                500
            );
        }
    }
}
