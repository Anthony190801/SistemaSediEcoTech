<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 8 precios diferentes entre 0.5 y 3.5 soles
        $precios = [0.5, 0.8, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5];

        foreach ($precios as $precio) {
            \App\Models\Precio::create([
                'cantidad_soles' => $precio,
            ]);
        }
    }
}
