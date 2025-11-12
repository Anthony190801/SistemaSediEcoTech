<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articulo>
 */
class ArticuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $articulos = [
            ['nombre' => 'Cuaderno ecológico', 'precio' => 15.00],
            ['nombre' => 'Tomatodo reciclado', 'precio' => 25.00],
            ['nombre' => 'Polo de SEDIPRO', 'precio' => 35.00],
            ['nombre' => 'Mochila reciclada', 'precio' => 80.00],
            ['nombre' => 'Audífonos Eco', 'precio' => 45.00],
            ['nombre' => 'Bolsa reutilizable', 'precio' => 12.00],
            ['nombre' => 'Termo de acero inoxidable', 'precio' => 50.00],
            ['nombre' => 'Kit de semillas', 'precio' => 20.00],
            ['nombre' => 'Libreta artesanal', 'precio' => 18.00],
            ['nombre' => 'Lápiz ecológico', 'precio' => 5.00],
        ];

        $articulo = fake()->randomElement($articulos);

        return [
            'nombre' => $articulo['nombre'],
            'url_foto' => fake()->imageUrl(400, 400, 'objects', true, 'Articulo'),
            'precio' => $articulo['precio'],
        ];
    }
}
