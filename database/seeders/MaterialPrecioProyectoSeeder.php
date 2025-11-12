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
        $materiales = \App\Models\Material::all();
        $proyectos = \App\Models\Proyecto::where('estado', 'Activo')->get();

        // Regla de negocio: Un proyecto solo puede tener UN MaterialPrecio activo por material
        // Aunque la BD soporte más de uno, la regla es que solo uno esté activo por proyecto
        foreach ($materiales as $material) {
            // Obtener el precio activo del material (si existe)
            $materialPrecioActivo = \App\Models\MaterialPrecio::where('material_id', $material->id)
                ->where('fecha_inicio', '<=', now())
                ->where(function ($q) {
                    $q->whereNull('fecha_fin')
                        ->orWhere('fecha_fin', '>=', now());
                })
                ->first();

            // Si existe un precio activo, asociarlo con proyectos
            if ($materialPrecioActivo) {
                // Cada material se asociará con 1-3 proyectos aleatorios
                $numProyectos = fake()->numberBetween(1, min(3, $proyectos->count()));
                $proyectosAsignados = $proyectos->random($numProyectos);

                foreach ($proyectosAsignados as $proyecto) {
                    // Verificar que no exista ya un MaterialPrecio activo para este material en este proyecto
                    // Esta es la regla de negocio: solo UN MaterialPrecio activo por material por proyecto
                    $existePrecioActivo = DB::table('material_precio_proyecto')
                        ->join('material_precio', 'material_precio_proyecto.material_precio_id', '=', 'material_precio.id')
                        ->where('material_precio.material_id', $material->id)
                        ->where('material_precio_proyecto.proyecto_id', $proyecto->id)
                        ->where('material_precio.fecha_inicio', '<=', now())
                        ->where(function ($q) {
                            $q->whereNull('material_precio.fecha_fin')
                                ->orWhere('material_precio.fecha_fin', '>=', now());
                        })
                        ->exists();

                    // Solo asociar si no existe ya un precio activo para este material en este proyecto
                    if (! $existePrecioActivo) {
                        // Verificar que no exista ya la relación en la tabla pivot
                        $existeRelacion = DB::table('material_precio_proyecto')
                            ->where('material_precio_id', $materialPrecioActivo->id)
                            ->where('proyecto_id', $proyecto->id)
                            ->exists();

                        if (! $existeRelacion) {
                            $materialPrecioActivo->proyectos()->attach($proyecto->id);
                        }
                    }
                }
            }
        }
    }
}
