<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EmailTemplate;

class SmsController extends Controller
{
    function setConfiguration($ch, $method, $fields = null){
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            )
        );

        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $method );

        if ($fields != null){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }

        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000);

        return $ch;
    }

    function enviarReferidos($fields){
        $url = "https://red.medismart.online/api-medi/public/refer/sms";
        $ch = curl_init($url);

        //body
        $email_template = EmailTemplate::where('id', 4)->first();
        $sms = $email_template->content;
        $sms = str_replace('{nombreReferido}', $fields['nombre'], $sms);
        $sms = str_replace('{nombreReferente}', $fields['nombreReferente'], $sms);
        $sms = str_replace('{apellidoReferente}', $fields['apellidoReferente'], $sms);
        $sms = str_replace('{codigo}', $fields['codigoReferido'], $sms);

        //$body = "Hola ". $fields['nombre'] .", ". $fields['nombreReferente'] . $fields['apellidoReferente'] ." te refirió a MediSmart, utiliza el código ". $fields['codigoReferido'] ." para afiliarte en https://bit.ly/2EmGBXK y obtene 5000 colones canjeables en citas medicas.*";
        $body = $sms;
        $phone = $fields['numeroReferido'];
        
        //configuracion de la conexion
        $ch = $this->setConfiguration($ch, 'POST', json_encode(['phone'=>$phone,'body'=>$body]));

        //ejecutar
        $responseSms = curl_exec( $ch );

        //cerrar conexion
        curl_close( $ch );
        if ($responseSms === false) {
            return null;
        }

        return $responseSms;
    }
}
