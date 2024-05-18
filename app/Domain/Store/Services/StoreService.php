<?php

namespace App\Domain\Store\Services;

use App\Domain\Store\Models\Store;
use App\Domain\Store\Repositories\StoreRepository;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class StoreService
{
    public function __construct(
        private StoreRepository $storeRepository
    )
    {
    }

    public function create(
        string $name,
        string $address,
        bool   $isActive
    ): Store
    {
        return $this->storeRepository->create(
            name: $name,
            address: $address,
            isActive: $isActive
        );
    }

    public function update(
        int     $id,
        ?string $name,
        ?string $address,
        ?bool   $isActive
    ): Store
    {
        return $this->storeRepository->update(
            id: $id,
            name: $name,
            address: $address,
            isActive: $isActive
        );
    }

    public function findOneBy(array $criteria): ?Store
    {
        return $this->storeRepository->findOneBy($criteria);
    }

    public function destroy(int $id): void
    {
        $this->storeRepository->destroy($id);
    }

    public function findPaginated(
        int   $perPage,
        int   $page,
        array $criteria = []
    ): LengthAwarePaginator
    {
        return $this->storeRepository->findPaginated(
            perPage: $perPage,
            page: $page,
            criteria: $criteria
        );
    }
}
