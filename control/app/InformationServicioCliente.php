<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformationServicioCliente extends Model
{
    //
    protected $table = 'informacion_servicio_cliente';
    protected $fillable	=	[
        'cli',
        'nombre',
        'cedula',
        'telefono',
        'correo',
    ];
    public $timestamps	=	false;
}
