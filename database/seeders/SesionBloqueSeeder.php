<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SesionBloque;

class SesionBloqueSeeder extends Seeder
{
    public function run()
    {
        SesionBloque::query()->delete();

        SesionBloque::create([
            'id_sesion_entrenamiento' => 1,
            'id_bloque_entrenamiento' => 1,
            'orden' => 1,
            'repeticiones' => 1
        ]);

        SesionBloque::create([
            'id_sesion_entrenamiento' => 1,
            'id_bloque_entrenamiento' => 2,
            'orden' => 2,
            'repeticiones' => 1
        ]);
    }
}
