<?php

namespace App\Domain\Book\Repositories;

use App\Domain\Book\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository
{
    public function findPaginated(
        int   $perPage,
        int   $page,
        array $criteria = []
    ): LengthAwarePaginator
    {
        return Book::query()
            ->with('stores')
            ->when(!empty($criteria), fn($query) => $query->where($criteria))
            ->paginate(
                perPage: $perPage,
                page: $page
            );
    }

    public function create(
        string $name,
        int    $isbn,
        float  $value,
        array  $storeIds = []
    ): Book
    {
        /** @var Book $book */
        $book = Book::query()->create([
            'name' => $name,
            'isbn' => $isbn,
            'value' => $value,
        ]);

        if (!empty($storeIds)) {
            $book->stores()->attach($storeIds);
        }

        $book->load('stores');

        return $book;
    }

    public function findOneBy(array $criteria): ?Book
    {
        /** @var Book $book */
        $book = Book::query()
            ->with('stores')
            ->where($criteria)
            ->first();

        return $book;
    }

    public function update(
        int     $id,
        ?string $name,
        ?int    $isbn,
        ?float  $value,
        array   $storeIds = []
    ): Book
    {
        Book::query()
            ->where('id', $id)
            ->update([
                'name' => $name,
                'isbn' => $isbn,
                'value' => $value,
            ]);

        /** @var Book $book */
        $book = Book::query()->find($id);

        if(!empty($storeIds)) {
            $book->stores()->sync($storeIds);
        }

        $book->load('stores');

        return $book;
    }

    public function destroy(int $id): void
    {
        Book::query()->where('id',$id)->delete();
    }
}
