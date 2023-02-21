<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClaviscoController extends Controller
{
    function setConfiguration($ch, $method, $fields = null, $accessToken = null){
        if ($accessToken != null){
            $setup = array(
                'Content-Type: application/x-www-form-urlencoded'
            );
        }else{
            $setup = array(
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization: Bearer '. $resCla["access_token"]
            );
        }

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            $setup
        );

        if ($fields != null){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000);

        return $ch;
    }

    function getToken(){
        $arrayCla= "grant_type=password&username=buzz@clavisco.com&password=4FvqO3cRx!";

        $url = 'https://medismartcun.clavisco.com/token';
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $arrayCla);

        //ejecutar
        $responseCV = curl_exec( $ch );

        //cerrar conexion
        curl_close( $ch );
        if ($responseCV === false) {
            return null;
        }

        return $responseCV;
    }

    function getTaxInformation($cli, $IdWebTransaction, $accessToken){
        $url = "https://medismartcun.clavisco.com/api/CardsController/GetinfoStateCreditCardPay?CliCode=".$cli."&IdWebTransaction=".$IdWebTransaction;
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'GET', null, $accessToken);

        //ejecutar
        $responseCV = curl_exec( $ch );

        //cerrar conexion
        curl_close( $ch );
        if ($responseCV === false) {
            return null;
        }

        return $responseCV;
    }
}
