<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    protected $table = 'bicicleta';

    protected $fillable = [
        'id_ciclista',
        'nombre',
        'tipo',
        'comentario'
    ];

    public $timestamps = false;

    public function componentes()
    {
        return $this->hasMany(
            ComponentesBicicleta::class,
            'id_bicicleta'
        );
    }
}
