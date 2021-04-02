<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(4, true),
            'author_id' => Author::factory(),
            'price' => $this->faker->randomFloat(2, 50, 2300),
            'isbn' => $this->faker->isbn13,
            'language' => $this->faker->languageCode,
            'category_id' => Category::factory(),
            'publisher' => $this->faker->company,
            'available' => $this->faker->randomNumber,
            'description' => $this->faker->paragraph,
            'year' => $this->faker->year
        ];
    }
}
