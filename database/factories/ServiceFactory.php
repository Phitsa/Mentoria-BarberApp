<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Corte Masculino',
                'Corte Degradê',
                'Corte Social',
                'Barba Tradicional',
                'Barba Completa',
                'Corte + Barba',
                'Pigmentação',
                'Sobrancelha',
                'Hidratação Capilar',
                'Platinado',
                'Corte Infantil',
                'Corte Feminino',
            ]),
            'admin_id' => Admin::inRandomOrder()->first()?->id,
            'price' => $this->faker->randomFloat(2, 25, 120),
        ];
    }
}
