<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PromocionesAfiliado;

use DateTime;

class PromocionesafiliadoController extends Controller
{
    function obtenerxCli($cli){
        $promocion = PromocionesAfiliado::where('cli', $cli)->first();
        return $promocion;
    }

    function canjearCodigo($cli){
        $dt = new DateTime;

        $promocion = PromocionesAfiliado::where('cli', $cli)->first();
        $promocion->activado = 1;
        $promocion->fecha_canje = $dt->format('y-m-d H:i:s');
        $promocion->save();
    }
}
