<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instituciones = [
            [
                'nombre' => 'I.E. Santa Rosa',
                'direccion' => 'Av. España 1234, Trujillo',
                'nivel' => 'Educacion Basica',
            ],
            [
                'nombre' => 'Colegio San Juan Bautista',
                'direccion' => 'Jr. Pizarro 567, Trujillo',
                'nivel' => 'Educacion Media Superior',
            ],
            [
                'nombre' => 'Instituto Tecnológico Trujillo',
                'direccion' => 'Av. Larco 890, Trujillo',
                'nivel' => 'Educacion Media Superior',
            ],
            [
                'nombre' => 'Universidad Nacional de Trujillo',
                'direccion' => 'Campus Universitario, Trujillo',
                'nivel' => 'Educacion Superior',
            ],
            [
                'nombre' => 'I.E. San Martín de Porres',
                'direccion' => 'Av. América Norte 234, Trujillo',
                'nivel' => 'Educacion Basica',
            ],
        ];

        foreach ($instituciones as $institucion) {
            \App\Models\Institucion::create($institucion);
        }
    }
}
