<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\SalesforceController;
use Response;

//models
use App\User;
use App\Beneficiario;
use App\Afiliado;
use App\Tarjetas;
use App\Tarjetas_Afiliados_Relacion;
use App\Provincias;
use App\Cantones;
use App\Distritos;

class AdministratorController extends Controller
{
    public function searchUser(Request $request){
        $persona = User::where('cedula', $request->cedula)->get();

        if (count($persona) > 0)
            return Response::json(['message' => 'El usuario ya existe.'], 403);

        //VALIDAR 
        $salesforcontroller = new SalesforceController;
        $response = $salesforcontroller->getClientInformationData($request->cedula);
        return $response;
    }
    
    public function agregarusuario(Request $request){

        $length = 8;    
        $newpassword = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'),1,$length);

        //VALIDAR 
        $salesforcontroller = new SalesforceController;
        $response = $salesforcontroller->getClientInformation($request->cli);
        $response = json_decode(json_decode($response), true);

        if ($request->has('numBen') && $request->numBen != null && $request->numBen != ''){
            foreach($response['cliente']['Beneficiarios'] as $beneficiario){
                if ($beneficiario['NumeroBeneficiaro'] == $request->numBen){
                    switch ($beneficiario['tipoIdentificacion']) {
                        case "Cedula física":$tipoId=1;break;
                        case "Dimex":$tipoId=2;break;
                        case "Extranjero":$tipoId=3;break;
                        default: $tipoId=1; break;
                    }
            
                    $provincia = count(Provincias::where('NAME',$beneficiario['provincia'])->get()) > 1 ? Provincias::where('NAME',$beneficiario['provincia'])->first(): Provincias::where('CODIGOPROVINCIA',10)->first();
                    $canton = count(Cantones::where('NAME',$beneficiario['canton'])->get()) > 1 ? Cantones::where('NAME',$beneficiario['canton'])->first() : Cantones::where('CODIGOCANTON_C',"1010")->first();
                    $distrito = count(Distritos::where('NAME',$beneficiario['distrito'])->get()) > 1 ? Distritos::where('NAME',$beneficiario['distrito'])->first() : Distritos::where('CODIGODISTRITO_C',"101001")->first();
            
                    if (!isset($beneficiario['correo'])){
                        return Response::json(['message' => 'El usuario no tiene un correo electrónico asignado'], 403);
                    }
            
                    if (!isset($beneficiario['cedula'])){
                        return Response::json(['message'=> 'El usuario no tiene cédula asignada'], 403);
                    }
        
                    User::where('cedula', $beneficiario['cedula'])->delete();
                    Beneficiario::where('persona_cedula', $beneficiario['cedula'])->delete();

                    //create persona
                    $persona = new User;
                    $persona->tipoId    = $tipoId;
                    $persona->cedula    = $beneficiario['cedula'];
                    $persona->nombre    = isset($beneficiario['nombreCompleto']) ? $beneficiario['nombreCompleto'] : '';
                    $persona->telefono  = isset($beneficiario['telefonoCelular']) ? $beneficiario['telefonoCelular'] : '';
                    $persona->celular   = isset($beneficiario['telefonoCelular']) ? $beneficiario['telefonoCelular'] : '';
                    $persona->genero    = isset($beneficiario['genero']) ? $beneficiario['genero'] : '';
                    $persona->email     = $beneficiario['correo'];
                    $persona->provincia = $provincia->CODIGOPROVINCIA;
                    $persona->canton    = $canton->CODIGOCANTON_C;
                    $persona->distrito  = $distrito->CODIGODISTRITO_C;
                    $persona->save();

                    $arraybene = array(
                        'persona_cedula' => $beneficiario['cedula'],
                        'afiliado_cedula' => $response['cliente']['cedula'],
                        'parentesco' => $beneficiario['parentezco'],
                        'oncosmart' => $beneficiario['coberturaOncosmart'],
                        'NumeroBeneficiaro' => $beneficiario['NumeroBeneficiaro'],
                        'estadoBeneficiario'=> $beneficiario['estadoBeneficiario'],
                        'fechaUltimaInactivacion'=> "",
                        'fechaUltimaInactivacionOncosmart'=> "",
                        'idBen'=> $beneficiario['idBen'],
                        'tipoCobertura'=> $beneficiario['tipoCobertura'],
                        'password'=> $newpassword,
                        'changePassword' => 1,
                    );
    
                    Beneficiario::create($arraybene);

                    return $newpassword;
                }
            }
        }else{
            switch ($response['cliente']['tipoIdentificacion']) {
                case "Cedula física":$tipoId=1;break;
                case "Dimex":$tipoId=2;break;
                case "Extranjero":$tipoId=3;break;
                default: $tipoId=1; break;
            }
    
            switch ($response['cliente']['frecuenciaPago']) {
                case "Mensual":$frecuancia="PLAN MENSUAL";break;
                case "Semestra":$frecuancia="PLAN SEMESTRAL";break;
                default:$frecuancia="PLAN MENSUAL";break;
            }
    
            $provincia = count(Provincias::where('NAME',$response['cliente']['provincia'])->get()) > 1 ? Provincias::where('NAME',$response['cliente']['provincia'])->first(): Provincias::where('CODIGOPROVINCIA',10)->first();
            $canton = count(Cantones::where('NAME',$response['cliente']['canton'])->get()) > 1 ? Cantones::where('NAME',$response['cliente']['canton'])->first() : Cantones::where('CODIGOCANTON_C',"1010")->first();
            $distrito = count(Distritos::where('NAME',$response['cliente']['distrito'])->get()) > 1 ? Distritos::where('NAME',$response['cliente']['distrito'])->first() : Distritos::where('CODIGODISTRITO_C',"101001")->first();
    
            if (!isset($response['cliente']['correo'])){
                return Response::json(['message' => 'El usuario no tiene un correo electrónico asignado'], 403);
            }
    
            if (!isset($response['cliente']['cedula'])){
                return Response::json(['message'=> 'El usuario no tiene cédula asignada'], 403);
            }

            //Limpio persona
            User::where('cedula', $response['cliente']['cedula'])->delete();
            Afiliado::where('persona_cedula', $response['cliente']['cedula'])->delete();
            Beneficiario::where('afiliado_cedula', $response['cliente']['cedula'])->delete();

            //create persona
            $persona = new User;
            $persona->tipoId    = $tipoId;
            $persona->cedula    = $response['cliente']['cedula'];
            $persona->nombre    = isset($response['cliente']['nombreCompleto']) ? $response['cliente']['nombreCompleto'] : '';
            $persona->telefono  = isset($response['cliente']['telefonoCelular']) ? $response['cliente']['telefonoCelular'] : '';
            $persona->celular   = isset($response['cliente']['telefonoCelular']) ? $response['cliente']['telefonoCelular'] : '';
            $persona->genero    = isset($response['cliente']['genero']) ? $response['cliente']['genero'] : '';
            $persona->email     = $response['cliente']['correo'];
            $persona->provincia = $provincia->CODIGOPROVINCIA;
            $persona->canton    = $canton->CODIGOCANTON_C;
            $persona->distrito  = $distrito->CODIGODISTRITO_C;
            $persona->save();

            //create afiliado
            $afiliado = new Afiliado;
            $afiliado->persona_cedula   = $response['cliente']['cedula'];
            $afiliado->usuario          = $response['cliente']['correo'];
            $afiliado->contrasena       = $newpassword;
            $afiliado->idFrecPago       = $frecuancia;
            $afiliado->oncosmart        = (isset($response['cliente']['coberturaOncosmart']) ? $response['cliente']['coberturaOncosmart'] : false) ? 1 : 0;
            $afiliado->cli              = $request->cli;
            $afiliado->estadoTitular    = isset($response['cliente']['estadoTitular']) ? $response['cliente']['estadoTitular'] : '';
            $afiliado->fechaPago        = isset($response['cliente']['fechaPago']) ? $response['cliente']['fechaPago'] : '';
            $afiliado->fechaUltimaInactivacionOncosmart = isset($response['cliente']['fechaUltimaInactivacionOncosmart']) ? $response['cliente']['fechaUltimaInactivacionOncosmart'] : '';
            $afiliado->formaPago        = isset($response['cliente']['formaPago']) ? $response['cliente']['formaPago'] : '';
            $afiliado->frecuenciaPago   = isset($response['cliente']['frecuenciaPago']) ? $response['cliente']['frecuenciaPago'] : '';
            $afiliado->tipoCobertura    = isset($response['cliente']['tipoCobertura']) ? $response['cliente']['tipoCobertura'] : '';
            $afiliado->changePassword   = 1;
            $afiliado->save();

            return $newpassword;
        }
    }
}
