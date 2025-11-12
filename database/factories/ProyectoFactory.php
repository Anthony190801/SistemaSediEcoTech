<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = ['SEDIECOTECH 1.0', 'SEDIECOTECH 2.0', 'Rebonatura', 'EcoCampus'];
        $estados = ['Activo', 'Inactivo'];

        return [
            'nombre' => fake()->randomElement($nombres),
            'url_logo' => fake()->optional()->imageUrl(200, 200, 'business', true, 'SEDIECOTECH'),
            'estado' => fake()->randomElement($estados),
        ];
    }
}
