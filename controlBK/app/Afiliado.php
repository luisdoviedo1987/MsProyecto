<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
  protected $table = 'afiliado';
  public $incrementing = false;
  protected $primaryKey = 'persona_cedula';
  protected $fillable	=	[
    'persona_cedula',
    'usuario',
    'contrasena',
    'idFrecPago',
    'oncosmart',
    'cli',
    'estadoTitular',
    'fechaPago',
    'fechaUltimaInactivacionOncosmart',
    'formaPago',
    'frecuenciaPago',
    'tipoCobertura',
    'facturaSF',
    'convenio',
    'conveniocli',
    'estado_envio',
    'afiliacion_terminada',
    'codigo_referido',
    'changePassword',
  ];
  public $timestamps	=	false;
}
