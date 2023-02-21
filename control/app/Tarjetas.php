<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjetas extends Model
{
  protected $table = 'tarjetas';
  public $incrementing = false;
  protected $primaryKey = 'idTarjeta';
  protected $fillable	=	[
    'idTarjeta',
    'fechaVencimiento',
    'nombreTitular',
    'numeroTarjeta',
    'principal',
    'tipoTarjeta',
  ];
  public $timestamps	=	false;
}
