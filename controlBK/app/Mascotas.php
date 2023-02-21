<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascotas extends Model
{
  protected $table = 'mascotas';
  protected $primaryKey = 'id';
  protected $fillable	=	[
    'persona_cedula',
    'nombre',
    'especie',
    'raza',
    'genero',
    'edad',
    'color',
    'idPet'
  ];
  public $timestamps	=	false;
}
