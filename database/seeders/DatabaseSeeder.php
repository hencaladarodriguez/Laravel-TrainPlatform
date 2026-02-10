<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CiclistaSeeder::class);
        $this->call(BicicletaSeeder::class);
        $this->call(TipoComponenteSeeder::class);  // <- nuevo
        $this->call(PlanSeeder::class);
        $this->call(SesionSeeder::class);
        $this->call(BloqueSeeder::class);
        $this->call(EntrenamientoSeeder::class);
        $this->call(ComponentesBicicletaSeeder::class); // ahora seguro
        $this->call(HistoricoCiclistaSeeder::class);


    }
}
