<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PersonaSeeder::class,
            UserSeeder::class,
            InstitucionSeeder::class,
            ProyectoSeeder::class,
            InstitucionProyectoSeeder::class,
            ParticipanteSeeder::class,
            MaterialSeeder::class,
            PrecioSeeder::class,
            MaterialPrecioSeeder::class,
            MaterialPrecioProyectoSeeder::class,
            RecoleccionSeeder::class,
            ArticuloSeeder::class,
            PremioSeeder::class,
            RespuestaSeeder::class,
            CanjeSeeder::class,
            AnuncioSeeder::class,
        ]);
    }
}
