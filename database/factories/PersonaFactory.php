<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persona>
 */
class PersonaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sexo = fake()->randomElement(['Masculino', 'Femenino']);
        $nombresMasculinos = ['Juan', 'Carlos', 'Luis', 'Miguel', 'José', 'Pedro', 'Fernando', 'Roberto', 'Ricardo', 'Daniel', 'Andrés', 'Diego', 'Alejandro', 'Mario', 'Jorge'];
        $nombresFemeninos = ['María', 'Ana', 'Carmen', 'Laura', 'Patricia', 'Sandra', 'Lucía', 'Elena', 'Rosa', 'Mónica', 'Andrea', 'Diana', 'Gabriela', 'Natalia', 'Valeria'];
        $apellidos = ['García', 'Rodríguez', 'López', 'Martínez', 'González', 'Pérez', 'Sánchez', 'Ramírez', 'Torres', 'Flores', 'Rivera', 'Gómez', 'Díaz', 'Cruz', 'Morales', 'Ortiz', 'Ramos', 'Vargas', 'Mendoza', 'Herrera'];

        return [
            'dni' => fake()->unique()->numerify('########'),
            'nombres' => $sexo === 'Masculino' ? fake()->randomElement($nombresMasculinos) : fake()->randomElement($nombresFemeninos),
            'apellidos' => fake()->randomElement($apellidos).' '.fake()->randomElement($apellidos),
            'sexo' => $sexo,
        ];
    }
}
