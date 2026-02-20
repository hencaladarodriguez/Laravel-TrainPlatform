<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CiclistaSeeder::class);
        $this->call(BicicletaSeeder::class);
        $this->call(TipoComponenteSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(SesionSeeder::class);
        $this->call(BloqueSeeder::class);
        $this->call(SesionBloqueSeeder::class);
        $this->call(EntrenamientoSeeder::class);
        $this->call(ComponentesBicicletaSeeder::class);
        $this->call(HistoricoCiclistaSeeder::class);
    }
}