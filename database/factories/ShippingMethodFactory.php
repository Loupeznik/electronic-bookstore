<?php

namespace Database\Factories;

use App\Models\ShippingMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingMethod::class;
    protected $methods = ['Česká pošta', 'DHL', 'PPL', 'DPD', 'Osobní vyzvednutí'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->methods[rand(0, count($this->methods) - 1)],
            'cost' => $this->faker->randomFloat(2, 70, 130)
        ];
    }
}
