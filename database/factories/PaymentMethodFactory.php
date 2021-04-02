<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentMethod::class;
    protected $methods = ['PayPal', 'VISA', 'Mastercard', 'Bank Transfer'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'type' => $this->methods[rand(0, count($this->methods) - 1)],
            'customer_id' => Customer::factory()
        ];
    }
}
