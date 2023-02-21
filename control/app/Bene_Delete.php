<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bene_Delete extends Model
{
  public $incrementing = false;
  protected $table = 'bene_delete';
  protected $primaryKey = 'beneCedula';
  protected $fillable	=	[
    'beneCedula',
    'date_delete',
    'date_renew'
  ];
  public $timestamps	=	false;
}
