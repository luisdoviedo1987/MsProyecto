<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;
use Mail;
use Auth;
use App;

//controllers
use App\Http\Controllers\SalesforceController;
use App\Http\Controllers\ShoppingcartController;

//models
use App\User;
use App\Beneficiario;
use App\Mascotas;
use App\Afiliado;
use App\Tarjetas;
use App\Tarjetas_Afiliados_Relacion;
use App\Provincias;
use App\Cantones;
use App\Distritos;


class LoginController extends Controller
{
    public function login(Request $request){
        //clean shopping cart
        $shoppingcartcontroller = new ShoppingcartController;
        $shoppingcartcontroller->limpiar();
        
        $afiliado = DB::table('afiliado')
                    ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                    ->where([
                            [	'usuario' , '=', $request->user],
                            [	'contrasena' , '=', $request->password]
                    ])->first();
        
        if ($afiliado) {
            if (!Auth::check()) {
                Auth::loginUsingId($afiliado->persona_cedula);
            }
            
            if (isset($this->loginAfiliado()->data)){
                return redirect()->route('afiliado');
            }else{
                Auth::logout();
                return redirect()->route('login');
            }

        }else{
            $beneficiario = Beneficiario::join('personas', 'persona_cedula', '=', 'cedula')->where([
                                            ['email',$request->input('user')],
                                            ['password',$request->input('password')],
                                        ])->first();

            if ($beneficiario) {
                if (!Auth::check()) {
                    Auth::loginUsingId($beneficiario->persona_cedula);
                }
                
                if (isset($this->loginAfiliado()->data)){
                    return redirect()
                       ->route('afiliado')
                       ->width('data', $this->loginAfiliado($request));
                }else{
                    Auth::logout();
                    return redirect()->route('login');
                }
            } else {
                Auth::logout();
                return redirect()->route('login');
            }
        }
    }

