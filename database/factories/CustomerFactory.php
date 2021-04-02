<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'street' => $this->faker->streetName,
            'street_nr' => $this->faker->buildingNumber,
            'city' => $this->faker->city,
            'zip' => $this->faker->randomNumber(5, true),
            'country' => $this->faker->country,
            'phone' => $this->faker->randomNumber(9, true),
            'email' => $this->faker->safeEmail
        ];
    }

    public function hasUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory()->customer(),
                'email' => NULL
            ];
        });
    }
}
