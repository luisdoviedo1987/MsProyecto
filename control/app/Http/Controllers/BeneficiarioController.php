<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use Response;
use DB;
use Auth;
use App;
use DateTime;
use DateTimeZone;

//model
use App\Afiliado;
use App\Beneficiario;
use App\Bene_Delete;
use App\User;

//controller
use App\Http\Controllers\SalesforceController;
use App\Http\Controllers\PromocionesafiliadoController;

//jobs
use App\Jobs\NewPasswordEmail;

class BeneficiarioController extends Controller
{
    function obtenerXBeneyAfiliado($bene, $afiliado){
        return Beneficiario::where('NumeroBeneficiaro', '=', $bene)->where('afiliado_cedula', $afiliado->persona_cedula)->first();
    }

    function obtenerXCedula($cedula){
        return Beneficiario::where('persona_cedula', $cedula)->first();
    }

    public function actualizarBeneficiario(Request $request){
        $beneficiario = Beneficiario::join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')->where('persona_cedula', '=', Auth::user()->cedula)->first();
        $afiliado = Afiliado::where('persona_cedula', $beneficiario->afiliado_cedula)->first();

        $aSaleForce = array(
            'benAccion'         => 'update',
            'idBen'             => $beneficiario->NumeroBeneficiaro,
            'tipoIdentificacion'=> $beneficiario->tipoId,
            'cedula'            => $beneficiario->persona_cedula,
            'telefono'          => $beneficiario->telefono,
            'parentezco'        => $beneficiario->parentesco,
            'correo'            => $beneficiario->email,
            'provincia'         => $request->provincia,
            'canton'            => $request->canton,
            'distrito'          => $request->distrito,
            'estadoCivil'       =>'',
            'coberturaOncosmart'=> $beneficiario->onco,
            'genero'            => $beneficiario->genero,
        );

        $SaleForce=array(
            'numerocliente' => $afiliado->cli,
            'beneficiarios' => array($aSaleForce),
            'mascotas'      => array(),
        );

        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->actionesBeneficiario(json_encode($SaleForce));
        $res=json_decode(json_decode($responseSF), true);

        if ($res['result']['codigoError']==200) {
            $bene = User::where('cedula', $beneficiario->persona_cedula)->first();
            $bene->provincia = $request->provincia;
            $bene->canton = $request->canton;
            $bene->distrito = $request->distrito;
            $bene->save();

            return Response::json(array('code' => '201'), 201);
        }

        return Response::json(['code' => '403'], 403);
    }

