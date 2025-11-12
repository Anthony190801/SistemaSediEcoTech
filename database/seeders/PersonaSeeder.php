<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Persona::factory(30)->create();
    }
}
