<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $table = 'convenios';
    protected $fillable	=	[
        'convenio',
    ];
    public $timestamps	=	false;
}
