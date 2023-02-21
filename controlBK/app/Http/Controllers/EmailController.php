<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Auth;
use Response;
use App;

//controller
use App\Http\Controllers\ShoppingcartController;

//model
use App\Afiliado;
use App\Beneficiario;
use App\Provincias;
use App\Cantones;
use App\Distritos;

//job
use App\Jobs\SendChangesEmail;
use App\Jobs\SendUpdatePassEmail;

class EmailController extends Controller
{
    public function send(){
        $this->dispatch(new SendChangesEmail($this->prepararCorreo()));
        
        $shoppingcartcontroller = new ShoppingcartController;
        $shoppingcartcontroller->limpiar();

        $response	=	Response::json(array(), 200);
        return $response;
    }

    function prepararCorreo(){
        $data = Cart::content();
        $array = array();
        foreach($data as $key => $value){
            $array[$key] = $this->objToArray($value, $newarray);
        }

        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                                ->where('persona_cedula' , '=', Auth::user()->cedula)->first();

        $arraySend = array();
        $arraySend['data'] = $array;
        $arraySend['afiliado'] = $afiliado;

        return $arraySend;
    }

    function objToArray($obj, &$arr){
        if(!is_object($obj) && !is_array($obj)){
            $arr = $obj;
            return $arr;
        }
    
        foreach ($obj as $key => $value){
            if (!empty($value)){

                if (strtolower($key) == 'provincia'){
                    $provincia = Provincias::where('CODIGOPROVINCIA', $value)->first();
                    $arr[$key] = array();
                    $this->objToArray($provincia->NAME, $arr[$key]);
                }else if (strtolower($key) == 'canton'){
                    $canton = Cantones::where('CODIGOCANTON_C', $value)->first();
                    $arr[$key] = array();
                    $this->objToArray($canton->NAME, $arr[$key]);
                }else if (strtolower($key) == 'distrito'){
                    $distrito = Distritos::where('CODIGODISTRITO_C', $value)->first();
                    $arr[$key] = array();
                    $this->objToArray($distrito->NAME, $arr[$key]);
                }else{
                    $arr[$key] = array();
                    $this->objToArray($value, $arr[$key]);
                }

            }else{
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

    function updatePassword(Request $request){
        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                            ->where('usuario' , '=', $request->email)->first();

        if (empty($afiliado)){
            $beneficiario = Beneficiario::join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                                        ->where('personas.email' , '=', $request->email)->first();

            if (empty($beneficiario)){
                $message	=	array(
                    'message'	=> 'No existe un usuario con ese correo electrónico'
                );
                $response	=	Response::json($message, 403);
                return $response;
            }
        }

        $object = array(
            "email"   => $request->email,
        );

        $string = json_encode($object);
        $link = App::make('url')->to('/control/afiliado-recuperar-contrasena/'.encrypt($string));
        
        $data = array(
            'email' => $request->email,
            'link' => $link,
            'button' => 'Recuperá tu contraseña',
            'title' => 'Recuperá tu contraseña',
            "image" => asset('control/images/cropped-Logo-MediSmart-Blanco-2.png'),
            "url" => route('index')
        );

        $this->dispatch(new SendUpdatePassEmail($data));
        return Response::json(array(), 200);
    }
}
