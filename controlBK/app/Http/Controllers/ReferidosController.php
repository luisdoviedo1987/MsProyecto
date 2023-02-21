<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use DB;
use Auth;
use Response;

//model
use App\Referidos;
use App\Afiliado;

//controller
use App\Http\Controllers\SalesforceController;
use App\Http\Controllers\SmsController;

//jobs
use App\Jobs\SendNewReferEmail;

class ReferidosController extends Controller
{
    protected $salesforcecontroller;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->salesforcecontroller = new SalesforceController();
    }

    public function createReferido(Request $request)
    {
        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                            ->where('persona_cedula', Auth::user()->cedula)->first();

        $aSaleForce = array(
            "numeroReferente" => $afiliado->cli,
            "numeroCedula"=> $request->cedula,
            "nombres"=>$request->nombre,
            "apellidos"=>$request->apellido1." ".$request->apellido2,
            "telefono"=>$request->telefono,
            "parentezco"=>$request->parentesco,
        );

        $phone = $request->telefono;
        str_replace("+", "", $phone);
        if (strlen($phone) == 11 && substr($phone, 0, 3) == "506"){
            $phone = $phone;
        }else if (strlen($phone) == 8) {
            $phone = '506' . $phone;
        }else{
            return Response::json(['message'=> "El número de teléfono es incorrecto."], 403);
        }

        $responseSF = $this->salesforcecontroller->crearReferido(json_encode($aSaleForce));
        $res = json_decode($responseSF, true);
        
        if (!($res['resultado'])) {
            if (strpos($res["mensaje"], 'DUPLICATES_DETECTED')) {
                return Response::json(['message' => 'Ya el referido existe en nuestra base de datos, ¿Tenés alguien más a quién referir?'], 403);
            }
            
            return Response::json(['message'=> "Hubo un error en la generación del Referido, intente mas tarde",], 403);
        }

        $abuzz= array(
            "numeroReferente" => $afiliado->cli,
            "cedula"=> $request->cedula,
            "nombre"=>$request->nombre,
            "apellido1"=>$request->apellido1,
            "apellido2"=>$request->apellido2,
            "telefono"=>$request->telefono,
            "parentesco"=>$request->parentezco,
            'email' => $request->email
        );
        
        $abuzz["codigoReferido"] = $res["idReferido"];

        $referidoDB = Referidos::create($abuzz);
        $referidoDB->save();

        $abuzz["nombreReferente"] = $afiliado->nombre;
        $abuzz["apellidoReferente"] = $afiliado->apellido1;
        $abuzz["numeroReferido"] = $phone;
        $abuzz["image"] = asset('control/images/cropped-Logo-MediSmart-Blanco-2.png');
        $abuzz["url"] = route('index');
        $abuzz["url_afiliacion"] = route('afiliacion');

        //send sms
        $smsController = new SmsController;
        $sms = $smsController->enviarReferidos($abuzz);

        if (!empty($request->email)) {
            //send email
            $this->dispatch(new SendNewReferEmail($abuzz));
        }

        return Response::json(['message'=> "Referencia creada, ¡Corre y notificale para ganar premios!",], 200);
    }


    public function consultarReferencias()
    {
        $afiliado = Afiliado::where('persona_cedula', Auth::user()->cedula)->first();
        $responseSF = $this->salesforcecontroller->consultarReferido($afiliado->cli);
        $res=json_decode(json_decode($responseSF), true);

        $response	=	Response::json($res, 201);
        return $response;
    }

    public function consultarRegalias()
    {
        $afiliado = Afiliado::where('persona_cedula', Auth::user()->cedula)->first();
        $responseSF = $this->salesforcecontroller->consultarRegalias($afiliado->cli);
        $res=json_decode(json_decode($responseSF), true);

        $response	=	Response::json($res, 201);
        return $response;
    }

    public function canjearRegalias(Request $request)
    {
        $idCanjeador = $request->input('idCanjeador');
        $numeroReferencia = $request->input('numeroReferencia');
        $datosSF = array(
            "idCanjeador" => $idCanjeador,
            "numeroReferencia" => $numeroReferencia
        );

        $responseSF = $this->salesforcecontroller->canjearRegalia($datosSF);

        $dataSF = json_decode($responseSF, true);
        if ($dataSF['resultado']) {
            $mensaje = array(
                'message'=> "Canje realizado exitosamente",
                'sf' => $dataSF,
                'arregloSf' => $datosSF
            );
            $response	=	Response::json($mensaje, 201);
            return $response;
        } else {
            $mensaje = array(
                'message'=> "Ha ocurrido un problema al realizar su canje, vuelva a intentar mas tarde",
                'sf' => $dataSF,
                'arregloSf' => $datosSF
            );
            $response	=	Response::json($mensaje, 403);
            return $response;
        }
    }

    public function getReferido($ref)
    {
        $referidos = Referidos::where("codigoReferido",$ref)->where("aplicada",0)->first();
        $referidos = json_decode(json_encode($referidos), true);
        if (!empty($referidos)) {
            $mensaje = array(
                'message'=> "Encontrado",
                "status"=> true,
                'referido' => $referidos
            );
            $response	=	Response::json($mensaje, 201);
            return $response;
        } else {
            $mensaje = array(
                'message'=> "Encontrado",
                "status"=> false,
                'referido' => $referidos
            );
            $response	=	Response::json($mensaje, 201);
            return $response;
        }
    }
}
