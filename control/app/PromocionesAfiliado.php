<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromocionesAfiliado extends Model
{
    protected $table = 'promociones_afiliado';
    protected $primaryKey = 'id_promocion_afiliado';
    protected $fillable	=	[
        'cli',
        'nombre',
        'email',
        'codigo',
        'activado'
    ];
    public $timestamps	=	false;
}
