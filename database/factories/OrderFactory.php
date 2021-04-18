<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid,
            'sum' => $this->faker->randomFloat(2),
            'vat' => $this->faker->randomFloat(2),
            'status' => $this->faker->numberBetween(0, 4),
            'payment_method_id' => PaymentMethod::factory(),
            'cart_id' => Cart::factory(),
            'customer_id' => Customer::factory(),
            'shipping_id' => ShippingMethod::factory()
        ];
    }

    public function assigned()
    {
        return $this->state(function (array $attributes) {
            return [
                'assignee_id' => User::factory()->admin()
            ];
        });
    }

    public function complete()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 2
            ];
        });
    }

    public function fresh()
    {
        return $this->state(function (array $attributes) {
            return [
                'sum' => 0,
                'vat' => 0,
                'status' => 0
            ];
        });
    }
}
