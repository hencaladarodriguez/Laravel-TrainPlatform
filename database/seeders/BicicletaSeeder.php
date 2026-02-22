<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bicicleta;

class BicicletaSeeder extends Seeder
{
    public function run()
    {
        Bicicleta::query()->delete();

        Bicicleta::create([
            'id_ciclista' => 1,
            'nombre' => 'Orbea Orca',
            'tipo' => 'Carretera',
            'comentario' => 'Bici principal competición'
        ]);

        Bicicleta::create([
            'id_ciclista' => 2,
            'nombre' => 'BH GravelX',
            'tipo' => 'Gravel',
            'comentario' => 'Entrenos mixtos'
        ]);
    }
}
