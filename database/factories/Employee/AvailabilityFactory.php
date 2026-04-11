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
        $hour = $this->faker->numberBetween(7, 20);
        $minute = $this->faker->randomElement(['00', '30']);

        return [
            'weekday' => $this->faker->numberBetween(0, 6),
            'time' => sprintf('%02d:%s', $hour, $minute),
            'active' => $this->faker->boolean(),
        ];
    }
}
