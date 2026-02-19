<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'admin_id' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            'tax_id' => fake()->numerify('###########'),
            'birth_date' => fake()->date(),
            'user_id' => User::factory(),
            'joined_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'active' => fake()->boolean(80), // 80% chance de ser ativo
        ];
    }
}
