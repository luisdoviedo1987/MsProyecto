<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Session;

//model
use App\Provincias;
use App\Cantones;
use App\Distritos;
use App\User;
use App\Afiliado;
use App\Sms_Registro;
use App\Activity_Log;

//controllers
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\SalesforceController;

class PagoController extends Controller
{
    // public function facturaafiliacion(){
    //     date_default_timezone_set('America/Costa_Rica');


    //     $shoppingcartcontroller = new ShoppingcartController;
    //     // $sc = $shoppingcartcontroller->obtener();
    //     // $sc = json_decode($sc);

       

      
    //     // $dataSF = $shoppingcartcontroller->obtenerSFPrimeraVenta();
    //     // $salesforcontroller = new SalesforceController;
    //     // $responseSF = $salesforcontroller->primeraventa(json_encode($dataSF));
    //     // $res=json_decode($responseSF, true);
    //     // $res['idFactura'] = rand();
    //     // //generar carrito de compras
    //     // $shoppingcartcontroller->setFromFacturaJSON(json_encode($res), $cedula);

    //     //get shopping cart

    //     $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
    //     $ip = "";
    //     foreach($keys as $k)
    //     {
    //         if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
    //         {
    //             $ip = $_SERVER[$k];
    //         }
    //     }

       
    //     $sc = $shoppingcartcontroller->obtener();
    //     $sc = json_decode($sc);

    //     $telefono = 0;
    //     $totalBene = 0;
    //     $totalOncoBene = 0;
    //     $totalPet = 0;
    //     $prorrateo = 0;
    //     $descuento = 0;
    //     $montoDescuento = 0;
    //     $totalOp = 0;

    //     foreach ($sc as $key => $value) {
    //         if ($value->id == "ADDPLAN") {
    //             $cedula = $value->options->cedula;
    //         }
    //     }
        
    //     //obtener primera ronda de informacion
    //     foreach ($sc as $key => $value) {


    //         if ($value->name == "Plan") {
    //             switch ($value->id){
    //                 case 'mensual': $plan = "MENSUAL"; break;
    //                 case 'semestral': $plan = "SEMESTRAL"; break;
    //                 case 'anual': $plan = "ANUAL"; break;
    //             }
    //         }

    //         $extras = $value->options;
    //         if(isset($extras->prorrateo)){
    //             $prorrateo = $extras->prorrateo;
    //         }

    //         if(isset($extras->descuento)){
    //             $descuento = $extras->descuento;
    //         }

    //         if(isset($extras->totalOp)){
    //             $totalOp = $extras->totalOp;
    //         }

    //         if ($value->id == "ADDPLAN") {
    //             $cedula = $value->options->cedula;
    //         }

    //         //totals
    //         if ($value->id == "ADDBENE") {
    //             $totalBene++;
    //         }
    //         if ($value->id == "ADDONCOBEN") {
    //             $totalOncoBene++;
    //         }
    //         if ($value->id == "ADDPET") {
    //             $totalPet++;
    //         }

    //     }

    //     if (Afiliado::where('persona_cedula', $cedula)->get()->count() == 0){
    //         //obtener afiliado
    //         $salesforcontroller = new SalesforceController;
    //         $res = json_decode(json_decode($salesforcontroller->getData($cedula)), true);

    //         $cli = $res['accountResults'][0]['numeroCliente'];
    //         $nombre = $res['accountResults'][0]['nombre'];
    //         $telefono = $res['accountResults'][0]['telefono'];

    //     }else{
    //         $afiliado = Afiliado::join('personas','afiliado.persona_cedula','=','personas.cedula')
    //                         ->where('persona_cedula', $cedula)->first();
    //         $cli = $afiliado->cli;
    //         $nombre = $afiliado->nombre;
    //         $telefono = $afiliado->telefono;
    //     }

        

    //     $code = rand(10000,99999);
    //     // Create sms
    //     $sms = array(
    //         'telefono' =>  $telefono,
    //         'cedula'=> $cli, 
    //         'sms'=> $code,
    //         'validado'=> "0" ,
    //         'fecha_creacion'=> date("Y-m-d H:i:s"),
    //         'fecha_validacion'=> null ,
    //         'ip'=> $ip
    //     );

    //     $smsRegistro  = Sms_Registro::create($sms);
    //     $smsRegistro->save();
    //     $lastId = $smsRegistro->id_sms;

    //     $response = $shoppingcartcontroller->sendSmsValidation($telefono , "Hola este es tu código ". $code." de verificación Medismart!" );

    //     return view('facturaafiliacion')
    //             ->with('body', json_encode( $response))
    //             ->with('idValidacion', $lastId)
    //             ->with('prorrateo', $prorrateo)
    //             ->with('telefono', $telefono)
    //             ->with('plan', $plan)
    //             ->with('shoppingcart', $sc)
    //             ->with('totalBene', $totalBene)
    //             ->with('totalOncoBene', $totalOncoBene)
    //             ->with('totalPet', $totalPet)
    //             ->with('cedula', $cedula)
    //             ->with('cli', $cli)
    //             ->with('totalOp', $totalOp)
    //             ->with('porcentajeDescuento', $descuento)
    //             ->with('nombre', $nombre);
    // }

