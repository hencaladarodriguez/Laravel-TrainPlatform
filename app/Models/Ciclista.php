<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclista extends Model
{
    protected $table = 'ciclista';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'peso_base',
        'altura_base',
        'email',
        'password'
    ];

    // Planes
    public function planes()
    {
        return $this->hasMany(
            PlanEntrenamiento::class,
            'id_ciclista'
        );
    }

    // Entrenamientos realizados
    public function entrenamientos()
    {
        return $this->hasMany(
            Entrenamiento::class,
            'id_ciclista'
        );
    }

    // Histórico físico
    public function historicos()
    {
        return $this->hasMany(
            HistoricoCiclista::class,
            'id_ciclista'
        );
    }
}
