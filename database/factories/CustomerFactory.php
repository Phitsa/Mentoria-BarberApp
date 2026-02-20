<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => fake()->phoneNumber(),
            'tax_id' => fake()->numerify('###########'),
            'birth_date' => fake()->date(),
            'user_id' => User::factory(),
            'name' => fake()->name(),
            'admin_id' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
        ];
    }
}
