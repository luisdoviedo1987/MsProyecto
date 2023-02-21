<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'personas';
    public $incrementing = false;
    protected $primaryKey = 'cedula';
    protected $fillable	=	[
        'tipoId',
        'cedula',
        'nombre',
        'apellido1',
        'apellido2',
        'genero',
        'fecha_nac',
        'telefono',
        'celular',
        'email',
        'estado_civil',
        'provincia',
        'canton',
        'distrito',
  	];
      public $timestamps	=	false;
      
    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value){
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if (!$isRememberTokenAttribute){
            parent::setAttribute($key, $value);
        }
    }
}