    public function facturaafiliacion(){
        date_default_timezone_set('America/Costa_Rica');


        $shoppingcartcontroller = new ShoppingcartController;
        // $sc = $shoppingcartcontroller->obtener();
        // $sc = json_decode($sc);
      
        // $dataSF = $shoppingcartcontroller->obtenerSFPrimeraVenta();
        // $salesforcontroller = new SalesforceController;
        // $responseSF = $salesforcontroller->primeraventa(json_encode($dataSF));
        // $res=json_decode($responseSF, true);
        // $res['idFactura'] = rand();
        // //generar carrito de compras
        // $shoppingcartcontroller->setFromFacturaJSON(json_encode($res), $cedula);

        //get shopping cart
        $sc = $shoppingcartcontroller->obtener();
        $sc = json_decode($sc);

        $telefono = 0;
        $totalBene = 0;
        $totalOncoBene = 0;
        $totalPet = 0;
        $prorrateo = 0;
        $descuento = 0;
        $montoDescuento = 0;
        $totalOp = 0;
        
        //obtener primera ronda de informacion
        foreach ($sc as $key => $value) {
            if ($value->id == "ADDPLAN") {
                $cedula = $value->options->cedula;
            }

            if ($value->name == "Plan") {
                switch ($value->id){
                    case 'mensual': $plan = "MENSUAL"; break;
                    case 'semestral': $plan = "SEMESTRAL"; break;
                    case 'anual': $plan = "ANUAL"; break;
                }
            }

            $extras = $value->options;
            if(isset($extras->prorrateo)){
                $prorrateo = $extras->prorrateo;
            }

            if(isset($extras->descuento)){
                $descuento = $extras->descuento;
            }

            if(isset($extras->totalOp)){
                $totalOp = $extras->totalOp;
            }

            if ($value->id == "ADDPLAN") {
                $cedula = $value->options->cedula;
            }

            //totals
            if ($value->id == "ADDBENE") {
                $totalBene++;
            }
            if ($value->id == "ADDONCOBEN") {
                $totalOncoBene++;
            }
            if ($value->id == "ADDPET") {
                $totalPet++;
            }

        }

        if (isset($plan)) {
            if (session('shoppingcart')) {
                $sc = session('shoppingcart');
                $sc = json_decode($sc);
            }

            //obtener primera ronda de informacion
            foreach ($sc as $key => $value) {
                if ($value->id == "ADDPLAN") {
                    $cedula = $value->options->cedula;
                }

                if ($value->name == "Plan") {
                    switch ($value->id){
                        case 'mensual': $plan = "MENSUAL"; break;
                        case 'semestral': $plan = "SEMESTRAL"; break;
                        case 'anual': $plan = "ANUAL"; break;
                    }
                }

                $extras = $value->options;
                if(isset($extras->prorrateo)){
                    $prorrateo = $extras->prorrateo;
                }

                if(isset($extras->descuento)){
                    $descuento = $extras->descuento;
                }

                if(isset($extras->totalOp)){
                    $totalOp = $extras->totalOp;
                }

                if ($value->id == "ADDPLAN") {
                    $cedula = $value->options->cedula;
                }

                //totals
                if ($value->id == "ADDBENE") {
                    $totalBene++;
                }
                if ($value->id == "ADDONCOBEN") {
                    $totalOncoBene++;
                }
                if ($value->id == "ADDPET") {
                    $totalPet++;
                }

            }
        }

        if (!isset($plan)) {
            $plan = "MENSUAL";
        }

        if (Afiliado::where('persona_cedula', $cedula)->get()->count() == 0){
            //obtener afiliado
            $salesforcontroller = new SalesforceController;
            $res = json_decode(json_decode($salesforcontroller->getData($cedula)), true);

            $cli = $res['accountResults'][0]['numeroCliente'];
            $nombre = $res['accountResults'][0]['nombre'];
            $telefono = $res['accountResults'][0]['telefono'];

        }else{
            $afiliado = Afiliado::join('personas','afiliado.persona_cedula','=','personas.cedula')
                            ->where('persona_cedula', $cedula)->first();
            $cli = $afiliado->cli;
            $nombre = $afiliado->nombre;
            $telefono = $afiliado->telefono;
        }

        $code = rand(10000,99999);

        //GET THE IP
        $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
        $ip = "";
        foreach($keys as $k)
        {
            if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
            {
                $ip = $_SERVER[$k];
            }
        }

        // Create sms
        $sms = array(
            'telefono' =>  $telefono,
            'cedula'=> $cli, 
            'sms'=> $code,
            'validado'=> "0" ,
            'fecha_creacion'=> date("Y-m-d H:i:s"),
            'fecha_validacion'=> null ,
            'ip'=> $ip
        );

        $registros = Sms_Registro::where('telefono', $telefono)->get();
        $response = '';
        $lastId = '';
        
        $smsRegistro  = Sms_Registro::create($sms);
        $smsRegistro->save();
        $lastId = $smsRegistro->id_sms;
        $response = $shoppingcartcontroller->sendSmsValidation($telefono , "Hola este es tu código ". $code." de verificación Medismart!" );

        Activity_Log::create([
            'descripcion' => 'Página de facturación: Listo el envío de SMS',
            'session' => Session::getId(),
        ]);

        return view('facturaafiliacion')
                ->with('body', json_encode( $response))
                ->with('idValidacion', $lastId)
                ->with('prorrateo', $prorrateo)
                ->with('telefono', $telefono)
                ->with('plan', $plan)
                ->with('shoppingcart', $sc)
                ->with('totalBene', $totalBene)
                ->with('totalOncoBene', $totalOncoBene)
                ->with('totalPet', $totalPet)
                ->with('cedula', $cedula)
                ->with('cli', $cli)
                ->with('totalOp', $totalOp)
                ->with('porcentajeDescuento', $descuento)
                ->with('nombre', $nombre);
    }
}
