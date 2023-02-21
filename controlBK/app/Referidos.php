<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referidos extends Model
{
    protected $table = 'registrosreferidos';
    protected $primaryKey = 'id';
    protected $fillable	=	[
      'cedula',
      'nombre',
      'apellido1',
      'apellido2',
      'telefono',
      'parentesco',
      "codigoReferido",
      "numeroReferente",
      "email",
    ];
    public $timestamps	=	false;
}
