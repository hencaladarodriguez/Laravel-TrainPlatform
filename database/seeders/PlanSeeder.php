<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanEntrenamiento;

class PlanSeeder extends Seeder
{
    public function run()
    {
        // Limpiar tabla
        PlanEntrenamiento::query()->delete();

        PlanEntrenamiento::create([
            'id_ciclista' => 1,
            'nombre' => 'Plan Base Aeróbica 2026',
            'descripcion' => 'Mejora de resistencia y base aeróbica',
            'fecha_inicio' => '2026-01-01',
            'fecha_fin' => '2026-03-31',
            'objetivo' => 'Base aeróbica',
            'activo' => 1
        ]);

        PlanEntrenamiento::create([
            'id_ciclista' => 2,
            'nombre' => 'Plan Umbral 2026',
            'descripcion' => 'Trabajo de umbral y sweet spot',
            'fecha_inicio' => '2026-01-15',
            'fecha_fin' => '2026-04-15',
            'objetivo' => 'Mejorar FTP',
            'activo' => 1
        ]);
    }
}
