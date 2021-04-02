<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CartItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => Book::factory(),
            'cart_id' => Cart::factory(),
            'count' => function (array $attributes) {
                return rand(1, Book::find($attributes['book_id'])->available);
            }
        ];
    }
}
