<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SesionEntrenamiento;
use App\Models\PlanEntrenamiento;

class SesionSeeder extends Seeder
{
    public function run(): void
    {
        SesionEntrenamiento::query()->delete();

        $plan = PlanEntrenamiento::first();
        if (!$plan) return;

        SesionEntrenamiento::create([
            'id_plan'     => $plan->id,
            'fecha'       => '2026-01-03',
            'nombre'      => 'Rodaje aeróbico',
            'descripcion' => 'Sesión continua',
            'completada'  => 1
        ]);

        SesionEntrenamiento::create([
            'id_plan'     => $plan->id,
            'fecha'       => '2026-01-05',
            'nombre'      => 'Series cortas',
            'descripcion' => 'Trabajo de intensidad',
            'completada'  => 0
        ]);
    }
}
