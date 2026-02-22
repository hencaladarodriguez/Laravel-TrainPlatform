<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanEntrenamiento;
use App\Models\Ciclista;

class PlanSeeder extends Seeder
{
    public function run()
    {
        PlanEntrenamiento::query()->delete();

        $ciclistas = Ciclista::all();

        foreach ($ciclistas as $ciclista) {

            PlanEntrenamiento::create([
                'id_ciclista' => $ciclista->id,
                'nombre' => 'Plan Base Aeróbica 2026',
                'descripcion' => 'Mejora de resistencia y base aeróbica',
                'fecha_inicio' => '2026-01-01',
                'fecha_fin' => '2026-03-31',
                'objetivo' => 'Base aeróbica',
                'activo' => 1
            ]);
        }
    }
}
