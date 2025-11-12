<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materiales = [
            ['nombre' => 'Plástico PET', 'url_foto' => null],
            ['nombre' => 'Papel', 'url_foto' => null],
            ['nombre' => 'Cartón', 'url_foto' => null],
            ['nombre' => 'Vidrio', 'url_foto' => null],
            ['nombre' => 'Latas de aluminio', 'url_foto' => null],
            ['nombre' => 'Baterías pequeñas', 'url_foto' => null],
        ];

        foreach ($materiales as $material) {
            \App\Models\Material::firstOrCreate(
                ['nombre' => $material['nombre']],
                $material
            );
        }
    }
}
