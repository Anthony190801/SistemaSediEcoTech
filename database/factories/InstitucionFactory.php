<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Institucion>
 */
class InstitucionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = [
            'I.E. Santa Rosa',
            'Colegio San Juan Bautista',
            'Instituto Tecnológico Trujillo',
            'Universidad Nacional de Trujillo',
            'I.E. San Martín de Porres',
        ];
        $niveles = ['Educacion Basica', 'Educacion Media Superior', 'Educacion Superior'];
        $direcciones = [
            'Av. España 1234, Trujillo',
            'Jr. Pizarro 567, Trujillo',
            'Av. Larco 890, Trujillo',
            'Campus Universitario, Trujillo',
            'Av. América Norte 234, Trujillo',
        ];

        return [
            'nombre' => fake()->randomElement($nombres),
            'direccion' => fake()->randomElement($direcciones),
            'nivel' => fake()->randomElement($niveles),
        ];
    }
}
