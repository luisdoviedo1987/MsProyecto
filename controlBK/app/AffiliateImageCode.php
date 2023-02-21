<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateImageCode extends Model
{
  protected $table = 'affiliate_image_code';
  protected $primaryKey = 'id';
  protected $fillable	=	[
    'pageCode',
    'imagePath',
    'active'
  ];
  public $timestamps	=	false;
}