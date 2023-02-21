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

class MascotasController extends Controller
{
    public function actualizarMascotas(Request $request)
    {
        if ($request->has('cli')) {
            $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')->where('cli', $request->input('cli'))->first();
        }else{
            $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')->where('persona_cedula', Auth::user()->cedula)->first();
        }

        if ($request->input('operacion') != 1) {
            $mascota = Mascotas::where('id', $request->idmascota)->first();
        }

        $operacion = $request->input('operacion');

        switch ($operacion) {
            case 1:
            $aSaleForce = array(
                    'petAccion'         => 'insert',
                    'especie'           => $request->especie,
                    'nombreMascota'     => $request->nombre,
                    'raza'              => $request->raza,
                    'genero'            => $request->genero,
                    'edadAnio'          => $request->edad,
                    'color'             => $request->color,
                );
            break;
            case 2:
            $aSaleForce = array(
                    'petAccion'         => 'update',
                    'idPet'             => $mascota->idPet,
                    'especie'           => $request->especie,
                    'nombreMascota'     => $request->nombre,
                    'raza'              => $request->raza,
                    'genero'            => $request->genero,
                    'edadAnio'          => $request->edad,
                    'color'             => $request->color,
                );
            break;
            case 3:
            $aSaleForce = array(
                    'petAccion'         => 'delete',
                    'idPet'             => $mascota->idPet,
                    'especie'           => $mascota->especie,
                    'nombreMascota'     => $mascota->nombre,
                    'raza'              => $mascota->raza,
                    'genero'            => $mascota->genero,
                    'edadAnio'          => $mascota->edad,
                    'color'             => $mascota->color,
                );
            break;
            default:
                $operacion = 1;
                $aSaleForce = array(
                    'petAccion'         => 'insert',
                    'especie'           => $request->especie,
                    'nombreMascota'     => $request->nombre,
                    'raza'              => $request->raza,
                    'genero'            => $request->genero,
                    'edadAnio'          => $request->edad,
                    'color'             => $request->color,
                );
            break;
      }

        $SaleForce=array(
            'numerocliente' => $afiliado->cli,
            'beneficiarios' => array(),
            'mascotas'      => array($aSaleForce),
        );
       
        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->actionesBeneficiario(json_encode($SaleForce));        
        $res=json_decode(json_decode($responseSF), true);

        if ($res['result']['codigoError']==200) {
            switch ($operacion) {
                case 1:
                    $array=array(
                        'persona_cedula'    => $afiliado->cedula,
                        'especie'           => $request->especie,
                        'nombre'            => $request->nombre,
                        'raza'              => $request->raza,
                        'genero'            => $request->genero,
                        'edad'              => $request->edad,
                        'color'             => $request->color,
                        'idPet'             => $res['mascotas'][0]['idPet']
                    );
    
                    $mascotas_array = Mascotas::create($array);
                    $mascotas_array->save();
                    return Response::json(['mensaje' => 'Mascota agregada Exitosamente', 'mascota' => $mascotas_array], 201);
                case 2:
                    $mascotas_array = Mascotas::where('idPet', $res['mascotas'][0]['idPet'])->first();
                    $mascotas_array->nombre = $request->nombre;
                    $mascotas_array->especie = $request->especie;
                    $mascotas_array->raza = $request->raza;
                    $mascotas_array->genero = $request->genero;
                    $mascotas_array->edad = $request->edad;
                    $mascotas_array->color = $request->color;
                    $mascotas_array->save();
                    return Response::json(['mensaje' => 'Mascota modificada Exitosamente', 'id'=>$res['mascotas'][0]['idPet'],'nombre' => $request->nombre, 'mascota'=>$mascotas_array], 201);
                case 3:
                    $mascotas_array = Mascotas::where('idPet', $mascota->idPet)->first();
                    $mascotas_array->delete();
                    return Response::json(['mensaje' => 'Mascota eliminada Exitosamente'], 201);
            }
        }else{
            return Response::json(['message'=> $res['result']['mensaje'],'array' => $res], 403);
        }
        
    }
}
