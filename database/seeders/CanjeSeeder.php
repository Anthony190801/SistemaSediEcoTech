<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CanjeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premios = \App\Models\Premio::all();
        $participantes = \App\Models\Participante::all();
        $respuestas = \App\Models\Respuesta::all();
        $estados = ['Pendiente', 'Programado', 'Entregado'];

        // Crear algunos canjes realizados
        for ($i = 0; $i < 15; $i++) {
            $premio = $premios->random();
            $participante = $participantes->random();
            $fechaSolicitud = fake()->dateTimeBetween('-3 months', 'now');
            $estado = fake()->randomElement($estados);
            $respuesta = null;
            $fechaEntrega = null;

            if ($estado === 'Programado' || $estado === 'Entregado') {
                $respuesta = $respuestas->random();
            }

            if ($estado === 'Entregado') {
                $fechaEntrega = fake()->dateTimeBetween($fechaSolicitud, 'now');
            }

            \App\Models\Canje::create([
                'premio_id' => $premio->id,
                'participante_id' => $participante->id,
                'fecha_solicitud_canje' => $fechaSolicitud->format('Y-m-d'),
                'estado' => $estado,
                'respuesta_id' => $respuesta?->id,
                'fecha_entrega' => $fechaEntrega?->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
