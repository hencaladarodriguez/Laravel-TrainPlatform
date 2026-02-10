<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComponentesBicicleta;

class ComponentesBicicletaSeeder extends Seeder
{
    public function run()
    {
        ComponentesBicicleta::query()->delete();

        ComponentesBicicleta::create([
            'id_bicicleta' => 1,
            'id_tipo_componente' => 1,
            'marca' => 'Shimano',
            'modelo' => 'Ultegra',
            'fecha_montaje' => '2026-01-01',
            'km_actuales' => 0,
            'km_max_recomendado' => 4000,
            'activo' => 1
        ]);


        ComponentesBicicleta::create([
            'id_bicicleta' => 1,
            'id_tipo_componente' => 2,
            'marca' => 'Mavic',
            'modelo' => 'Ksyrium',
            'fecha_montaje' => '2026-01-01',
            'km_actuales' => 0,
            'km_max_recomendado' => 20000,
            'activo' => 1
        ]);
    }
}
