<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use DB;
use Response;

//model
use App\Provincias;
use App\Cantones;
use App\Distritos;

class UbicacionController extends Controller
{
    public function getUbicacion($distelec)
    {
        $distritos = DB::table('distritos')
            ->where('distritos.CODIGODISTRITO_C', $distelec)
            ->get();
        $arrayUbicacion = json_decode($distritos)[0];
        echo(json_decode($distritos)[0]->NAME);
        $response	=Response::json($distritos, 200, [], JSON_NUMERIC_CHECK);
        return $response;
    }

    public function getProvincias()
    {
        $provincias = DB::table('provincias')->get();
        $response	= Response::json($provincias, 200, [], JSON_NUMERIC_CHECK);
        return $response;
    }

    public function getCantones($distelec)
    {
        $cantones = DB::table('cantones')
            ->whereBetween('CODIGOCANTON_C', [$distelec*100,(($distelec*100)+900)])
            ->get();
        $response	=	Response::json($cantones, 200, [], JSON_NUMERIC_CHECK);
        return $response;
    }

    public function getDistritos($distelec)
    {
        $distritos = DB::table('distritos')
            ->whereBetween('distritos.CODIGODISTRITO_C', [$distelec*100,(($distelec*100)+90)])
            ->get();
        $response	=	Response::json($distritos, 200, [], JSON_NUMERIC_CHECK);
        return $response;
    }

    public function getProvinciaById($code)
    {
        $provincia = Provincias::where('CODIGOPROVINCIA', $code)->first();
        return $provincia;
    }

    public function getCantonById($code)
    {
        $provincia = Cantones::where('CODIGOCANTON_C', $code)->first();
        return $provincia;
    }

    public function getDistritoById($code)
    {
        $provincia = Distritos::where('CODIGODISTRITO_C', $code)->first();
        return $provincia;
    }
}
