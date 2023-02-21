<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SalesforceController extends Controller
{
    public function checkapi()
    {
        $apiSF= DB::table('apisf')->first();

        $hoy = date("Ymdhis");
        $expire = $hoy +1000000;
        $client_id=$apiSF->client_id;
        $client_secret=$apiSF->client_secret;
        $user= $apiSF->username;
        $pass=$apiSF->password;
        $date= $apiSF->date;
        if ($date<$hoy) {
            //$ch = curl_init("https://medismart--test.cs77.my.salesforce.com/services/oauth2/token?grant_type=password&client_id=".$client_id."&client_secret=".$client_secret."&username=".$user."&password=".$pass);
            $ch = curl_init("https://medismart.my.salesforce.com/services/oauth2/token?grant_type=password&client_id=".$client_id."&client_secret=".$client_secret."&username=".$user."&password=".$pass);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            curl_close($ch);
            $res=json_decode($response, true);

            DB::table('apisf')->update(['accessToken' => $res['access_token']]);
            DB::table('apisf')->update(['signature' => $res['signature']]);
            DB::table('apisf')->update(['date' => $expire]);
        }
    }

    public function setConfiguration($ch, $method, $fields = null)
    {
        $this->checkapi();

        $apiSF= DB::table('apisf')->first();

        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer '. $apiSF->accessToken ,
            )
        );

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        if ($fields != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000);

        return $ch;
    }

    public function getClientInformation($cli)
    {
        $url = 'https://medismart.my.salesforce.com/services/apexrest/consultainfoclienteapi?cli='.$cli;
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'GET');

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function getClientInformationData($cli) {
        $url = 'https://medismart.my.salesforce.com/services/apexrest/sfconsultapi/getdata?search='.$cli;
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'GET');

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function actualizarInfoCliente($fields)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/ActualizaInfoClienteAPI";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $fields);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function actionesBeneficiario($fields)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/accionesbenpetapi/";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $fields);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function accionesTarjetas($fields)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/accionestarjetaapi/";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $fields);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function changeOncosmart()
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/accionesbenpetapi/";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $fields);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function getData($data)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/sfconsultapi/getdata?search=" . $data;
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'GET');

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function crearReferido($data)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/creareferidoapi";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $data);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function crearFactura($data)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/sfacturacionapi/crearFactura?cli=" . $data;
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'GET');

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function consultarReferido($cli)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/consultareferenciasapi?cliben=".$cli;
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'GET');

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function consultarRegalias($cli)
    {
        $url = 'https://medismart.my.salesforce.com/services/apexrest/ConsultaRegaliasRefAPI?cliben='.$cli;
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'GET');

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function canjearRegalia($data)
    {
        $url = "https://test-contractmedismart.cs77.force.com/services/apexrest/canjearregaliaapi";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $data);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }

    public function primeraventa($data)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/primeraventacliapi";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $data);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);
        if ($responseSF === false) {
            return null;
        }

        return $responseSF;
    }


    public function primeraventapago($data)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/primeraventapagoapi";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $data);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);

        return $responseSF;
    }

    public function recepcionreferido($data)
    {
        $url = "https://medismart.my.salesforce.com/services/apexrest/recepcioncodreferidoapi";
        $ch = curl_init($url);
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', $data);

        //ejecutar
        $responseSF = curl_exec($ch);

        //cerrar conexion
        curl_close($ch);

        return $responseSF;
    }

    public function userStatus($cedula) {
        //VALIDAR 
        $res = $this->getData($cedula);
        $res = json_decode(json_decode($res), true);

        if ($res['existe']) {
            if (count($res['accountResults']) > 0){
                switch ($res['accountResults'][0]['estado']){
                    case "Activo": $status = 1; break;
                    case "Inactivo": $status = 0; break;
                    case "En Proceso de Venta": $status = 2; break;
                    default: $status = 3; break;
                }
    
                return ['status'=> $status, 'existe'=> true, 'afiliado'=> true];
            }else if (count($res['benResults']) > 0){
                switch ($res['benResults'][0]['estado']){
                    case "Activo": $status = 1; break;
                    case "Inactivo": $status = 0; break;
                    case "En Proceso de Venta": $status = 2; break;
                    default: $status = 3; break;
                }

                return ['status'=> $status, 'existe'=> true, 'afiliado'=> false];
            }
        }else{
            return ['status'=>0, 'existe'=>false];
        }
    }
}
