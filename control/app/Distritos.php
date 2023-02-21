<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distritos extends Model
{
  public $incrementing = false;
  protected $table = 'distritos';
  protected $primaryKey = 'CODIGODISTRITO_C';
  protected $fillable	=	[
    'NAME',
    'CANTON_R_NAME',
    'CODIGODISTRITO_C'
  ];
  public $timestamps	=	false;
}
