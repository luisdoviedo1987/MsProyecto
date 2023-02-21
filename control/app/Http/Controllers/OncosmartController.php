<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use Response;

//controller
use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\AfiliadoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UbicacionController;

//model
use App\User;
use App\Beneficiario;
use App\Afiliado;

class OncosmartController extends Controller
{
    protected $beneficiarioController;
    protected $afiliadoController;
    protected $userController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->beneficiarioController = new BeneficiarioController();
        $this->afiliadoController = new AfiliadoController();
        $this->userController = new UserController();
    }

    public function updateOncosmartAfiliado($cli, $agregar)
    {
        $afiliado =  Afiliado::where('cli', $cli)->first();
        $persona = User::where('cedula', $afiliado->persona_cedula)->first();

        $ubicacioncontroller = new UbicacionController;

        $aSaleForce = array(
            'numeroCliente'   => $afiliado->cli,
            'telefonoCelular' => $persona->telefono,
            'correo'          => $persona->email,
            'direccion'       => '',
            'provincia'       => $ubicacioncontroller->getProvinciaById($persona->provincia)->NAME,
            'canton'          => $ubicacioncontroller->getCantonById($persona->canton)->NAME,
            'distrito'        => $ubicacioncontroller->getDistritoById($persona->distrito)->NAME,
            'estadoCivil'     =>'',
            "coberturaOncosmart" => $agregar,
            'genero'          => $persona->genero,
        );

        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->actualizarInfoCliente(json_encode($aSaleForce));
        $res=json_decode($responseSF, true);

        if ($res['resultado']==true) {
            $afiliado->oncosmart = $agregar;
            $afiliado->save();

            return Response::json(['message' => 'Datos de Contacto actualizados correctamente'], 201);
        } else {
            return Response::json(['message'	=> 'Ha ocurrido un problema con la actualización de tus datos, intente mas tarde.'], 403);
            ;
        }
    }

    public function updateOncosmartBeneficiario($bene, $agregar)
    {
        $beneficiario = Beneficiario::join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')->where('NumeroBeneficiaro', $bene)->first();
        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')->where('persona_cedula', $beneficiario->afiliado_cedula)->first();

        switch ($beneficiario['tipoId']) {
            case 1:$tipo="Cedula física";break;
            case 2:$tipo="Dimex";break;
            case 3:$tipo="Extranjero";break;
            default: $tipo= "Cedula física"; break;
        }

        $aSaleForce = array(
            'benAccion'         => 'update',
            'idBen'             => $beneficiario->idBen,
            'tipoIdentificacion'=> $tipo,
            'cedula'            => $beneficiario->cedula,
            'telefono'          => $beneficiario->celular,
            'parentezco'        => $beneficiario->parentesco,
            'correo'            => $beneficiario->email,
            'provincia'         => $beneficiario->provincia,
            'canton'            => $beneficiario->canton,
            'distrito'          => $beneficiario->distrito,
            'estadoCivil'       =>'',
            'coberturaOncosmart'=> $agregar,
            'genero'            => $beneficiario->genero,
        );

        $SaleForce = array(
            'numerocliente' => $afiliado->cli,
            'beneficiarios' => array($aSaleForce),
            'mascotas'      => array(),
        );

        $salesforcecontroller = new SalesforceController;
        $responseSF = $salesforcecontroller->actionesBeneficiario(json_encode($SaleForce));
        $res=json_decode(json_decode($responseSF), true);

        if ($res['result']['codigoError']==200) {
            $ben= Beneficiario::where('persona_cedula', $beneficiario->cedula)->first();
            $ben->oncosmart = $agregar;
            $ben->save();

            $bene = User::where('cedula', $beneficiario->cedula)->first();
            $bene->celular =$beneficiario->celular;
            $bene->provincia = $beneficiario->provincia;
            $bene->canton = $beneficiario->canton;
            $bene->distrito = $beneficiario->distrito;
            $bene->save();

            return Response::json(['mensaje'=> 'Beneficiario Modificado'], 201);
        }
    }
}
