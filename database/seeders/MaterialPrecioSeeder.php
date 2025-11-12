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

        // Un material puede tener múltiples MaterialPrecio (históricos)
        // Pero no puede repetir la combinación material_id + precio_id (restricción unique)
        foreach ($materiales as $material) {
            // Crear 1-3 precios históricos por material
            $numPrecios = fake()->numberBetween(1, 3);
            $preciosAsignados = $precios->random(min($numPrecios, $precios->count()));

            foreach ($preciosAsignados as $precio) {
                // Verificar que no exista ya la combinación material_id + precio_id (restricción unique)
                $existe = \App\Models\MaterialPrecio::where('material_id', $material->id)
                    ->where('precio_id', $precio->id)
                    ->exists();

                if (! $existe) {
                    // Crear precios con diferentes fechas (algunos históricos, algunos activos)
                    $fechaInicio = fake()->dateTimeBetween('-12 months', 'now');
                    // 70% de probabilidad de que tenga fecha_fin (precio histórico)
                    // 30% de probabilidad de que no tenga fecha_fin (precio activo)
                    $fechaFin = fake()->optional(0.7)->dateTimeBetween($fechaInicio, '+6 months');
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