    public function accionesBeneficiario(Request $request)
    {
        $operacion = $request->input('operacion');
        $beneficiario = null;

        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')->where('cli', $request->cli)->first();
        if ($operacion != 1){
            if ($request->ben == ""){
                $beneficiario = Beneficiario::join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')->where('persona_cedula', '=', $request->benCedula)->where('afiliado_cedula', $afiliado->persona_cedula)->first();
            }else{
                $beneficiario = Beneficiario::join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')->where('NumeroBeneficiaro', '=', $request->ben)->where('afiliado_cedula', $afiliado->persona_cedula)->first();
            }

            if (isset($beneficiario->oncosmart)) {
                switch ($beneficiario->oncosmart) {
                    case 1:$onco=true;break;
                    case 0:$onco=false;break;
                }
            }else{
                $onco = false;    
            }
        }else{
            $onco = false;
        }

        switch ($request->tipoId) {
            case 1:$tipo="Cedula física";break;
            case 2:$tipo="Dimex";break;
            case 3:$tipo="Extranjero";break;
            default: $tipo= "Cedula física"; break;
        }

        $aSaleForce = $this->arrayAction($operacion, $tipo, $request, $onco, $beneficiario);

        $SaleForce=array(
            'numerocliente' => $afiliado->cli,
            'beneficiarios' => array($aSaleForce),
            'mascotas'      => array(),
        );

        if ($operacion == 3) {
            $beneDelete= DB::table('bene_delete')->where('beneCedula', $request->cedula)->first();
            $beneDelete = json_decode(json_encode($beneDelete), true);
            if (!empty($beneDelete)) {
                return Response::json(['mensaje'=> 'Este beneficiarios fue eliminado hace menos de un año'], 403);
            }
        }

        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->actionesBeneficiario(json_encode($SaleForce));
        $res=json_decode(json_decode($responseSF), true);
        // $res['result']['codigoError'] = 200;
        
        if ($res['result']['codigoError']==200) {
            // if ($res['beneficiarios'][0]['result']['codigoError']==200){
                if ($operacion==2) {
                    $bene = User::where('cedula', $beneficiario->persona_cedula)->first();
                    $bene->telefono = $request->telefono;
                    $bene->cedula = $request->cedula;
                    $bene->nombre = $request->nombre;
                    $bene->provincia = $request->provincia;
                    $bene->canton = $request->canton;
                    $bene->distrito = $request->distrito;
                    $bene->email = $request->email;
                    $bene->tipoId = $request->tipoId;
                    $bene->fecha_nac = $request->fechanacimiento;
                    $bene->estado_civil = $request->estadocivil;
                    $bene->save();
    
                    $beneficiario->persona_cedula = $request->cedula;
                    $beneficiario->save();
    
                    return Response::json(['mensaje'=> 'Beneficiario Modificado','array' => $res], 201);
    
                } elseif ($operacion==3) {
                    $bene = User::where('cedula', $beneficiario->persona_cedula)->first();
                    $bene->delete();
    
                    $bene2 = Beneficiario::where('persona_cedula', $beneficiario->persona_cedula)->first();
                    $bene2->delete();
    
                    $arraypersona = array(
                        "beneCedula" => $beneficiario->persona_cedula,
                        'date_delete' => date("Ymdhis"),
                        'date_renew' => date("Ymdhis")+10000000000
                    );
    
                    $bene_delete = Bene_Delete::create($arraypersona);
                    $bene_delete->save();
    
                    return Response::json(['mensaje'=> 'Beneficiario Eliminado','array' => $res], 201);
    
                } elseif ($operacion==1) {

                    if (isset($request->codigo_promocion)) {
                        //canjear codigo
                        $pacontroller = new PromocionesafiliadoController;
                        $pacontroller->canjearCodigo($afiliado->cli);
                    }

                    $arraypersona = array(
                        'tipoId' =>  $request->tipoId,
                        'cedula' =>  $request->cedula,
                        'nombre' =>  $request->nombre,
                        'apellido1' =>  $request->apellido1,
                        'apellido2' =>  $request->apellido2,
                        'genero' =>  $request->genero,
                        'fecha_nac' =>  $request->fechanacimiento,
                        'telefono' =>  $request->telefono,
                        'celular' =>  $request->telefono,
                        'email' =>  $request->email,
                        'provincia' =>  $request->provincia,
                        'canton' =>  $request->canton,
                        'distrito' =>  $request->distrito,
                        'estado_civil' =>  $request->estadocivil,
                    );
    
                    $personabene = User::updateOrCreate(['cedula' => $request->cedula],$arraypersona);
                    $personabene->save();
    
                    $arraybene = array(
                        'persona_cedula' => $request->cedula,
                        'afiliado_cedula' => $afiliado->persona_cedula,
                        'parentesco' => $request->parentesco,
                        'oncosmart' => $onco,
                        'NumeroBeneficiaro' => "",
                        'estadoBeneficiario'=> "Activo",
                        'fechaUltimaInactivacion'=> "",
                        'fechaUltimaInactivacionOncosmart'=> "",
                        'idBen'=> $res['beneficiarios'][0]['idBen'],
                        'tipoCobertura'=> "",
                    );
    
                    $beneficiario3 = Beneficiario::updateOrCreate(['persona_cedula'=> $request->cedula, 'afiliado_cedula' => $afiliado->persona_cedula], $arraybene);
                    $beneficiario3->save();
    
                    return Response::json(['mensaje'=> 'Beneficiario Agregado','array' => $res], 201);
                }

            // }else{
            //     return Response::json(['message'=> $res['beneficiarios'][0]['result']['mensaje'],'array' => $res], 403);
            // }            
        }else{
            return Response::json(['message'=> $res['result']['mensaje'],'array' => $res], 403);
        }
    }

    function arrayAction($operacion, $tipo, $request, $onco, $beneficiario){
        switch ($operacion) {
            case 1:
                $data = array(
                    'benAccion'         => 'insert',
                    'idBen'             => '',
                    'tipoIdentificacion'=> $tipo,
                    'cedula'            => $request->cedula,
                    'nombreBeneficiario'=> $request->nombre. " " .$request->apellido1." ".$request->apellido2,
                    'telefono'          => $request->telefono,
                    'parentezco'        => $request->parentesco,
                    'correo'            => $request->email,
                    'provincia'         => $request->provincia,
                    'canton'            => $request->canton,
                    'distrito'          => $request->distrito,
                    'estadoCivil'       =>'',
                    'coberturaOncosmart'=> $onco,
                    'genero'            => $request->genero,
                    'cventa'            => 'Tienda en Línea',
                    'campanna'          => 'Web',
                    'vendedor'          => 'jreyes'
                );
                break;
            case 2:
                $data = array(
                    'benAccion'         => 'update',
                    'idBen'             => $beneficiario->idBen,
                    'tipoIdentificacion'=> $tipo,
                    'cedula'            => $request->cedula,
                    'nombreBeneficiario'=> $request->nombre,
                    'telefono'          => $request->telefono,
                    'parentezco'        => $beneficiario->parentesco,
                    'correo'            => $request->email,
                    'provincia'         => $request->provincia,
                    'canton'            => $request->canton,
                    'distrito'          => $request->distrito,
                    'estadoCivil'       =>'',
                    'coberturaOncosmart'=> $onco,
                    'genero'            => $request->genero,
                    'cventa'            => 'Tienda en Línea',
                    'campanna'          => 'Web',
                    'vendedor'          => 'jreyes'

                );
                break;
            case 3:
                $data = array(
                    'benAccion'         => 'delete',
                    'idBen'             => $beneficiario->idBen,
                    'tipoIdentificacion'=> $tipo,
                    'cedula'            => $beneficiario->persona_cedula,
                    'telefono'          => $beneficiario->telefono,
                    'parentezco'        => $beneficiario->parentesco,
                    'correo'            => $beneficiario->email,
                    'provincia'         => $beneficiario->provincia,
                    'canton'            => $beneficiario->canton,
                    'distrito'          => $beneficiario->distrito,
                    'estadoCivil'       =>'',
                    'coberturaOncosmart'=> $onco,
                    'genero'            => $beneficiario->genero,
                    'nombreBeneficiario'=> $beneficiario->nombre,
                    'cventa'            => 'Tienda en Línea',
                    'campanna'          => 'Web',
                    'vendedor'          => 'jreyes'

                );
                break;
        }

        return $data;
    }

