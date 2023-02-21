<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
  public $incrementing = false;
  protected $table = 'beneficiario';
  protected $primaryKey = 'persona_cedula';
  protected $fillable	=	[
    'persona_cedula',
    'afiliado_cedula',
    'parentesco',
    'oncosmart',
    'NumeroBeneficiaro',
    'estadoBeneficiario',
    'fechaUltimaInactivacion',
    'fechaUltimaInactivacionOncosmart',
    'idBen',
    'tipoCobertura',
    'password',
    'changePassword',
  ];
  public $timestamps	=	false;
}
