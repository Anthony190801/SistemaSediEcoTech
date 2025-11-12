<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaterialPrecioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materiales = \App\Models\Material::all();
        $precios = \App\Models\Precio::all();

        // Asociar cada material con varios precios
        foreach ($materiales as $material) {
            $numPrecios = fake()->numberBetween(2, 4);
            $preciosAsignados = $precios->random($numPrecios);

            foreach ($preciosAsignados as $precio) {
                // Verificar que no exista ya la relación
                $existe = \App\Models\MaterialPrecio::where('material_id', $material->id)
                    ->where('precio_id', $precio->id)
                    ->exists();

                if (! $existe) {
                    $fechaInicio = fake()->dateTimeBetween('-6 months', 'now');
                    $fechaFin = fake()->optional(0.2)->dateTimeBetween($fechaInicio, '+3 months');
                    $puntaje = (int) ($precio->cantidad_soles * 10);

                    \App\Models\MaterialPrecio::create([
                        'material_id' => $material->id,
                        'precio_id' => $precio->id,
                        'puntaje' => $puntaje,
                        'fecha_inicio' => $fechaInicio->format('Y-m-d'),
                        'fecha_fin' => $fechaFin ? $fechaFin->format('Y-m-d') : null,
                    ]);
                }
            }
        }
    }
}
