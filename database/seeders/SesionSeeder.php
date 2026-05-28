<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SesionEntrenamiento;

class SesionSeeder extends Seeder
{
    public function run(): void
    {
        SesionEntrenamiento::create([
            'id_plan' => 1,
            'fecha' => '2026-01-03',
            'nombre' => 'Rodaje aeróbico',
            'descripcion' => 'Sesión continua',
            'completada' => 1
        ]);

        SesionEntrenamiento::create([
            'id_plan' => 1,
            'fecha' => '2026-01-05',
            'nombre' => 'Series cortas',
            'descripcion' => 'Trabajo de intensidad',
            'completada' => 0
        ]);
    }
}
