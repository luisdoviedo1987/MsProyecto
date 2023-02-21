<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity_Log extends Model
{
  protected $table = 'activity_log';
  protected $fillable	=	[
    'usuario',
    'cliente',
    'descripcion',
    'log',
    'ultimo_dato',
    'session'
  ];
}
