<?php

namespace Database\Factories\Employee;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee\Availability>
 */
class AvailabilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'weekday' => $this->faker->numberBetween(0, 6),
            'time' => $this->faker->time('H:i'),
            'active' => $this->faker->boolean(),
        ];
    }
}
