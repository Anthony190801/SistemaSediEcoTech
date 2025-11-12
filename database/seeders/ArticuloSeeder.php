<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articulos = [
            ['nombre' => 'Cuaderno ecológico', 'url_foto' => null, 'precio' => 15.00],
            ['nombre' => 'Tomatodo reciclado', 'url_foto' => null, 'precio' => 25.00],
            ['nombre' => 'Polo de SEDIPRO', 'url_foto' => null, 'precio' => 35.00],
            ['nombre' => 'Mochila reciclada', 'url_foto' => null, 'precio' => 80.00],
            ['nombre' => 'Audífonos Eco', 'url_foto' => null, 'precio' => 45.00],
            ['nombre' => 'Bolsa reutilizable', 'url_foto' => null, 'precio' => 12.00],
            ['nombre' => 'Termo de acero inoxidable', 'url_foto' => null, 'precio' => 50.00],
            ['nombre' => 'Kit de semillas', 'url_foto' => null, 'precio' => 20.00],
            ['nombre' => 'Libreta artesanal', 'url_foto' => null, 'precio' => 18.00],
            ['nombre' => 'Lápiz ecológico', 'url_foto' => null, 'precio' => 5.00],
        ];

        foreach ($articulos as $articulo) {
            \App\Models\Articulo::create($articulo);
        }
    }
}
