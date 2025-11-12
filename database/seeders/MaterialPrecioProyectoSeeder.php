<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialPrecioProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materialPrecios = \App\Models\MaterialPrecio::all();
        $proyectos = \App\Models\Proyecto::all();

        // Asociar material_precio con proyectos
        foreach ($materialPrecios as $materialPrecio) {
            $numProyectos = fake()->numberBetween(1, 3);
            $proyectosAsignados = $proyectos->random($numProyectos);

            foreach ($proyectosAsignados as $proyecto) {
                // Verificar que no exista ya la relación usando la tabla pivot
                $existe = DB::table('material_precio_proyecto')
                    ->where('material_precio_id', $materialPrecio->id)
                    ->where('proyecto_id', $proyecto->id)
                    ->exists();

                if (! $existe) {
                    $materialPrecio->proyectos()->attach($proyecto->id);
                }
            }
        }
    }
}
