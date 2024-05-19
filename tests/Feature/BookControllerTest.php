<?php

use Database\Factories\BookFactory;
use Database\Factories\UserFactory;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    public function testListBooks()
    {
        $user = UserFactory::new()->create();

        BookFactory::new()->count(10)->create();

        $token = $this->loginUser($user);

        $response = $this->withToken($token)->getJson('/api/books');

        $response->assertJsonCount(10, 'data');
        $response->assertJsonStructure([
            'current_page',
            'data',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'isbn',
                    'value',
                    'created_at',
                    'updated_at'
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ]);
    }

    public function testCreateBook()
    {
        $user = UserFactory::new()->create();
        $token = $this->loginUser($user);

        $bookData = [
            'name' => 'John Doe life',
            'isbn' => 123342987123,
            'value' => 100.2
        ];

        $response = $this->withToken($token)->postJson('/api/books', $bookData);

        $response->assertCreated();

        $this->assertDatabaseHas('books', $bookData);
    }

    public function testGetBookById()
    {
        $user = UserFactory::new()->create();
        $token = $this->loginUser($user);

        $book = BookFactory::new()->create();
        $response = $this->withToken($token)->getJson('/api/books/' . $book->id);

        $response->assertOk();

        $response->assertJsonStructure([
            'id',
            'name',
            'isbn',
            'value',
            'created_at',
            'updated_at'
        ]);
    }

    public function testUpdateBook()
    {
        $user = UserFactory::new()->create();
        $token = $this->loginUser($user);

        $book = BookFactory::new()->create();

        $bookData = [
            'name' => 'John Doe in the wild',
            'isbn' => 41298731,
            'value' => 6.2
        ];

        $response = $this->withToken($token)->putJson('/api/books/' . $book->id, $bookData);

        $response->assertOk();

        $this->assertDatabaseHas('books', $bookData);
    }

    public function testDeleteBook()
    {
        $user = UserFactory::new()->create();
        $token = $this->loginUser($user);

        $book = BookFactory::new()->create();

        $this->assertDatabaseCount('books', 1);

        $response = $this->withToken($token)->deleteJson('/api/books/' . $book->id);

        $response->assertNoContent();

        $this->assertDatabaseCount('books', 0);
    }
}
