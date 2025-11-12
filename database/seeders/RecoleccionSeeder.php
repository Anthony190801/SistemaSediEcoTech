<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecoleccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $participantes = \App\Models\Participante::all();
        $materialPrecios = \App\Models\MaterialPrecio::all();
        $estados = ['Pendiente', 'Validado', 'Rechazado'];

        // Crear al menos 100 recolecciones
        for ($i = 0; $i < 100; $i++) {
            $participante = $participantes->random();
            $materialPrecio = $materialPrecios->random();
            $cantidadKg = fake()->randomFloat(2, 0.1, 5.0);
            $fecha = fake()->dateTimeBetween('-6 months', 'now');
            $estado = fake()->randomElement(['Validado', 'Pendiente']);

            \App\Models\Recoleccion::create([
                'participante_id' => $participante->id,
                'material_precio_id' => $materialPrecio->id,
                'cantidad_kilogramos' => $cantidadKg,
                'fecha' => $fecha->format('Y-m-d'),
                'estado' => $estado,
            ]);
        }
    }
}
