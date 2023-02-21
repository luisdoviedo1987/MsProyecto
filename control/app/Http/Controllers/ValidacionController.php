<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use Response;
use Auth;

//models
use App\User;
use App\Afiliado;
use App\Mascotas;

//controller
use App\Http\Controllers\SalesforceController;

class ValidacionController extends Controller
{
    public function generarCodigo(Request $request)
    {
        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://red.medismart.online/api-medi/public/validation/code',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode(array("cli"=> $request->input('cli'))),
            CURLOPT_HTTPHEADER => array(
                'API-key: N9s+IKubm50nRREspBiVs7I3InFPyLFzk9RMHs0TSsnJ2lVS0TakhN0KoePWPOH8T0Y06uiCJy/eAkpWxpmoDA==',
                'APP-origen: autogestion',
                'APP-version: v1.0',
                'Content-Type: application/json',
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return Response::json( json_decode($response,true), 201);
        
        } catch (Exception $e) {
            return Response::json( json_decode(array("status"=>"ERROR" , "msg"=>$e->getMessage()),true), 403);
        }
    }
}