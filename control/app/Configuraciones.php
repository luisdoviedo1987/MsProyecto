<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuraciones extends Model
{
    protected $table = 'configuraciones';
    protected $primaryKey = 'id_configuracion';
    protected $fillable	=	[
        'key_configuracion',
        'valor_configuracion'
    ];
    public $timestamps	=	false;
}
