<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
  protected $table = 'promociones';
  protected $primaryKey = 'id';
  protected $fillable	=	[
    'CodigoPromo',
    'tipoPlan',
    'habilitada'
  ];
  public $timestamps	=	false;
}
