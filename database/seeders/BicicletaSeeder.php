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
            'nombre' => 'Orbea Orca',
            'tipo' => 'Carretera',
            'comentario' => 'Bici principal competición'
        ]);

        Bicicleta::create([
            'nombre' => 'BH GravelX',
            'tipo' => 'Gravel',
            'comentario' => 'Entrenos mixtos'
        ]);
    }
}
