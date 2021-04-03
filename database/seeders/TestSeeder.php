<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Seed dummy data from factories for testing purposes.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create();
        \App\Models\Book::factory(3)->create();
        \App\Models\Author::factory(3)->create();
        \App\Models\Category::factory(3)->create();
        \App\Models\Cart::factory(3)->create();
        \App\Models\CartItem::factory(3)->create();
        \App\Models\ContactForm::factory(3)->create();
        \App\Models\Customer::factory(3)->create();
        \App\Models\Order::factory(3)->create();
        \App\Models\OrderItem::factory(3)->create();
        \App\Models\OrderReturn::factory(3)->create();
        \App\Models\PaymentMethod::factory(3)->create();
        \App\Models\ShippingMethod::factory(3)->create();
    }
}
