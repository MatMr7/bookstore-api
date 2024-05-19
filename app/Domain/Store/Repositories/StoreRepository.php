<?php

namespace App\Domain\Store\Repositories;

use App\Domain\Store\Models\Store;
use Illuminate\Pagination\LengthAwarePaginator;

class StoreRepository
{
    public function findPaginated(
        int   $perPage,
        int   $page,
        array $criteria = []
    ): LengthAwarePaginator
    {
        return Store::query()
            ->when(!empty($criteria), fn($query) => $query->where($criteria))
            ->paginate(
                perPage: $perPage,
                page: $page
            );
    }

    public function destroy(int $id): void
    {
        Store::query()->where('id',$id)->delete();
    }

    public function create(
        string $name,
        string $address,
        bool   $isActive
    ): Store
    {
        /** @var Store $store */
        $store = Store::query()->create([
            'name' => $name,
            'address' => $address,
            'is_active' => $isActive
        ]);

        return $store;
    }

    public function update(
        int     $id,
        ?string $name,
        ?string $address,
        ?bool   $isActive
    ): Store
    {
        Store::query()
            ->where('id', $id)
            ->update(array_filter([
                'name' => $name,
                'address' => $address,
                'is_active' => $isActive
            ], fn($item) => $item !== null));

        /** @var Store $store */
        $store = Store::query()->find($id);

        return $store;
    }

    public function findOneBy(array $criteria): ?Store
    {
        /** @var Store $store */
        $store = Store::query()->where($criteria)->first();

        return $store;
    }
}
