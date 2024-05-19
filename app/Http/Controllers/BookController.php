<?php

namespace App\Http\Controllers;

use App\Domain\Book\Services\BookService;
use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct(
        private readonly BookService $bookService
    )
    {
    }

    public function index(): LengthAwarePaginator
    {
        return $this->bookService->findPaginated(
            perPage: request()->input('perPage', 10),
            page: request()->input('page', 1),
        );
    }

    public function store(CreateBookRequest $request): JsonResponse
    {
        $book = $this->bookService->create(
            name: $request->input('name'),
            isbn: $request->input('isbn'),
            value: $request->input('value'),
            storeIds: $request->input('store_ids', [])
        );

        return response()->json($book, Response::HTTP_CREATED);
    }

    public function show(string $id): JsonResponse
    {
        $book = $this->bookService->findOneBy([
            'id' => $id,
        ]);

        if (!$book) {
            return response()->json([
                'message' => 'Book not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($book);
    }

    public function update(UpdateBookRequest $request, string $id): JsonResponse
    {
        $book = $this->bookService->update(
            id: $id,
            name: $request->input('name'),
            isbn: $request->input('isbn'),
            value: $request->input('value'),
            storeIds: $request->input('store_ids', [])
        );

        return response()->json($book);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->bookService->destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
