<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderReturn;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderReturnFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderReturn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::factory()->complete(),
            'status' => $this->faker->numberBetween(0, 2),
            'description' => $this->faker->paragraph(6)
        ];
    }

    public function hasResult()
    {
        return $this->state(function (array $attributes) {
            return [
                'result' => $this->faker->numberBetween(0, 2),
                'completed_at' => now()
            ];
        });
    }

    public function assigned()
    {
        return $this->state(function (array $attributes) {
            return [
                'assignee_id' => User::factory()->admin()
            ];
        });
    }
}
