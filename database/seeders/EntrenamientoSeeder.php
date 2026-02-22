<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entrenamiento;
use App\Models\SesionEntrenamiento;
use App\Models\Bicicleta;

class EntrenamientoSeeder extends Seeder
{
    public function run(): void
    {
        Entrenamiento::query()->delete();

        $sesiones = SesionEntrenamiento::with('plan')->get();

        foreach ($sesiones as $sesion) {

            $ciclistaId = $sesion->plan->id_ciclista;

            $bicicleta = Bicicleta::where('id_ciclista', $ciclistaId)->first();

            if (!$bicicleta) {
                continue;
            }

            Entrenamiento::create([
                'id_ciclista' => $ciclistaId,
                'id_bicicleta' => $bicicleta->id,
                'id_sesion' => $sesion->id,

                'fecha' => '2026-01-01 07:30:00',
                'duracion' => '01:45:00',
                'kilometros' => 55.2,
                'recorrido' => 'Ruta Valle',

                'pulso_medio' => 140,
                'pulso_max' => 170,
                'potencia_media' => 200,
                'potencia_normalizada' => 210,
                'velocidad_media' => 31.5,

                'puntos_estres_tss' => 60.5,
                'factor_intensidad_if' => 0.88,
                'ascenso_metros' => 800,

                'comentario' => 'Buen ritmo matutino'
            ]);
        }
    }
}