<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Use this seeder for real data.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AuthorSeeder::class,
            BookSeeder::class,
            CartSeeder::class,
            CategorySeeder::class,
            ContactFormSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            OrderReturnSeeder::class,
            ShippingMethodSeeder::class
        ]);
    }
}
