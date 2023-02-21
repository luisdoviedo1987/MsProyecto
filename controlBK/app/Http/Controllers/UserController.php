<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use Auth;
use DB;
use Response;
use Cart;
use Datatables;

//models
use App\Beneficiario;
use App\Tarjetas;
use App\User;
use App\Afiliado;
use App\Convenio;
use App\InformationServicioCliente;

//controller
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\AfiliadoController;

class UserController extends Controller
{
    function all(){
        return User::join('afiliado', 'personas.cedula', '=', 'afiliado.persona_cedula')
                     ->where('estadoTitular', 'Activo')
                     ->where('administrador', 0)
                     ->get();
    }

    function cambiarContrasena(Request $request){
        $user = Auth::user();

        $afiliado = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where([
                          [	'persona_cedula' , '=', $user->cedula]
                        ])->first();

        if ($request->get('contrasena') == $request->get('contrasena_repeat')){
            if ($afiliado) {
                $afiliado = Afiliado::where('persona_cedula', $user->cedula)->first();
                $afiliado->contrasena = $request->get('contrasena');
                $afiliado->changePassword = 0;
                $afiliado->save();
    
                $response = Response::json($afiliado, 201);
                return $response;
            }else{
                $beneficiario = Beneficiario::join('personas', 'persona_cedula', '=', 'cedula')->where([
                    ['persona_cedula', $user->cedula],
                ])->first();
    
                if ($beneficiario) {
                    $beneficiario = Beneficiario::where('persona_cedula', $user->cedula)->first();
                    $beneficiario->password = $request->get('contrasena');
                    $beneficiario->changePassword = 0;
                    $beneficiario->save();
                    
                    $response = Response::json($beneficiario, 201);
                    return $response;
                }
            }
    
            $response = Response::json(array(), 403);
            return $response;
        }else{
            $response = Response::json(['message'=> 'Las contraseñas no coinciden. Intente de nuevo'], 403);
            return $response;
        }
    }

    function validarConvenios(Request $request){
        $user = Auth::user();

        $afiliado = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where([
                          [	'persona_cedula' , '=', $user->cedula]
                        ])->first();

        if ($afiliado && ($afiliado->convenio != null || $afiliado->conveniocli != null)) {
            //obtener los convenios
            $convenios = Convenio::all();

            foreach ($convenios as $c){
                if ($afiliado->convenio != null){
                    if( trim(strtolower($afiliado->convenio)) === trim(strtolower($c->convenio)) ) {
                        return response()->json(['resultado'=>false, 'convenio'=>$c->convenio]);
                    }
                }else{
                    if( trim(strtolower($afiliado->conveniocli)) === trim(strtolower($c->convenio)) ){
                        return response()->json(['resultado'=>false, 'convenio'=>$c->convenio]);
                    }
                }
            }
        }

        return response()->json(['resultado'=>true]);
    }

    function getUserData(){
        $model = InformationServicioCliente::whereNotNull('cli')->select();

        return Datatables::of($model)
        ->addColumn('editar', function($row){
            return '<a href="javascript:editarUsuario(\''.$row->cedula.'\',\''.$row->cli.'\',\''.$row->nombre.'\',\''.$row->telefono.'\',\''.$row->correo.'\');" class="col-12 col-md-4 edit-user" >Editar</a>';
        })
        ->addColumn('contrasena', function($row){
            return '<a href="javascript:resentemail(\''.$row->cedula.'\');" class="col-12 col-md-4">Restaurar contraseña</a>';
        })
        ->rawColumns(['editar', 'contrasena'])
        ->make(true);
    }

    function editUser(Request $request){
        $new_id = User::where('cedula', $request->newid)->get();

        if (count($new_id) > 0 && $request->newid != $request->cedula) {
            return Response::json(['message' => 'Ya existe una cédula igual a la que quieres editar'], 403);
        } 

        $user = User::where('cedula', $request->cedula)->first();
        $user->cedula = $request->newid;
        $user->nombre = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->phone;
        $user->save();

        $afiliado = Afiliado::where('persona_cedula', $request->cedula)->first();
        $afiliado->persona_cedula = $request->newid;
        $afiliado->cli = $request->cli;
        $afiliado->save();

        $benes = Beneficiario::where('afiliado_cedula', $request->cedula)
                ->update(['afiliado_cedula' => $request->newid]);

        return Response::json($user, 201);
    }

