<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use Response;
use Auth;
use App;
use DB;

//models
use App\User;
use App\Afiliado;
use App\Provincias;
use App\Cantones;
use App\Distritos;
use App\Beneficiario;

//controller
use App\Http\Controllers\SalesforceController;
use App\Http\Controllers\HelpersController;

//jobs
use App\Jobs\NewPasswordEmail;

class AfiliadoController extends Controller
{
    function obtenerXCli($cli){
        return Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')->where('cli', $request->cli)->first();
    }

    public function actualizarAfiliado(Request $request)
    {
        $afiliado =  Afiliado::where('persona_cedula', Auth::user()->cedula)->first();
        $persona = User::where('cedula', $afiliado->persona_cedula)->first();

        $oncosmart = $afiliado->oncosmart = 0 ? false : true;
        if ($request->has('oncosmart')){
            switch ($request->input('oncosmart')) {
                case 0:
                $oncosmart = false;
                break;
                case 1:
                $oncosmart = true;
                break;
            }
        }

        $aSaleForce = array(
            'numeroCliente'   => $afiliado->cli,
            'telefonoCelular' => $request->input('telefono'),
            'correo'          => $persona->email,
            'direccion'       => '',
            'provincia'       => $request->input('provincia'),
            'canton'          => $request->input('canton'),
            'distrito'        => $request->input('distrito'),
            'estadoCivil'     =>'',
            "coberturaOncosmart" => $oncosmart,
            'genero'          => $persona->genero,
            
        );
        
        
        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->actualizarInfoCliente(json_encode($aSaleForce));
        $res=json_decode($responseSF, true);
        
        if ($res['resultado']==true) {
            $persona->telefono  = $request->input('telefono');
            $persona->celular   = $request->input('telefono');
            $persona->genero    = $persona->genero;
            $persona->provincia = $request->input('provincia');
            $persona->canton    = $request->input('canton');
            $persona->distrito  = $request->input('distrito');
            $persona->save();

            return Response::json(['code' => '201','respuesta'=> $res,'message' => 'Datos de Contacto actualizados correctamente', 'data'=>$request->all()], 201);;
        } else {
            return Response::json(['message' => 'Ha ocurrido un problema con la actualización de tus datos, intente mas tarde.', 'respuesta'=> $res, 'afiliado'=> $afiliado, 'cedula'=>Auth::user()->cedula, 'data'=>$request->all()], 403);
        }
    }


    public function generatepassword(Request $request)
    {
        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                            ->where('persona_cedula', $request->cedula)
                            ->first();

        if (!empty($afiliado)) {
            DB::table('afiliado')
                ->where('usuario', $afiliado->usuario)
                ->update(['autouniq' => NULL]);

            // return Response::json(['message'	=> 'Ya contás con una cuenta activa'], 403);
        }

        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->getData(json_encode($request->cedula));

        $res2 = json_decode(json_decode($responseSF), true);

        if ($res2['existe']) {
            if (!empty($res2['accountResults'][0]['correo'])) {
                //enviar correo
                return $this->sendEmailCreatePassword($res2['accountResults'][0]['correo'], $res2['accountResults'][0]['numeroCliente']);

                return Response::json(['message'=> 'Usuario encontrado'], 201);

            } else {
                return Response::json(['message' => 'No encontramos un correo ligado a tu cuenta. Para asignar un correo y activar el acceso a Autogestión, ponete en contacto al 2528-5400'], 403);
            }
        }

        return Response::json(['message'	=> 'Usuario no encontrado'], 403);
    }

