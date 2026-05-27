<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SesionBloque;
use App\Models\SesionEntrenamiento;
use App\Models\BloqueEntrenamiento;

class SesionBloqueSeeder extends Seeder
{
    public function run()
    {
        SesionBloque::query()->delete();

        $sesion  = SesionEntrenamiento::first();
        $bloques = BloqueEntrenamiento::take(2)->get();

        if (!$sesion || $bloques->isEmpty()) return;

        foreach ($bloques as $orden => $bloque) {
            SesionBloque::create([
                'id_sesion_entrenamiento' => $sesion->id,
                'id_bloque_entrenamiento' => $bloque->id,
                'orden'                   => $orden + 1,
                'repeticiones'            => 1
            ]);
        }
    }
}