    public function loginAfiliado(Request $request = null)
    {
        //logout
        Auth::logout();

        //set the response
        $response = null;
        
        //delete cart
        $shoppingcartcontroller = new ShoppingcartController;
        $shoppingcartcontroller->limpiar();
        
        $afiliados = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where('usuario' , '=', $request->user)
                        ->get();

        $beneficiarios = Beneficiario::join('personas', function ($join) use($request) {
                                $join->on('persona_cedula', '=', 'personas.cedula')
                                    ->where('personas.email', $request->input('user'));
                            })
                            ->get();

        $isAfiliado = false;
        $kickOut = true;
        foreach($afiliados as $afiliado){
            if($afiliado->contrasena == $request->password){
                $kickOut = false;
                $isAfiliado = true;
            }

            //obtener la información de salesforce
            $salesforceController = new SalesforceController;
            $responseSF = $salesforceController->getClientInformation($afiliado->cli);
            $res=json_decode(json_decode($responseSF), true);
                        
            if ($res['existe']) {
                $afiliado_db = Afiliado::where('persona_cedula', $afiliado->persona_cedula)
                                        ->where('cli', $afiliado->cli)
                                        ->first();
                $afiliado_db->estadoTitular = $res['cliente']['estadoTitular'];
                $afiliado_db->save();
            }
        }

        foreach($beneficiarios as $beneficiario){
            if($beneficiario->password == $request->password){
                $kickOut = false;
            }
        }

        if ($kickOut){
            $response = Response::json(['mensaje'=>'Contraseña incorrecta'], 403);
            return $response;
        }

        foreach($afiliados as $afiliado){
            if ($afiliado->administrador){
                Auth::loginUsingId($afiliado->persona_cedula);
                return Response::json(array(), 201);
            }else{
                $beneficiario = DB::table('beneficiario')
                                ->join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                                ->where('beneficiario.afiliado_cedula', '=', $afiliado->cedula)
                                ->get();

                $mascotas = DB::table('mascotas')
                            ->where('persona_cedula', '=', $afiliado->cedula)
                            ->get();

                //add information
                $afiliado->{'beneficiarios'} = $beneficiario;
                $afiliado->{'mascotas'} = $mascotas;
            
                //obtener la información de salesforce
                $salesforceController = new SalesforceController;
                $responsePets = $salesforceController->getClientInformationData($afiliado->cli);
                $responseSF = $salesforceController->getClientInformation($afiliado->cli);
                // $response = Response::json(['mensaje'=>$responseSF], 403);
                // return $response;
                $res=json_decode(json_decode($responseSF), true);
                $resPet=json_decode(json_decode($responsePets), true);

                // return Response::json([$afiliado->cli], 403);
                // return Response::json($resPet, 403);
                   
                if ($res['existe']) {

                    $afiliado_cambio = Afiliado::where('persona_cedula' , '=', $afiliado->persona_cedula)->first();

                    //cambio afiliado
                    if ( isset($resPet['accountResults'][0]['convenio']) && $resPet['accountResults'][0]['convenio'] != null) {
                        $afiliado_cambio->convenio = $resPet['accountResults'][0]['convenio'];
                        $afiliado_cambio->save();
                    }else if (isset($resPet['accountResults'][0]['conveniocli']) && $resPet['accountResults'][0]['conveniocli'] != null ) {
                        $afiliado_cambio->conveniocli = $resPet['accountResults'][0]['conveniocli'];
                        $afiliado_cambio->save();
                    }else{
                        $afiliado_cambio->convenio = null;
                        $afiliado_cambio->conveniocli = null;
                        $afiliado_cambio->save();
                    }

                    $this->udateDatosAfiliado($res['cliente']);

                    if ($res["cliente"]["estadoTitular"] != "Activo" && 
                        $res["cliente"]["estadoTitular"] != "Sin Cobertura" && 
                        $res["cliente"]["estadoTitular"] != "Inactivo Temporal en Proceso de Cobro"){
                        if ($response == null){
                            $response = Response::json(['mensaje'=>"Lo sentimos tu cuenta tiene un estado de ".$res["cliente"]["estadoTitular"]], 403);
                            // return $response;
                        }
                    }

                    $afiliado->{'tarjetas'} = $res['cliente']['Tarjetas'];
                    if (!empty($res['cliente']['Beneficiarios'])) {
                        $this->udateDatosBen($resPet['benResults'], $res['cliente']["Beneficiarios"], $res['cliente']['cedula'], $afiliado->cli);
                    }

                    if (!empty($res['cliente']['Tarjetas'])) {
                        $this->updateDatosTarjetas($res['cliente']['Tarjetas']);
                    }

                    if (!empty($res['cliente']['Mascotas'])) {
                        $this->updateDatosMascotas($res['cliente']['Mascotas'], $res['cliente']['cedula'], $resPet['petResults']);
                    }
                
                    $beneficiario = DB::table('beneficiario')
                                ->join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                                ->where('beneficiario.afiliado_cedula', '=', $afiliado->cedula)
                                ->get();

                    $mascotas = DB::table('mascotas')
                            ->where('persona_cedula', '=', $afiliado->persona_cedula)
                            ->get();
        
        
                    $afiliado = DB::table('afiliado')
                                ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                                ->where([
                                [	'persona_cedula' , '=', $afiliado->persona_cedula],
                                ])->first();

                    $tarjetas = Tarjetas::
                                    join('tarjetas_afiliado_relacion', 'tarjetas.idTarjeta', '=', 'tarjetas_afiliado_relacion.idTarjeta')
                                    ->where('numeroCliente', $afiliado->cli)
                                    ->get();

                    $afiliado->{'tarjetas'} = $tarjetas;
                    $afiliado->{'beneficiarios'} = $beneficiario;
                    $afiliado->{'mascotas'} = $mascotas;

                    $respuesta = array(
                        'data' => $afiliado,
                        'webs' => $res,
                        "afiliado"=> true,
                    );

                    if (($afiliado->estadoTitular == 'Activo' || 
                        $afiliado->estadoTitular == "Sin Cobertura" ||
                        $afiliado->estadoTitular == "Inactivo Temporal en Proceso de Cobro") && $isAfiliado){
                        Auth::loginUsingId($afiliado->persona_cedula);
                        $response = Response::json(array(), 201);
                    }
                } else {
                    $response = Response::json(['mensaje'=>'Usuario no encontrado. Por favor, registrese primero.'], 403);
                    return $response;
                }
            }
        }


        foreach($beneficiarios as $beneficiario) {
            $afiliado = DB::table('afiliado')
                    ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                    ->where(
                        'persona_cedula',
                        $beneficiario->afiliado_cedula
                    )->first();

            $respuesta = array(
                'data' => $beneficiario,
                "afiliado"=> false,
                "titular" =>$afiliado
            );
            
            if($beneficiario->password == $request->password){
                Auth::loginUsingId($beneficiario->persona_cedula);
                $response = Response::json(array(), 201);
                return $response;
            }
        }

        if ($response != null){
            return $response;
        }

        $response = Response::json(['mensaje'=>'Usuario no registrado. Por favor registrese primero.'], 403);
        return $response;
    }

