<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoComponente;

class TipoComponenteSeeder extends Seeder
{
    public function run()
    {
        TipoComponente::query()->delete(); // limpiar la tabla

        TipoComponente::create(['nombre' => 'Cambio', 'descripcion' => 'Sistema de cambio de marchas']);
        TipoComponente::create(['nombre' => 'Rueda', 'descripcion' => 'Rueda y llanta']);
        TipoComponente::create(['nombre' => 'Freno', 'descripcion' => 'Sistema de frenado']);
    }
}
