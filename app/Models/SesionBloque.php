<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesionBloque extends Model
{
    protected $table = 'sesion_bloque';

    protected $fillable = [
        'id_sesion_entrenamiento',
        'id_bloque_entrenamiento',
        'orden',
        'repeticiones'
    ];

    public $timestamps = false;

    public function sesion()
    {
        return $this->belongsTo(
            SesionEntrenamiento::class,
            'id_sesion_entrenamiento'
        );
    }

    public function bloque()
    {
        return $this->belongsTo(
            BloqueEntrenamiento::class,
            'id_bloque_entrenamiento'
        );
    }
}
