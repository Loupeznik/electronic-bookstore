<?php

namespace Database\Seeders;

use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Seed real data for shipping_methods table
     *
     * @return void
     */
    public function run()
    {
        $methods = ['Česká Pošta', 'PPL', 'DPD', 'Osobní převzetí'];
        $costs = [120, 90, 100, 0];

        for ($i = 0; $i < count($methods); $i++)
        {
            ShippingMethod::create([
                'name' => $methods[$i],
                'cost' => $costs[$i]
            ]);
        }
    }
}