    public function generatepassword(Request $request)
    {
        $beneficiario = Beneficiario::join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                            ->where('NumeroBeneficiaro', $request->ben)
                            ->first();

        // if (empty($beneficiario)) {
        if (empty($beneficiario) || $beneficiario->email == "" || empty($beneficiario->email)) {
            if (!empty($beneficiario)) {
                User::where('cedula', $beneficiario->persona_cedula)->delete();
                Beneficiario::where('NumeroBeneficiaro', $request->ben)->delete();
            }

            //salesforce
            $salesforcontroller = new SalesforceController;
            $responseSF = $salesforcontroller->getData($request->ben);

            $res = json_decode(json_decode($responseSF), true);
            if ($res['existe']) {
                //get bene
                $bene = $res['benResults'][0];

                //save data
                $ben = array(
                    'NumeroBeneficiaro'=>$bene['numeroBen'],
                    'oncosmart'=>$bene['oncosmart'],
                    'estadoBeneficiario'=>$bene['estado'],
                    'tipoCobertura'=>$bene['tipoCoberutura'],
                    'afiliado_cedula' => '00000001',
                    'persona_cedula'=> $bene['cedula'],
                );

                //Limpio persona
                $persona = Beneficiario::where('persona_cedula', $bene['cedula'])->delete();

                $beneficiario = Beneficiario::create($ben);
                $beneficiario->save();

                $persona = User::where('cedula', $beneficiario->persona_cedula)->first();
                if (!empty($persona)) {
                    $persona->email = $bene['correoBen'];
                    $persona->save();
                }else{
                    $arraypersona = array(
                        'tipoId'=>1,
                        'cedula'=>$bene['cedula'],
                        'nombre'=>$bene['nombre'],
                        'email'=>$bene['correoBen'],
                    );
                    $personanuevo = User::create($arraypersona);
                    $personanuevo->save();
                }

            }else{
                return Response::json(['message' => 'No encontramos ningún usuario con ese código de beneficiario'], 403);
            }
        }else if($beneficiario->password != "" || !empty($beneficiario->password)){
            return Response::json(['message' => 'Ya contás con una cuenta activa'], 403);
        }else if($beneficiario->email == "" || empty($beneficiario->email)){
            return Response::json(['message' => 'No encontramos un correo ligado a tu cuenta. Para asignar un correo y activar el acceso a Autogestión, ponete en contacto al 2528-5400'], 403);
        }

        //enviar correo
        $this->sendEmailCreatePassword($beneficiario->email, $beneficiario->NumeroBeneficiaro);

        return Response::json(['message'=> 'Usuario encontrado'], 201);
    }

    public function sendEmailCreatePassword($email, $ben)
    {   
        $object = array(
            "email"   => $email,
            "ben"     => $ben,
            "afiliado" => false,
        );

        $string = json_encode($object);
        $link = App::make('url')->to('/control/beneficiario-crear-contrasena/'.encrypt($string));
        
        $data = array(
            'email' => $email,
            'title'=>'Su usuario está generado',
            'link' => $link,
            'button' => 'Creá tu usuario',
            "image" => asset('control/images/cropped-Logo-MediSmart-Blanco-2.png'),
            "url" => route('index')
        );

        $this->dispatch(new NewPasswordEmail($data));
    }

    public function savePassword(Request $request){
        $data = json_decode(decrypt($request->data));

        if (!HelpersController::compararcontraseñas($request->contrasena, $request->repeat_password)){
            return Response::json(['message' => 'Las contraseñas no coinciden'], 403);
        }

        $beneficiario = Beneficiario::join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                            ->where('NumeroBeneficiaro', $data->ben)
                            ->first();

        if (empty($beneficiario)) {
            return Response::json(['message' => 'No encontramos ningún usuario con ese código de beneficiario'], 403);
        }else if($beneficiario->password != "" || !empty($beneficiario->password)){
            return Response::json(['message' => 'Ya contás con una cuenta activa'], 403);
        }else if($beneficiario->email == "" || empty($beneficiario->email)){
            return Response::json(['message' => 'No encontramos un correo ligado a tu cuenta. Para asignar un correo y activar el acceso a Autogestión, ponete en contacto al 2528-5400'], 403);
        }
        
        $beneficiario->password = $request->contrasena;
        $beneficiario->save();
        
        return Response::json(array(), 200);
    }
}