    public function udateDatosAfiliado($afiliadosf)
    {
        $afiliado = Afiliado::where('persona_cedula', $afiliadosf['cedula'])->first();
        $afiliado->estadoTitular = $afiliadosf['estadoTitular'];
        $afiliado->fechaPago = $afiliadosf['fechaPago'];
        if ($afiliadosf['fechaUltimaInactivacionOncosmart'] != null) {
            $afiliado->fechaUltimaInactivacionOncosmart = $afiliadosf['fechaUltimaInactivacionOncosmart'];
        }
        $afiliado->formaPago = $afiliadosf['formaPago'];
        $afiliado->frecuenciaPago = $afiliadosf['frecuenciaPago'];
        $afiliado->tipoCobertura = $afiliadosf['tipoCobertura'];
        $afiliado->costoPlan = $afiliadosf['costoPlan'];
        $afiliado->save();

        
        $persona = User::where('cedula', $afiliadosf['cedula'])->first();
        $persona->fecha_nac = $afiliadosf['fechaNacimiento'];
        if(isset($afiliadosf['provincia'])){
            if (count(Provincias::where('NAME', $afiliadosf['provincia'])->get()) > 0) {
                $persona->provincia = Provincias::where('NAME', $afiliadosf['provincia'])->first()->CODIGOPROVINCIA;
            }
        }

        if(isset($afiliadosf['canton'])){
            if (count(Cantones::where('NAME', $afiliadosf['canton'])->get()) > 0){
                $persona->canton = Cantones::where('NAME', $afiliadosf['canton'])->first()->CODIGOCANTON_C;
            }
        }

        if(isset($afiliadosf['distrito'])){
            if (count(Distritos::where('NAME', $afiliadosf['distrito'])->get()) > 0) {
                $persona->distrito = Distritos::where('NAME', $afiliadosf['distrito'])->first()->CODIGODISTRITO_C;
            }
        }

        $persona->save();
    }

    public function updateDatosTarjetas($arrayTarjetas)
    {
        foreach ($arrayTarjetas as $key => $t) {
            $tarjetas = Tarjetas::join('tarjetas_afiliado_relacion', 'tarjetas.idTarjeta', '=', 'tarjetas_afiliado_relacion.idTarjeta')
                                ->where(
                                    [
                                        ['tarjetas.idTarjeta',$t['idTarjeta']],
                                        ['numeroCliente',$t['numeroCliente']]
                                    ])
                                ->first();

            if (!empty($tarjetas)) {
                $tarjetas->fechaVencimiento =$t['fechaVencimiento'];
                $tarjetas->nombreTitular    =$t['nombreTitular'];
                $tarjetas->numeroTarjeta    =$t['numeroTarjeta'];
                $tarjetas->principal        =$t['principal'];
                $tarjetas->tipoTarjeta      =$t['tipoTarjeta'];
                $tarjetas->save();
            } else {
                $data=array(
                    'idTarjeta'=>$t['idTarjeta'],
                    'fechaVencimiento'=>$t['fechaVencimiento'],
                    'nombreTitular'=>$t['nombreTitular'],
                    'numeroTarjeta'=>$t['numeroTarjeta'],
                    'principal'=>$t['principal'],
                    'tipoTarjeta'=>$t['tipoTarjeta'],
                );

                $tarjetasNuevo = Tarjetas::create($data);
                $tarjetasNuevo->save();
                $data2 = array(
                    'idTarjeta'=>$t['idTarjeta'],
                    'numeroCliente'=>$t['numeroCliente'],
                );

                $relacion = Tarjetas_Afiliados_Relacion::create($data2);
                $relacion->save();
            }
        }
    }

