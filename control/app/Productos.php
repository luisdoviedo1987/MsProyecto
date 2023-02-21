<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $fillable	=	[
            'nombre',
            'descripcion',
            'precio',
            'precio_semestral',
            'precio_anual',
            'isActive'
        ];
    public $timestamps	=	false;
}
