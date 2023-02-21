<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuponesAplicados extends Model
{
    protected $table = 'cupones_aplicados';
    protected $fillable	=	[
        'codigoCupon',
        'descuento',
        'cli',
        'fecha',
        'cedula',
    ];
}
