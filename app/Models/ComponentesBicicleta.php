<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentesBicicleta extends Model
{
    protected $table = 'componentes_bicicleta';

    protected $fillable = [
        'id_bicicleta',
        'id_tipo_componente',
        'marca',
        'modelo',
        'especificacion',
        'velocidad',
        'posicion',
        'fecha_montaje',
        'fecha_retiro',
        'km_actuales',
        'km_max_recomendado',
        'activo',
        'comentario'
    ];

    public $timestamps = false;

    public function bicicleta()
    {
        return $this->belongsTo(
            Bicicleta::class,
            'id_bicicleta'
        );
    }

    public function tipo()
    {
        return $this->belongsTo(
            TipoComponente::class,
            'id_tipo_componente'
        );
    }
}
