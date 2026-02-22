<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Ciclista extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'ciclista';

    protected $fillable = [
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'peso_base',
        'altura_base',
        'email',
        'password'
    ];

    public $timestamps = false;
    protected $hidden = [
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
