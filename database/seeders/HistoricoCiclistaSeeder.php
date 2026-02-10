<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistoricoCiclista;

class HistoricoCiclistaSeeder extends Seeder
{
    public function run()
    {
        HistoricoCiclista::query()->delete();

        HistoricoCiclista::create([
            'id_ciclista' => 1,
            'fecha' => '2026-01-01',
            'peso' => 70,
            'ftp' => 280,
            'pulso_max' => 185,
            'comentario' => 'Inicio temporada'
        ]);
    }
}
