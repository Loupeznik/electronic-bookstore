<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Seed customers.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->count(10)->create();
    }
}