    public function sendEmailCreatePassword($email, $cli)
    {   
        $object = array(
            "email"   => $email,
            "cli"     => $cli,
            "afiliado" => true,
        );

        $string = json_encode($object);
        $link = App::make('url')->to('/control/afiliado-crear-contrasena/'.encrypt($string));
        
        $data = array(
            'email' => $email,
            'link' => $link,
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

        // $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
        //                     ->where('cli', $data->cli)
        //                     ->first();

        // if (!empty($afiliado)) {
        //     return Response::json(['message'	=> 'Ya contás con una cuenta activa'], 403);
        // }
        
        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->getClientInformation($data->cli);
        $responseSF = json_decode(json_decode($responseSF), true);

        switch ($responseSF['cliente']['tipoIdentificacion']) {
            case "Cedula física":$tipoId=1;break;
            case "Dimex":$tipoId=2;break;
            case "Extranjero":$tipoId=3;break;
            default: $tipoId=1; break;
        }

        switch ($responseSF['cliente']['frecuenciaPago']) {
            case "Mensual":$frecuancia="PLAN MENSUAL";break;
            case "Semestra":$frecuancia="PLAN SEMESTRAL";break;
            default:$frecuancia="PLAN MENSUAL";break;
        }

        $provincia = count(Provincias::where('NAME',$responseSF['cliente']['provincia'])->get()) > 1 ? Provincias::where('NAME',$responseSF['cliente']['provincia'])->first(): Provincias::where('CODIGOPROVINCIA',10)->first();
        $canton = count(Cantones::where('NAME',$responseSF['cliente']['canton'])->get()) > 1 ? Cantones::where('NAME',$responseSF['cliente']['canton'])->first() : Cantones::where('CODIGOCANTON_C',"1010")->first();
        $distrito = count(Distritos::where('NAME',$responseSF['cliente']['distrito'])->get()) > 1 ? Distritos::where('NAME',$responseSF['cliente']['distrito'])->first() : Distritos::where('CODIGODISTRITO_C',"101001")->first();

        if (!isset($responseSF['cliente']['correo'])){
            return Response::json(['message'	=> 'Tu usuario no tiene un correo afiliado aún. Ponte en contacto al 2528-5400'], 403);
        }

        if (!isset($responseSF['cliente']['cedula'])){
            return Response::json(['message'	=> 'Falta información en tu usuario. Ponte en contacto al 2528-5400.'], 403);
        }

        //Limpio persona
        $persona = User::where('cedula', $responseSF['cliente']['cedula'])->delete();
        $afiliado = Afiliado::where('persona_cedula', $responseSF['cliente']['cedula'])->delete();

        //create persona
        $persona = new User;
        $persona->tipoId    = $tipoId;
        $persona->cedula    = $responseSF['cliente']['cedula'];
        $persona->nombre    = isset($responseSF['cliente']['nombreCompleto']) ? $responseSF['cliente']['nombreCompleto'] : '';
        $persona->telefono  = isset($responseSF['cliente']['telefonoCelular']) ? $responseSF['cliente']['telefonoCelular'] : '';
        $persona->celular   = isset($responseSF['cliente']['telefonoCelular']) ? $responseSF['cliente']['telefonoCelular'] : '';
        $persona->genero    = isset($responseSF['cliente']['genero']) ? $responseSF['cliente']['genero'] : '';
        $persona->email     = $responseSF['cliente']['correo'];
        $persona->provincia = $provincia->CODIGOPROVINCIA;
        $persona->canton    = $canton->CODIGOCANTON_C;
        $persona->distrito  = $distrito->CODIGODISTRITO_C;
        $persona->save();

        //create afiliado
        $afiliado = new Afiliado;
        $afiliado->persona_cedula   = $responseSF['cliente']['cedula'];
        $afiliado->usuario          = $responseSF['cliente']['correo'];
        $afiliado->contrasena       = $request->contrasena;
        $afiliado->idFrecPago       = $frecuancia;
        $afiliado->oncosmart        = (isset($responseSF['cliente']['coberturaOncosmart']) ? $responseSF['cliente']['coberturaOncosmart'] : false) ? 1 : 0;
        $afiliado->cli              = $data->cli;
        $afiliado->estadoTitular    = isset($responseSF['cliente']['estadoTitular']) ? $responseSF['cliente']['estadoTitular'] : '';
        $afiliado->fechaPago        = isset($responseSF['cliente']['fechaPago']) ? $responseSF['cliente']['fechaPago'] : '';
        $afiliado->fechaUltimaInactivacionOncosmart = isset($responseSF['cliente']['fechaUltimaInactivacionOncosmart']) ? $responseSF['cliente']['fechaUltimaInactivacionOncosmart'] : '';
        $afiliado->formaPago        = isset($responseSF['cliente']['formaPago']) ? $responseSF['cliente']['formaPago'] : '';
        $afiliado->frecuenciaPago   = isset($responseSF['cliente']['frecuenciaPago']) ? $responseSF['cliente']['frecuenciaPago'] : '';
        $afiliado->tipoCobertura    = isset($responseSF['cliente']['tipoCobertura']) ? $responseSF['cliente']['tipoCobertura'] : '';
        $afiliado->save();
        
        return Response::json(array(), 200);
    }

    public function updatePassword(Request $request){
        $data = json_decode(decrypt($request->data));

        if (!HelpersController::compararcontraseñas($request->contrasena, $request->repeat_password)){
            return Response::json(['message' => 'Las contraseñas no coinciden'], 403);
        }

        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                            ->where('usuario' , '=', $data->email)->first();

        DB::table('afiliado')
            ->where('usuario', $afiliado->usuario)
            ->update(['autouniq' => NULL,'changePassword' => '0']);

        if (empty($afiliado)){
            $beneficiario = Beneficiario::join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                                        ->where('personas.email' , '=', $data->email)->first();

            if (empty($beneficiario)){
                return Response::json(['message' => 'No existe un usuario con ese correo electrónico'], 403);
            }else{
                //create afiliado
                $beneficiario->password = $request->contrasena;
                $afiliado->save();

                return Response::json(array(), 200);
            }
        }

        //create afiliado
        $afiliado->contrasena = $request->contrasena;
        $afiliado->save();
        
        return Response::json(array(), 200);
    }

    public function generateNewPassword($data){
        return view('app.generatepassword')
                ->with('data', $data);
    }

    public function generateNewPasswordAutouniq($autouniq){
        $afiliado = Afiliado::where('autouniq', $autouniq)->first();

        if (isset($afiliado) && $afiliado != null) {
            $object = array(
                "email"   => $afiliado->usuario,
                "cli"     => $afiliado->cli,
                "afiliado" => true,
            );
    
            $string = json_encode($object);
            return redirect()->route('afiliado.create.password', ['data' => encrypt($string), 'afilemail' => $afiliado->usuario]);
        }else{
            return redirect()->route('afiliado.link.desactivado');
        }
    }

    public function setNewPassword(Request $request){
        $data = json_decode(decrypt($request->data));

        if (!HelpersController::compararcontraseñas($request->password, $request->repeat_password)){
            return Response::json(['message' => 'Las contraseñas no coinciden'], 403);
        }

        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                            ->where('cli' , '=', $data->cli)->first();

        //create afiliado
        $afiliado->contrasena = $request->password;
        $afiliado->save();
        
        return Response::json(array(), 200);
    }

    function eliminar($afiliado, $user, $bene){
        DB::statement('DELETE FROM personas WHERE cedula IN (SELECT persona_cedula FROM beneficiario WHERE afiliado_cedula = "'. $user->cedula .'")');
        DB::statement('DELETE FROM beneficiario WHERE afiliado_cedula = "'. $user->cedula .'"');

        //Tarjetas
        if ($afiliado != null && is_object($afiliado)){
            DB::statement('DELETE FROM tarjetas WHERE idTarjeta = (SELECT idTarjeta FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1)');
            DB::statement('DELETE FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1');
            DB::statement('DELETE FROM tarjetas WHERE idTarjeta = (SELECT idTarjeta FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1)');
            DB::statement('DELETE FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1');
            DB::statement('DELETE FROM tarjetas WHERE idTarjeta = (SELECT idTarjeta FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1)');
            DB::statement('DELETE FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1');
            DB::statement('DELETE FROM tarjetas WHERE idTarjeta = (SELECT idTarjeta FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1)');
            DB::statement('DELETE FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1');
            DB::statement('DELETE FROM tarjetas WHERE idTarjeta = (SELECT idTarjeta FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1)');
            DB::statement('DELETE FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1');
            DB::statement('DELETE FROM tarjetas WHERE idTarjeta = (SELECT idTarjeta FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1)');
            DB::statement('DELETE FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'" LIMIT 1');
            DB::statement('DELETE FROM tarjetas_afiliado_relacion WHERE numeroCliente = "'. $afiliado->cli .'"');
            DB::statement('DELETE FROM afiliado WHERE cli = "'. $afiliado->cli .'"');   
        }

        if ($bene != null && is_object($bene)){
            DB::statement('DELETE FROM beneficiario WHERE persona_cedula = "'. $bene->persona_cedula .'"');
        }

        DB::statement('DELETE FROM personas WHERE cedula = "'. $user->cedula .'"');
    }
}
