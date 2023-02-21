<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cantones extends Model
{
  public $incrementing = false;
  protected $table = 'cantones';
  protected $primaryKey = 'CODIGOCANTON_C';
  protected $fillable	=	[
    'NAME',
    'CODIGOCANTON_C',
    'PROVINCIA_R_NAME'
  ];
  public $timestamps	=	false;
}
