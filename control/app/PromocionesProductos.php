<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromocionesProductos extends Model
{
    protected $table = 'promociones_productos_relacion';
    protected $primaryKey = 'id';
    protected $fillable	=	[
      'codigo_tabla_promocion',
      'codigo_tabla_prodcortdes',
      'meses'
    ];
    public $timestamps	=	false;
}
