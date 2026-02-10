<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoComponente extends Model
{
    protected $table = 'tipo_componente';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public $timestamps = false;

    public function componentes()
    {
        return $this->hasMany(
            ComponentesBicicleta::class,
            'id_tipo_componente'
        );
    }
}
