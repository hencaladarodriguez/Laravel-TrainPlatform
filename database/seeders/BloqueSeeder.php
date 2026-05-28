<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BloqueEntrenamiento;
use App\Models\Ciclista;

class BloqueSeeder extends Seeder
{
    public function run()
    {
        BloqueEntrenamiento::query()->delete();

        $ciclistas = Ciclista::all();

        foreach ($ciclistas as $ciclista) {

            BloqueEntrenamiento::create([
                'id_ciclista' => $ciclista->id,
                'nombre' => 'Calentamiento',
                'descripcion' => 'Rodaje suave progresivo',
                'tipo' => 'rodaje',
                'duracion_estimada' => '00:15:00',
                'potencia_pct_min' => 55,
                'potencia_pct_max' => 65,
                'pulso_pct_max' => 70,
                'pulso_reserva_pct' => 50,
                'comentario' => 'Subir pulsaciones gradualmente'
            ]);

            BloqueEntrenamiento::create([
                'id_ciclista' => $ciclista->id,
                'nombre' => 'Rodaje Z2',
                'descripcion' => 'Resistencia aeróbica',
                'tipo' => 'rodaje',
                'duracion_estimada' => '01:00:00',
                'potencia_pct_min' => 65,
                'potencia_pct_max' => 75,
                'pulso_pct_max' => 80,
                'pulso_reserva_pct' => 65,
                'comentario' => 'Base aeróbica'
            ]);
        }
    }
}