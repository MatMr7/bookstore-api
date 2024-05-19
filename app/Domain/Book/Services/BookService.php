<?php

namespace App\Domain\Book\Services;

use App\Domain\Book\Models\Book;
use App\Domain\Book\Repositories\BookRepository;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class BookService
{
    public function __construct(
        private BookRepository $bookRepository
    )
    {
    }

    public function findPaginated(
        int   $perPage,
        int   $page,
        array $criteria = []
    ): LengthAwarePaginator
    {
        return $this->bookRepository->findPaginated(
            perPage: $perPage,
            page: $page,
            criteria: $criteria
        );
    }

    public function create(
        string $name,
        int    $isbn,
        float  $value,
        array  $storeIds = []
    ): Book
    {
        return $this->bookRepository->create(
            name: $name,
            isbn: $isbn,
            value: $value,
            storeIds: $storeIds
        );
    }

    public function findOneBy(array $criteria): ?Book
    {
        return $this->bookRepository->findOneBy($criteria);
    }

    public function update(
        int     $id,
        ?string $name,
        ?int    $isbn,
        ?float  $value,
        array   $storeIds = []
    ): Book
    {
        return $this->bookRepository->update(
            id: $id,
            name: $name,
            isbn: $isbn,
            value: $value,
            storeIds: $storeIds
        );
    }

    public function destroy(int $id): void
    {
        $this->bookRepository->destroy($id);
    }
}
