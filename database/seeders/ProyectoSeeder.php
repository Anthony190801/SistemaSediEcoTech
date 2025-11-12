<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyectos = [
            [
                'nombre' => 'SEDIECOTECH 1.0',
                'url_logo' => null,
                'estado' => 'Activo',
            ],
            [
                'nombre' => 'SEDIECOTECH 2.0',
                'url_logo' => null,
                'estado' => 'Activo',
            ],
            [
                'nombre' => 'Rebonatura',
                'url_logo' => null,
                'estado' => 'Activo',
            ],
            [
                'nombre' => 'EcoCampus',
                'url_logo' => null,
                'estado' => 'Inactivo',
            ],
        ];

        foreach ($proyectos as $proyecto) {
            \App\Models\Proyecto::create($proyecto);
        }
    }
}
