<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincias extends Model
{
    public $incrementing = false;
    protected $table = 'provincias';
    protected $primaryKey = 'CODIGOPROVINCIA';
    protected $fillable	=	[
      'NAME',
      'CODIGOPROVINCIA'
    ];
    public $timestamps	=	false;
}
