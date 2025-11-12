<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personas = \App\Models\Persona::all();
        $personasUsadas = [];

        // Crear 3 administradores
        for ($i = 0; $i < 3; $i++) {
            $persona = $personas->whereNotIn('id', $personasUsadas)->random();
            $personasUsadas[] = $persona->id;
            $nombreCompleto = $persona->nombres.' '.$persona->apellidos;
            $email = strtolower(str_replace(' ', '.', $nombreCompleto)).'@sediecotech.com';

            \App\Models\User::firstOrCreate(
                ['email' => $email],
                [
                    'persona_id' => $persona->id,
                    'name' => $nombreCompleto,
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'profile_picture' => null,
                    'status_user' => 'Activo',
                    'rol' => 'Administrador',
                ]
            );
        }

        // Crear 20 usuarios participantes
        for ($i = 0; $i < 20; $i++) {
            $persona = $personas->whereNotIn('id', $personasUsadas)->random();
            $personasUsadas[] = $persona->id;
            $nombreCompleto = $persona->nombres.' '.$persona->apellidos;
            $email = strtolower(str_replace(' ', '.', $nombreCompleto)).'@participante.com';

            \App\Models\User::firstOrCreate(
                ['email' => $email],
                [
                    'persona_id' => $persona->id,
                    'name' => $nombreCompleto,
                    'password' => \Illuminate\Support\Facades\Hash::make('password'),
                    'profile_picture' => null,
                    'status_user' => 'Activo',
                    'rol' => 'Usuario',
                ]
            );
        }
    }
}
