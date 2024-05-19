<?php

namespace Database\Factories;
use App\Domain\Book\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'isbn' => $this->faker->isbn13(),
            'value' => $this->faker->numberBetween(1, 100),
        ];
    }
}
