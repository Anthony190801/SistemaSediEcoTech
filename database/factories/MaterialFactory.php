<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $materiales = [
            'Plástico PET',
            'Papel',
            'Cartón',
            'Vidrio',
            'Latas de aluminio',
            'Baterías pequeñas',
        ];

        return [
            'nombre' => fake()->unique()->randomElement($materiales),
            'url_foto' => fake()->optional()->imageUrl(300, 300, 'nature', true, 'Material'),
        ];
    }
}