    public function udateDatosBen($arrayBene, $beneData, $afiliado, $cli){
       
        Beneficiario::where('afiliado_cedula', $afiliado)
        ->update(['estadoBeneficiario' => 'Inactivo']);

        foreach ($arrayBene as $key => $bene) {
                 
            if ($bene['numeroCliente'] == $cli){
                $tipoId= 1;
                // switch ($bene['tipoIdentificacion']) {
                //     case 'Cedula física':$tipoId= 1; break;
                //     case 'Dimex':$tipoId=2; break;
                //     case 'Extranjero':$tipoId=3; break;
                //     default: $tipoId= 1; break;
                // }

                $beneFinal = [];
                foreach ($beneData as $row){
                    if (isset($bene["numeroBen"]) && isset($bene['cedula'])){
                        if($row["cedula"] == $bene['cedula'] && $row["NumeroBeneficiaro"] == $bene["numeroBen"]){
                            $beneFinal = $row;
                        }else if($row["NumeroBeneficiaro"] == $bene["numeroBen"]){
                            $beneFinal = $row;
                        }
                    }
                }
                
                if (isset($beneFinal['cedula']) && $beneFinal['cedula'] == null) {
                        
                    $beneficiario = Beneficiario::where('persona_cedula', "0")->first();
                    if (!empty($beneficiario)) {
                        $beneficiario->afiliado_cedula                  = $afiliado;
                        $beneficiario->NumeroBeneficiaro                = $beneFinal['NumeroBeneficiaro'];
                        $beneficiario->oncosmart                        = $beneFinal['coberturaOncosmart'];
                        $beneficiario->estadoBeneficiario               = $beneFinal['estadoBeneficiario'];
                        $beneficiario->tipoCobertura                    = $beneFinal['tipoCobertura'];
                        $beneficiario->save();

                        $persona = User::where('cedula', $beneficiario->persona_cedula)->first();

                        if (!empty($persona)) {
                                $persona->tipoId = $tipoId;
                                $persona->nombre = $beneFinal['nombreCompleto'];
                                $persona->genero = $beneFinal['genero'];
                                $persona->fecha_nac = $beneFinal['fechaNacimiento'];
                                $persona->telefono = $beneFinal['telefonoCelular'];
                                $persona->celular = $beneFinal['telefonoCelular'];
                                $persona->email = $beneFinal['correo'];
                                $persona->save();
                        }else{
                            $arraypersona = array(
                                'tipoId'=>$tipoId,
                                'cedula'=>$beneFinal['cedula'],
                                'nombre'=>$beneFinal['nombreCompleto'],
                                'genero'=>$beneFinal['genero'],
                                'fecha_nac'=>$beneFinal['fechaNacimiento'],
                                'telefono'=>$beneFinal['telefonoCelular'],
                                'celular'=>$beneFinal['telefonoCelular'],
                                'email'=>$beneFinal['correo'],
                            );
                            $personanuevo = User::create($arraypersona);
                            $personanuevo->save();
                        }
                    }
                 } else if (isset($beneFinal['cedula']) && $beneFinal['cedula'] != null) {

                    $beneficiario = Beneficiario::where('persona_cedula', $beneFinal['cedula'])->first();
                    if (!empty($beneficiario)) {
                        $beneficiario->afiliado_cedula                  = $afiliado;
                        $beneficiario->NumeroBeneficiaro                = $beneFinal['NumeroBeneficiaro'];
                        $beneficiario->oncosmart                        = $beneFinal['coberturaOncosmart'];
                        $beneficiario->estadoBeneficiario               = $beneFinal['estadoBeneficiario'];
                        $beneficiario->tipoCobertura                    = $beneFinal['tipoCobertura'];
                        $beneficiario->save();

                        $persona = User::where('cedula', $beneficiario->persona_cedula)->first();

                        if (!empty($persona)) {
                                $persona->tipoId = $tipoId;
                                $persona->nombre = $beneFinal['nombreCompleto'];
                                $persona->genero = $beneFinal['genero'];
                                $persona->fecha_nac = $beneFinal['fechaNacimiento'];
                                $persona->telefono = $beneFinal['telefonoCelular'];
                                $persona->celular = $beneFinal['telefonoCelular'];
                                $persona->email = $beneFinal['correo'];
                                $persona->save();
                        }else{
                            $arraypersona = array(
                                'tipoId'=>$tipoId,
                                'cedula'=>$beneFinal['cedula'],
                                'nombre'=>$beneFinal['nombreCompleto'],
                                'genero'=>$beneFinal['genero'],
                                'fecha_nac'=>$beneFinal['fechaNacimiento'],
                                'telefono'=>$beneFinal['telefonoCelular'],
                                'celular'=>$beneFinal['telefonoCelular'],
                                'email'=>$beneFinal['correo'],
                            );
                            $personanuevo = User::create($arraypersona);
                            $personanuevo->save();
                        }
                    } else {
                        $persona = User::where('cedula', $beneFinal['cedula'])->first();
                        if (!empty($persona)) {
                            $persona->tipoId = $tipoId;
                            $persona->nombre = $beneFinal['nombreCompleto'];
                            $persona->genero = $beneFinal['genero'];
                            $persona->fecha_nac = $beneFinal['fechaNacimiento'];
                            $persona->telefono = $beneFinal['telefonoCelular'];
                            $persona->celular = $beneFinal['telefonoCelular'];
                            $persona->email = $beneFinal['correo'];
                            $persona->save();
                        }else{
                            $arraypersona = array(
                                'tipoId'=>$tipoId,
                                'cedula'=>$beneFinal['cedula'],
                                'nombre'=>$beneFinal['nombreCompleto'],
                                'genero'=>$beneFinal['genero'],
                                'fecha_nac'=>$beneFinal['fechaNacimiento'],
                                'telefono'=>$beneFinal['telefonoCelular'],
                                'celular'=>$beneFinal['telefonoCelular'],
                                'email'=>$beneFinal['correo'],
                            );
                            $personanuevo = User::create($arraypersona);
                            $personanuevo->save();
                        }

                        $beneficiarionuevo = new Beneficiario;
                        $beneficiarionuevo->afiliado_cedula                  = $afiliado;
                        $beneficiarionuevo->NumeroBeneficiaro                = $beneFinal['NumeroBeneficiaro'];
                        $beneficiarionuevo->oncosmart                        = $beneFinal['coberturaOncosmart'];
                        $beneficiarionuevo->estadoBeneficiario               = $beneFinal['estadoBeneficiario'];
                        $beneficiarionuevo->tipoCobertura                    = $beneFinal['tipoCobertura'];
                        $beneficiarionuevo->persona_cedula                   = $beneFinal['cedula'];
                        $beneficiarionuevo->save();
                    }
                } else {

                    if (isset($beneFinal['NumeroBeneficiaro']) ){
                        $beneficiario = Beneficiario::where('NumeroBeneficiaro', $beneFinal['NumeroBeneficiaro'])->first();
                    
                        if (!empty($beneficiario)){
                            
                            $persona = User::where('cedula', $beneficiario['persona_cedula'])->first();
                            if (!empty($beneficiario)) {
                                $beneficiario['NumeroBeneficiaro']                = $beneFinal['NumeroBeneficiaro'];
                                $beneficiario['oncosmart']                        = $beneFinal['coberturaOncosmart'];
                                $beneficiario['estadoBeneficiario']               = $beneFinal['estadoBeneficiario'];
                                $beneficiario['tipoCobertura']                    = $beneFinal['tipoCobertura'];
                                $beneficiario->save();
            
                                $persona->nombre = $beneFinal['nombreCompleto'];
                                $persona->genero = $beneFinal['genero'];
                                $persona->fecha_nac = $beneFinal['fechaNacimiento'];
                                $persona->telefono = $beneFinal['telefonoCelular'];
                                $persona->celular = $beneFinal['telefonoCelular'];
                                $persona->email = $beneFinal['correo'];
                                $persona->save();
                            } else {
                                $arraybeneficiario = array(
                                    'persona_cedula' => $beneFinal['cedula'],
                                    'afiliado_cedula'=> $afiliado,
                                    'oncosmart'=>$beneFinal['coberturaOncosmart'],
                                    'NumeroBeneficiaro' => $beneFinal['NumeroBeneficiaro'],
                                    'estadoBeneficiario' =>$beneFinal['estadoBeneficiario'],
                                    'idBen' =>$beneFinal['idBen'],
                                    'tipoCobertura' =>$beneFinal['tipoCoberutura'],
                                );
                                $beneficiarionuevo=Beneficiario::create($arraybeneficiario);
                                $beneficiarionuevo->save();
                                
                                $arraypersona = array(
                                    'tipoId'=>$tipoId,
                                    'cedula'=>$beneFinal['cedula'],
                                    'nombre'=>$beneFinal['nombreCompleto'],
                                    'genero'=>$beneFinal['genero'],
                                    'fecha_nac'=>$beneFinal['fechaNacimiento'],
                                    'telefono'=>$beneFinal['telefonoCelular'],
                                    'celular'=>$beneFinal['telefonoCelular'],
                                );
                                $personanuevo = User::create($arraypersona);
                                $personanuevo->save();
                            }
                        }else{
                            echo "asdasd";die;
                        }
                    }  
                }
            }
        }
    }

