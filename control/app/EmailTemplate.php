<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $table = 'email_templates';
    protected $fillable	=	[
      'nombre',
      'subject',
      'content'
    ];
    public $timestamps	=	false;
}
