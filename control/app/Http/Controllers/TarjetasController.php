<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use Response;
use App;
use Session;

//models
use App\User;
use App\Afiliado;
use App\Tarjetas_Afiliados_Relacion;
use App\Tarjetas;
use App\Sms_Registro;
use App\Activity_Log;

//controller
use App\Http\Controllers\SalesforceController;
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\AfiliacionController;

class TarjetasController extends Controller
{
    public function addTarjeta(Request $request)
    {
        $fecha_vencimiento = $request->input('mes').$request->input('ano');
        $cli =$request->input('cli');
        define('AES_256_CBC', 'aes-256-cbc');
        // Generate a 256-bit encryption key
        // This should be stored somewhere instead of recreating it each time
        $encryption_key = base64_decode("j/gwTi0igUda93H9DTwKyANnzBY7PaEzZ/7hnwCObpA=");
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));

        $dataSF=array(
            'fechaVencimiento'=>openssl_encrypt($fecha_vencimiento, 'AES-256-CBC', $encryption_key, $options=0, $iv),
            'nombreTitular'=>$request->input('nombre'),
            'numeroTarjeta'=>openssl_encrypt($request->input('numero'), 'AES-256-CBC', $encryption_key, $options=0, $iv),
            'principal'=> $request->input('principal') == "on" ? true : false,
            'tipoTarjeta'=>$request->input('tipo'),
            'IV'=>base64_encode($iv)
        );

        $SaleForce= array(
            "numerocliente" => $cli,
            "tarjetasEliminar" =>  array(),
            'tarjetasInsertar' => array($dataSF)
        );

        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->accionesTarjetas(json_encode($SaleForce));
        $res=json_decode(json_decode($responseSF), true);

        if ($res['result']['codigoError']==200) {
            $tarjeta=$res['tarjetasInsertar'][0];

            $data=array(
                    'idTarjeta'=>$tarjeta['idTarjeta'],
                    'fechaVencimiento'=>$fecha_vencimiento,
                    'nombreTitular'=>$tarjeta['nombreTitular'],
                    'numeroTarjeta'=>'xxxxxxxxxxx-'.substr($request->input('numero'), -4),
                    'principal'=> $request->input('principal')  == "on" ? true : false,
                    'tipoTarjeta'=>$tarjeta['tipoTarjeta'],
                );

            $tarjetasNuevo = Tarjetas::create($data);
            $tarjetasNuevo->save();
            $data2 = array(
                    'idTarjeta'=>$tarjeta['idTarjeta'],
                    'numeroCliente'=>$cli,
                );

            $relacion = Tarjetas_Afiliados_Relacion::create($data2);
            $relacion->save();

            return Response::json(['respuesta'=> $data,'message' => 'Tarjeta insertada correctamente'], 201);
        } else {
            return Response::json(['respuesta'=> $res,'message' => 'Ha ocurrido un problema, por favor intente mas tarde'], 403);
        }
    }

    public function deleteTarjeta(Request $request)
    {
        $cli = $request->input('numeroCliente');

        $data=array(
            'idTarjeta'=>$request->input('idTarjeta'),
        );

        $SaleForce= array(
            "numerocliente" => $cli,
            "tarjetasEliminar" =>  array($data),
            'tarjetasInsertar' => array()
        );

        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->accionesTarjetas(json_encode($SaleForce));

        $res=json_decode(json_decode($responseSF), true);

        if ($res['result']['codigoError']==200) {
            $delete = Tarjetas::where('idTarjeta', $request->input('idTarjeta'))->delete();
            $delete2 = Tarjetas_Afiliados_Relacion::where([['idTarjeta',$request->input('idTarjeta')],['numeroCliente',$cli]])->delete();

            return Response::json(['message' => 'Tarjeta eliminada correctamente'], 201);
        }else{
            return Response::json(['message' => 'Ocurrio un erro. Intente mas tarde'], 403);
        }
    }

    public function reenviarSms(Request $request){

        $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
        $ip = "";
        foreach($keys as $k){
            if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP)){
                $ip = $_SERVER[$k];
            }
        }

        $smsRegistro = Sms_Registro::where('id_sms', $request->idvalidacion)->first();

        $shoppingcartcontroller = new ShoppingcartController();

        $code = rand(10000,99999);
        // Create sms
        $sms = array(
            'telefono' =>  $smsRegistro["telefono"],
            'cedula'=> $smsRegistro["cedula"], 
            'sms'=> $code,
            'validado'=> "0" ,
            'fecha_creacion'=> date("Y-m-d H:m:s"),
            'fecha_validacion'=> null ,
            'ip'=> $ip
        );

        $smsRegistro  = Sms_Registro::create($sms);
        $smsRegistro->save();
        $lastId = $smsRegistro->id_sms;

        $response = $shoppingcartcontroller->sendSmsValidation($smsRegistro["telefono"] , "Hola este es tu código ". $code." de verificación Medismart!" );

        return Response::json(['code' => '201', 'idSms' => $lastId ,"body" => json_encode($response) ], 201);

    }

    // public function afiliarTarjeta(Request $request)
    // {
    //     date_default_timezone_set('America/Costa_Rica');

        
    //     $fecha_vencimiento = $request->input('mes').$request->input('ano');
    //     $cli = $request->input('cli');

    //    $recaptcha = $request->input('g-recaptcha-response');

    //    $url = 'https://www.google.com/recaptcha/api/siteverify';
    //    $data = array(
    //        'secret' => '6LcBrCMaAAAAAE9zMP01zk5EhWyc95awfhgb5eDq',
    //        'response' => $recaptcha
    //    );
    //    $query = http_build_query($data);
    //    $options = array(
    //     'http' => array(
    //         'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
    //                     "Content-Length: ".strlen($query)."\r\n".
    //                     "User-Agent:MyAgent/1.0\r\n",
    //         'method'  => "POST",
    //         'content' => $query,
    //      ),
    //    );

    //    $context = stream_context_create($options);
    //    $verify = file_get_contents($url, false, $context);

    //    $captcha_success = json_decode($verify);
    //    if ($captcha_success->success) {
            
    //        $smsRegistro = Sms_Registro::where('id_sms', $request->input('validacion') )
    //             ->where('sms', $request->input('codigosms') )
    //             ->get();

    //         if( count($smsRegistro)  == 0 ){
    //             return Response::json(['code' => '403','message' => "El código de verificación ingresado no es valido"], 403);
    //         }
            
    
    //        //Update sms
    //         Sms_Registro::where('id_sms', $request->input('validacion'))
    //         ->where('sms', $request->input('codigosms'))
    //         ->update(['validado' => 1,'fecha_validacion'=>  date("Y-m-d H:i:s") , 'usos' => $request->input('retry') ]);

    //         //get afiliado
    //         $afiliado = Afiliado::where('cli', $cli)->first();

    //         if ($afiliado == null ){
    //             return Response::json(['code' => '403','message' => "Error cargando información del afiliado ".json_encode($afiliado)], 403);
    //         }

    //         $factura = json_decode($afiliado->facturaSF);

    //         define('AES_256_CBC', 'aes-256-cbc');

    //         // Generate a 256-bit encryption key
    //         // This should be stored somewhere instead of recreating it each time
    //         $encryption_key = base64_decode("j/gwTi0igUda93H9DTwKyANnzBY7PaEzZ/7hnwCObpA=");
    //         $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        
    //         // Generate an initialization vector
    //         // This *MUST* be available for decryption as well
    //         //$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
    //         $dataSF=array(
    //             'cli' => $cli,
    //             'tarjeta' => array(
    //                 "numeroTarjeta" => openssl_encrypt($request->input('numero'), 'AES-256-CBC', $encryption_key, $options=0, $iv),
    //                 "tarjetaHabiente" =>$request->input('nombre'),
    //                 "tipoTarjeta" => $request->input('tipo'),
    //                 "fechaVencimiento" => openssl_encrypt($fecha_vencimiento, 'AES-256-CBC', $encryption_key, $options=0, $iv),
    //                 "IV" =>  base64_encode($iv)
    //             ),
    //             'IdWebTransaction' => $factura->idFactura,
    //         );

    //         $salesforcontroller = new SalesforceController;
    //         $responseSF = $salesforcontroller->primeraventapago(json_encode($dataSF));

    //         if ($responseSF === false) {
    //             return Response::json($this->timeOut($cli, $factura->idFactura), 201);
    //         }

    //         $res=json_decode($responseSF, true);

    //         if ($res["resultado"]) {
    //             //delete cart
    //             $shoppingcartcontroller = new ShoppingcartController;
    //             $shoppingcartcontroller->limpiar();

    //             //update afiliado
    //             $personas = Afiliado::where('cli', $cli)->first();
    //             $personas->estado_envio = 1;
    //             $personas->afiliacion_terminada = 1;
    //             $personas->save();

    //             $afiliacioncontroller = new AfiliacionController;
    //             $respuestaReferido =  $afiliacioncontroller->recepcionReferido($cli, $personas->codigo_referido);

    //             $object = array(
    //                 "cli"     => $cli,
    //             );
    //             $link = route('generate.password', ['data' => encrypt(json_encode($object))]);
    //             // $link = App::make('url')->to('/afiliacion/generate-password/'.encrypt(json_encode($object)));

    //             return Response::json(['code' => '201', 'url' => $link], 201);
    //         }else{
    //             //{"resultado":false,"mensaje":"DENEGADA"}
            
    //             return Response::json(['code' => '403','message' => "Tu tarjeta ha sido rechazada por la entidad bancaria (".$res["mensaje"].")."], 403);
    //         }
    //    } else {
    //          return Response::json(['code' => '404','message' => 'Por favor confirma que no eres un robot'], 403);
    //    }
    // }

    public function afiliarTarjeta(Request $request)
    {
        Activity_Log::create([
            'descripcion' => 'Inició proceso de pago: Click en pagar',
            'session' => Session::getId(),
        ]);

        date_default_timezone_set('America/Costa_Rica');
        
        $fecha_vencimiento = str_replace(' ', '', str_replace('/', '', $request->input('expiry')));
        $cli = $request->input('cli');

        $recaptcha = $request->input('g-recaptcha-response');

        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LcBrCMaAAAAAE9zMP01zk5EhWyc95awfhgb5eDq',
            'response' => $recaptcha
        );
        $query = http_build_query($data);
        $options = array(
            'http' => array(
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                            "Content-Length: ".strlen($query)."\r\n".
                            "User-Agent:MyAgent/1.0\r\n",
                'method'  => "POST",
                'content' => $query,
            ),
        );

        $context = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);

        $captcha_success = json_decode($verify);
        if ($captcha_success->success) {
                
            $smsRegistro = Sms_Registro::where('id_sms', $request->input('validacion') )
                    ->where('sms', $request->input('codigosms') )
                    ->get();

            if( count($smsRegistro)  == 0 ){
                Activity_Log::create([
                    'descripcion' => 'Error proceso de pago. Código SMS no es válido',
                    'session' => Session::getId(),
                ]);

                return Response::json(['code' => '403','message' => "El código de verificación ingresado no es valido"], 403);
            }
                
        
            //Update sms
            Sms_Registro::where('id_sms', $request->input('validacion'))
            ->where('sms', $request->input('codigosms'))
            ->update(['validado' => 1,'fecha_validacion'=>  date("Y-m-d H:i:s") , 'usos' => $request->input('retry') ]);

            //get afiliado
            $afiliado = Afiliado::where('cli', $cli)->first();

            if ($afiliado == null ){
                Activity_Log::create([
                    'descripcion' => 'Error proceso de pago: No se encontro el Afiliado',
                    'session' => Session::getId(),
                ]);

                return Response::json(['code' => '403','message' => "Error cargando información del afiliado ".json_encode($afiliado)], 403);
            }

            $factura = json_decode($afiliado->facturaSF);

            define('AES_256_CBC', 'aes-256-cbc');

            // Generate a 256-bit encryption key
            // This should be stored somewhere instead of recreating it each time
            $encryption_key = base64_decode("j/gwTi0igUda93H9DTwKyANnzBY7PaEzZ/7hnwCObpA=");
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        
            // Generate an initialization vector
            // This *MUST* be available for decryption as well
            //$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
            $dataSF=array(
                'cli' => $cli,
                'tarjeta' => array(
                    "numeroTarjeta" => openssl_encrypt(str_replace(' ', '', $request->input('number')), 'AES-256-CBC', $encryption_key, $options=0, $iv),
                    "tarjetaHabiente" =>$request->input('name'),
                    "tipoTarjeta" => $request->input('type'),
                    "fechaVencimiento" => openssl_encrypt($fecha_vencimiento, 'AES-256-CBC', $encryption_key, $options=0, $iv),
                    "IV" =>  base64_encode($iv)
                ),
                'IdWebTransaction' => $factura->idFactura,
            );

            $salesforcontroller = new SalesforceController;
            $responseSF = $salesforcontroller->primeraventapago(json_encode($dataSF));

            if ($responseSF === false) {
                Activity_Log::create([
                    'descripcion' => 'Error proceso de pago. Timeout de Salesforce',
                    'session' => Session::getId(),
                ]);

                return Response::json($this->timeOut($cli, $factura->idFactura), 201);
            }

            $res=json_decode($responseSF, true);

            Activity_Log::create([
                'usuario' => $cli,
                'cliente' => $cli,
                'descripcion' => 'Pago tarjeta usuario',
                'log' => "'res' => ".json_encode($res).", 'data_sent' => ".json_encode($dataSF),
                'session' => Session::getId(),
            ]);

            if (is_array($res) && $res["resultado"]) {
                //delete cart
                $shoppingcartcontroller = new ShoppingcartController;
                $shoppingcartcontroller->limpiar();

                //update afiliado
                $personas = Afiliado::where('cli', $cli)->first();
                $personas->estado_envio = 1;
                $personas->afiliacion_terminada = 1;
                $personas->save();

                $afiliacioncontroller = new AfiliacionController;
                $respuestaReferido =  $afiliacioncontroller->recepcionReferido($cli, $personas->codigo_referido);

                $object = array(
                    "cli"     => $cli,
                );
                $link = route('generate.password', ['data' => encrypt(json_encode($object))]);
                // $link = App::make('url')->to('/afiliacion/generate-password/'.encrypt(json_encode($object)));

                return Response::json(['code' => '201', 'url' => $link, 'res' => $res], 201);
            }else{
                //{"resultado":false,"mensaje":"DENEGADA"}
                // $dataSFUncrypt = array(
                //     'cli' => $cli,
                //     'tarjeta' => array(
                //         "numeroTarjeta" => str_replace(' ', '', $request->input('number')),
                //         "tarjetaHabiente" =>$request->input('name'),
                //         "tipoTarjeta" => $request->input('type'),
                //         "fechaVencimiento" => $fecha_vencimiento,
                //         "IV" => $iv
                //     ),
                //     'IdWebTransaction' => $factura->idFactura,
                // );
                return Response::json(['code' => '403', 'res' => $res, 'message' => "Tu tarjeta ha sido rechazada por la entidad bancaria (".$res["mensaje"].")."], 403);
            }
        } else {
                return Response::json(['code' => '404','message' => 'Por favor confirma que no eres un robot', 'data' => $verify], 403);
        }
    }
    
    public function timeOut($cli, $IdWebTransaction)
    {
        //token
        $claviscocontroller = new ClaviscoController;
        $responseCV = $claviscocontroller->getToken();
        $resCla=json_decode($responseCV, true);

        //get tax information
        $responseSF = $getTaxInformation->getToken($cli, $IdWebTransaction, $resCla["access_token"]);
        $res=json_decode($responseSF, true);

        if ($res["CardInfoPay"]["BacDetail"]==="APROBADA") {
            return $mensaje = array(
                                'code' => '201',
                                'timeup' => true,
                                'respuesta'=> true,
                                'message' => $res["CardInfoPay"]['BacDetail']
                              );
        } else {
            return $mensaje = array(
                                'code' => '201',
                                'timeup' => true,
                                'respuesta'=> false,
                                'message' => $res["CardInfoPay"]['BacDetail']
                              );
        }
    }
}
