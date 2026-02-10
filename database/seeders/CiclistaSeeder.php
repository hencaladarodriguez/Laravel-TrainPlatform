<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciclista;

class CiclistaSeeder extends Seeder
{
    public function run()
    {
        Ciclista::query()->delete(); // Limpiar tabla antes de insertar

        Ciclista::create([
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'fecha_nacimiento' => '1990-05-10',
            'peso_base' => 70.5,
            'altura_base' => 175,
            'email' => 'test1@prueba.com',
            'password' => 'prueba'
        ]);

        Ciclista::create([
            'nombre' => 'Ana',
            'apellidos' => 'Rodríguez',
            'fecha_nacimiento' => '1992-08-20',
            'peso_base' => 60.0,
            'altura_base' => 165,
            'email' => 'test2@prueba.com',
            'password' => 'prueba'
        ]);

        // ... más ciclistas si quieres
    }
}
