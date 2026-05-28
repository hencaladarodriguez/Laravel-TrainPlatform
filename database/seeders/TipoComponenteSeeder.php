<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoComponente;

class TipoComponenteSeeder extends Seeder
{
    public function run()
    {
        // limpiar la tabla
        TipoComponente::query()->delete(); 

        TipoComponente::create(['nombre' => 'Cambio', 'descripcion' => 'Sistema de cambio de marchas']);
        TipoComponente::create(['nombre' => 'Rueda', 'descripcion' => 'Rueda y llanta']);
        TipoComponente::create(['nombre' => 'Freno', 'descripcion' => 'Sistema de frenado']);
    }
}
