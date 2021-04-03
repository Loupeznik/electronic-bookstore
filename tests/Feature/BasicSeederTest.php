<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Seeders\TestSeeder;
use Illuminate\Support\Facades\DB;

class BasicSeederTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Basic database seeder test for dummy data
     * Evaluates if minimal number of desired records (3) have been inserted
     *
     * @test
     * @return void
     */
    public function basic_seeder_test()
    {

        $num_records = 3;
        $tables = ['authors', 'books', 'cart_items', 'categories', 'contact_forms', 'customers', 'order_items', 'order_returns', 'shipping_methods', 'users'];
        $tables_uuid = ['carts', 'orders', 'payment_methods'];

        $this->seed(TestSeeder::class);

        foreach ($tables as $table)
        {
            $this->assertDatabaseHas($table, ['id' => $num_records]);
        }

        foreach ($tables_uuid as $table)
        {
            $num_records_in_db = DB::table($table)->count('id');
            $this->assertGreaterThanOrEqual($num_records, $num_records_in_db, $table . ' contains less than 3 records');
        }

    }
}
