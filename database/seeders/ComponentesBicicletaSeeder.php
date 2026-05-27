<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComponentesBicicleta;
use App\Models\Bicicleta;
use App\Models\TipoComponente;

class ComponentesBicicletaSeeder extends Seeder
{
    public function run()
    {
        ComponentesBicicleta::query()->delete();

        $bicicleta = Bicicleta::first();
        if (!$bicicleta) return;

        $cambio = TipoComponente::where('nombre', 'Cambio')->first();
        $rueda  = TipoComponente::where('nombre', 'Rueda')->first();

        if ($cambio) {
            ComponentesBicicleta::create([
                'id_bicicleta'       => $bicicleta->id,
                'id_tipo_componente' => $cambio->id,
                'marca'              => 'Shimano',
                'modelo'             => 'Ultegra',
                'fecha_montaje'      => '2026-01-01',
                'km_actuales'        => 0,
                'km_max_recomendado' => 4000,
                'activo'             => 1
            ]);
        }

        if ($rueda) {
            ComponentesBicicleta::create([
                'id_bicicleta'       => $bicicleta->id,
                'id_tipo_componente' => $rueda->id,
                'marca'              => 'Mavic',
                'modelo'             => 'Ksyrium',
                'fecha_montaje'      => '2026-01-01',
                'km_actuales'        => 0,
                'km_max_recomendado' => 20000,
                'activo'             => 1
            ]);
        }
    }
}
