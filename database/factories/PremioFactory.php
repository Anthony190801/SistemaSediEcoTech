<?php

namespace Database\Factories;

use App\Models\Articulo;
use App\Models\InstitucionProyecto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Premio>
 */
class PremioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipo = fake()->randomElement(['Canje por puntaje', 'Canje por Ranking']);

        return [
            'articulo_id' => Articulo::factory(),
            'institucion_proyecto_id' => InstitucionProyecto::factory(),
            'tipo' => $tipo,
            'puntaje_requerido' => $tipo === 'Canje por puntaje' ? fake()->numberBetween(100, 1000) : null,
            'posicion_requerida' => $tipo === 'Canje por Ranking' ? fake()->numberBetween(1, 10) : null,
            'estado' => fake()->randomElement(['Disponible', 'No disponible']),
        ];
    }
}