    public function updateDatosMascotas($arrayM, $afiliado, $pet)
    {
        Mascotas::where('persona_cedula', $afiliado)->delete();
        foreach ($arrayM as $key => $mascota) {
            foreach ($pet as $p){
                if ($mascota['nombreMascota'] == $p['nombre'] && ( $p['estado'] == 'Activo' || $p['estado'] == 'Activo Titular Sin Cobertura') ){
                    $array=array(
                        'persona_cedula'=> $afiliado,
                        'nombre'        => $mascota['nombreMascota'],
                        'especie'       => ($mascota['especie'] == null ? 'Perro' : $mascota['especie']),
                        'raza'          => $mascota['raza'],
                        'genero'        => $mascota['genero'],
                        'edad'          => intval(preg_replace('/[^0-9]+/', '', $mascota['edad']), 10),
                        'color'         => $mascota['color'],
                        'idPet'         => $mascota['idPet'],
                        'numeroPet'     => $pet[0]['numeroPet']
                    );
                    $mascotas_array = Mascotas::create($array);
                    $mascotas_array->save();
                }
            }
        }
    }

    public function addPasswordBen(Request $request)
    {
        $email = $request->input("email");
        $ben = $request->input("ben");
        $arrayPersona = $request->input("persona");

        $object = array(
            "email"   => $email,
            "ben"     => $ben,
            "persona" => $arrayPersona,
            "afiliado" => false,
        );

        $string = json_encode($object);

        $link=  env('APP_URLFRONT').'/beneficiario-create-password?data='.base64_encode($string);

        $subject 	=	'Esta generando su usuario:';
        $html	=	'<div style="text-align:center;margin-bottom:20px">';
        $html	.=	'<h2>Hola' . $email . ', </h2>';
        $html	.=	'</div>';


        $html	.=	'<p>Hemos confirmado que estas afiliado. <br>';
        $html	.=	'Puedes confirmar y generar tus datos haciendo click en el siguiente link:</p>';
        $html	.=	'<p><a href="'.$link.'">click aqui para generar tu usuario</a></p>';
        $to			=	$email;
        $headers 	=	'From: info@medismart.net' . "\r\n";
        //$headers   .=	'CC: ' . $nutricionista->email . "\r\n";
        $headers   .=	'MIME-Version: 1.0' . "\r\n";
        $headers   .=	'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
        mail($to, $subject, utf8_decode($html), $headers);
    }
}
