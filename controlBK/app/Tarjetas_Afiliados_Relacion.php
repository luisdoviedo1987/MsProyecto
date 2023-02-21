<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjetas_Afiliados_Relacion extends Model
{
  protected $table = 'tarjetas_afiliado_relacion';
  protected $primaryKey = 'id';
  protected $fillable	=	[
    'idTarjeta',
    'numeroCliente',
  ];
  public $timestamps	=	false;
}
