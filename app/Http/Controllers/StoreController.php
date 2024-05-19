<?php

namespace App\Http\Controllers;

use App\Domain\Store\Services\StoreService;
use App\Http\Requests\Store\CreateStoreRequest;
use App\Http\Requests\Store\UpdateStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __construct(
        private readonly StoreService $storeService
    )
    {
    }

    public function index(): LengthAwarePaginator
    {
        return $this->storeService->findPaginated(
            perPage: request()->input('perPage', 10),
            page: request()->input('page', 1),
        );
    }

    public function store(CreateStoreRequest $request): JsonResponse
    {
        $store = $this->storeService->create(
            name: $request->input('name'),
            address: $request->input('address'),
            isActive: $request->input('is_active')
        );

        return response()->json($store, Response::HTTP_CREATED);
    }

    public function show(string $id): JsonResponse
    {
        $store = $this->storeService->findOneBy([
            'id' => $id
        ]);

        if (!$store) {
            return response()->json([
                'message' => 'Store not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($store);
    }

    public function update(UpdateStoreRequest $request, string $id): JsonResponse
    {
        $store = $this->storeService->update(
            id: $id,
            name: $request->input('name'),
            address: $request->input('address'),
            isActive: $request->input('is_active')
        );

        return response()->json($store);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->storeService->destroy($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
