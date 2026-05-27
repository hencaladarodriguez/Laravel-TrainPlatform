<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bicicleta;
use App\Models\Ciclista;

class BicicletaSeeder extends Seeder
{
    public function run()
    {
        Bicicleta::query()->delete();

        $bicicletas = [
            ['nombre' => 'Orbea Orca',  'tipo' => 'Carretera', 'comentario' => 'Bici principal competición'],
            ['nombre' => 'BH GravelX', 'tipo' => 'Gravel',    'comentario' => 'Entrenos mixtos'],
        ];

        foreach (Ciclista::all() as $index => $ciclista) {
            $datos = $bicicletas[$index] ?? $bicicletas[0];
            Bicicleta::create([
                'id_ciclista' => $ciclista->id,
                'nombre'      => $datos['nombre'],
                'tipo'        => $datos['tipo'],
                'comentario'  => $datos['comentario'],
            ]);
        }
    }
}
