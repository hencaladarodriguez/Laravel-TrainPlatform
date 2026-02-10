<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionEntrenamiento extends Model
{
    protected $table = 'sesion_entrenamiento';
    public $timestamps = false;

    protected $fillable = [
        'id_plan',
        'fecha',
        'nombre',
        'descripcion',
        'completada'
    ];

    public function plan()
    {
        return $this->belongsTo(
            PlanEntrenamiento::class,
            'id_plan'
        );
    }

    public function bloques()
    {
        return $this->hasMany(
            SesionBloque::class,
            'id_sesion_entrenamiento'
        );
    }
}
