<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistoricoCiclista;
use App\Models\Ciclista;

class HistoricoCiclistaSeeder extends Seeder
{
    public function run()
    {
        HistoricoCiclista::query()->delete();

        $ciclista = Ciclista::first();
        if (!$ciclista) return;

        HistoricoCiclista::create([
            'id_ciclista' => $ciclista->id,
            'fecha'       => '2026-01-01',
            'peso'        => 70,
            'ftp'         => 280,
            'pulso_max'   => 185,
            'comentario'  => 'Inicio temporada'
        ]);
    }
}