    function delete(Request $request){
        $afiliado = Afiliado::where('persona_cedula', $request->cedula)->first();
        $user = User::where('cedula', $request->cedula)->first();
        $bene = Beneficiario::where('persona_cedula', $request->cedula)->first();
        $afiliadocontroller = new AfiliadoController;
        $afiliadocontroller->eliminar($afiliado, $user, $bene);

        return Response::json($user, 201);
    }

    function resendEmailPass(Request $request) {
        $afiliado = Afiliado::where('persona_cedula', $request->cedula)->first();
        $afiliadocontroller = new AfiliadoController;
        $afiliadocontroller->sendEmailCreatePassword($afiliado->usuario, $afiliado->cli);

        return Response::json($afiliado, 201);
    }

    function obtenerXCedula($cedula){
        return User::where('cedula', $cedula)->first();
    }

    function obtenerInformacion(){
        $shoppingcartcontroller = new ShoppingcartController;

        $user = Auth::user();

        $afiliado = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where([
                          [	'persona_cedula' , '=', $user->cedula]
                        ])->first();

        if (isset($afiliado->cli)){
            $cartOncoAfiliado = $shoppingcartcontroller->buscarXAfiliado($afiliado->cli);
            if ($cartOncoAfiliado != null){
                $afiliado->{'shoppingcart'} = $cartOncoAfiliado;
            }
        }
        

        if ($afiliado) {
            $beneficiario = DB::table('beneficiario')
                            ->join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                            ->where('beneficiario.afiliado_cedula', '=', $afiliado->cedula)
                            ->get();

            //carrito
            for ($i = 0; $i < count($beneficiario) ; $i++){
                $cartOncoBeneficiario = $shoppingcartcontroller->buscarXBeneficiario($beneficiario[$i]->NumeroBeneficiaro);
                if ($cartOncoBeneficiario != null){
                    $beneficiario[$i]->{'shoppingcart'} = $cartOncoBeneficiario;
                }
            }

            $mascotas = DB::table('mascotas')
                        ->where('persona_cedula', '=', $afiliado->cedula)
                        ->get();

            $tarjetas = Tarjetas::
                    join('tarjetas_afiliado_relacion', 'tarjetas.idTarjeta', '=', 'tarjetas_afiliado_relacion.idTarjeta')
                    ->where('numeroCliente', $afiliado->cli)
                    ->get();

            //add information
            $afiliado->{'beneficiarios'} = $beneficiario;
            $afiliado->{'mascotas'} = $mascotas;
            $afiliado->{'tarjetas'} = $tarjetas;

            $response = Response::json($afiliado, 201);
            return $response;
        }else{
            $beneficiario = Beneficiario::join('personas', 'persona_cedula', '=', 'cedula')->where([
                ['persona_cedula', $user->cedula],
            ])->first();

            if ($beneficiario) {
                $afiliado = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where(
                            'persona_cedula',
                            $beneficiario->afiliado_cedula
                        )->first();

                $beneficiario->{'afiliado'} = false;
                $beneficiario->{'titular'} = $afiliado;
                // $beneficiario->{'data'} = $beneficiario;
                
                $response = Response::json($beneficiario, 201);
                return $response;
            }
        }

        $response = Response::json(array(), 403);
        return $response;
    }

    function obtenerRepetidos(){
        $user = Auth::user();

        $afiliados = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where('afiliado.usuario' , '=', $user->email)
                        ->where('afiliado.estadoTitular', '=', 'Activo')
                        ->get();

        $beneficiarios = DB::table('beneficiario')
                        ->join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                        ->where('personas.email', '=', $user->email)
                        ->where('beneficiario.estadoBeneficiario', '=', 'Activo')
                        ->get();

        return [$beneficiarios, $afiliados];
    }
}
