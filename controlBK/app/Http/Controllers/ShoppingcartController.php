<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Auth;

//controller
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\HelpersController;
use App\Http\Controllers\OncosmartController;
use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\UserController;

//models
use App\Provincias;
use App\Cantones;
use App\Distritos;
use App\Afiliado;
use App\Beneficiario;
use App\Sms_Registro;

class ShoppingcartController extends Controller
{
    protected $productosController;
    protected $oncosmartController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->productosController = new ProductosController();
        $this->oncosmartController = new OncosmartController();
    }

    function add($nombre, $precio, $codigo, $cantidad, $data = null){
        if ($data != null) {
            return Cart::add($codigo, $nombre, $cantidad, $precio, $data);
        }
        return Cart::add($codigo, $nombre, $cantidad, $precio);
    }

    function delete(Request $request){
        Cart::remove($request->rowId);
        return response()->json('ok', 200);
    }

    function remove($row){
        Cart::remove($row);
        return response()->json('ok', 200);
    }

    function obtener(){
        return Cart::content();
    }

    function limpiar(){
        Cart::destroy();
    }

    function buscarXBeneficiario($beneficiario){
        $row = Cart::search(function ($cartItem, $rowId) use($beneficiario) {
            return $cartItem->options->beneficiario == $beneficiario;
        });

        if (count($row) >= 1){
            return $row;
        }else{
            return null;
        }
    }

    function buscarXAfiliado($afiliado){
        $row = Cart::search(function ($cartItem, $rowId) use($afiliado) {
            return $cartItem->options->afiliado == $afiliado;
        });

        if (count($row) >= 1){
            return $row;
        }else{
            return null;
        }
    }

    function buscarXObcionNombre($nombre){
        $row = Cart::search(function ($cartItem, $rowId) use($nombre) {
            return $cartItem->options->nombre == $nombre;
        });

        if (count($row) >= 1){
            return $row;
        }else{
            return null;
        }
    }

    function buscarXCodigoCedula($codigo, $cedula){
        $row = Cart::search(function ($cartItem, $rowId) use($codigo, $cedula) {
            return ($cartItem->id == $codigo && $cartItem->options->cedula == $cedula);
        });

        if (count($row) >= 1){
            return $row;
        }else{
            return null;
        }
    }

    function buscarXCodigo($codigo){
        $row = Cart::search(function ($cartItem, $rowId) use($codigo) {
            return $cartItem->id == $codigo;
        });

        if (count($row) >= 1){
            return $row;
        }else{
            return null;
        }
    }

    function buscarXNombre($nombre){
        $row = Cart::search(function ($cartItem, $rowId) use($nombre) {
            return $cartItem->name == $nombre;
        });

        if (count($row) >= 1){
            return $row;
        }else{
            return null;
        }
    }

    function agregarOncosmartBeneficiario(Request $request){
        $beneficiario = Beneficiario::where('NumeroBeneficiaro', $request->beneficiario)->first();
        $afiliado = Afiliado::join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')->where('persona_cedula', $beneficiario->afiliado_cedula)->first();
        if ($afiliado->frecuenciaPago == "Mensual") {
            return $this->oncosmartController->updateOncosmartBeneficiario($request->beneficiario, true);
        }else{
            $productoOnco = $this->productosController->getAgregarOncosmartBeneficiario();
            if ($this->buscarXBeneficiario($request->beneficiario) == null){
                return response()->json($this->add($productoOnco->nombre, $productoOnco->precio, $productoOnco->codigo, 1, $request->all()));
            }

            return response()->json(['agregar'=>false]);
        }
        
    }

    function agregarOncosmartAfiliado(Request $request){
        $afiliado = Afiliado::where('cli', $request->afiliado)->first();
        if ($afiliado->frecuenciaPago == "Mensual"){
            return $this->oncosmartController->updateOncosmartAfiliado($request->afiliado, true);
        }else{
            $productoOnco = $this->productosController->getAgregarOncosmartAfiliado();
            if ($this->buscarXAfiliado($request->afiliado) == null){
                return response()->json($this->add($productoOnco->nombre, $productoOnco->precio, $productoOnco->codigo, 1, $request->all()));
            }

            return response()->json(['agregar'=>false]);
        }
    }

    function agregarBeneficiario(Request $request){
        $afiliado = Afiliado::where('cli', $request->cli)->first();
        if ($afiliado->frecuenciaPago == "Mensual"){
            $beneficiarioController = new BeneficiarioController;
            return $beneficiarioController->accionesBeneficiario($request);
        }else{
            $productoBeneficiario = $this->productosController->getAgregarBeneficiario();
            $request->provincia = Provincias::where('CODIGOPROVINCIA', $request->provincia)->first()->NAME;
            $request->canton = Cantones::where('CODIGOCANTON_C', $request->canton)->first()->NAME;
            $request->distrito = Distritos::where('CODIGODISTRITO_C', $request->distrito)->first()->NAME;

            return response()->json($this->add($productoBeneficiario->nombre, $productoBeneficiario->precio, $productoBeneficiario->codigo, 1, $request->all()));
        }
    }

    function agregarMascota(Request $request){
        $afiliado = Afiliado::where('persona_cedula', Auth::user()->cedula)->first();
        if ($afiliado->frecuenciaPago == "Mensual") {
            $mascotacontroller = new MascotasController;
            return $mascotacontroller->actualizarMascotas($request);
        }else{
            $productoMascota = $this->productosController->getAgregarMascota();
            return response()->json($this->add($productoMascota->nombre, $productoMascota->precio, $productoMascota->codigo, 1, $request->all()));
        }
    }

    function prepararCorreo(){
        $data = Cart::content();
        $array = array();
        foreach($data as $key => $value){
            $array[$value->id] = HelpersController::objToArray($value, $newarray);
        }

        $arraySend = array();
        $arraySend['data'] = $array;
        return $arraySend;
    }

    function verificarCodigo($idVerificacion , $codigo){
        return  Sms_Registro::where('id_sms', $idVerificacion)
                ->where('sms',$codigo )
                ->get()->count();
    }

    function sendSmsValidation($telefono , $body){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://red.medismart.online/api-medi/public/refer/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "phone":"506'.$telefono.'",
            "body":"'.$body.'"
        }',

        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: PHPSESSID=5acf729db1bc017d87a94e63c39c2574'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_encode($response);
       
    }



    function setFromFacturaJSON($facturajson, $cedula, $planValue = null){
        //limpiar carrito
        $this->limpiar();

        //combertir a objeto
        $obj = json_decode($facturajson);

        //variables
        $planAgregado = false;

        //recorrer datos
        foreach ($obj->oportunidad->OPLineas as $line){
            if (strpos($line->nombreProducto, 'Titular Medicina General') !== false) {
                $producto = $this->productosController->getByCode('ADDPLAN');
            }else if (strpos($line->nombreProducto, 'OncoSmart Titular') !== false) {
                $producto = $this->productosController->getByCode('ADDONCOAFIL');
            }else if (strpos($line->nombreProducto, 'OncoSmart Beneficiario') !== false) {
                $producto = $this->productosController->getByCode('ADDONCOBEN');
            }else if (strpos($line->nombreProducto, 'Mascota') !== false) {
                $producto = $this->productosController->getByCode('ADDPET');
            }else if (strpos($line->nombreProducto, 'Beneficiario') !== false) {
                $producto = $this->productosController->getByCode('ADDBENE');
            }

            $producto->nombre = $line->nombreProducto;
            $producto->{"prorrateo"} = $obj->montoProrateo;
            $producto->{"descuento"} = $obj->oportunidad->OPDescuento;
            $producto->{"totalOp"} = $obj->oportunidad->OPTotal;

            //agregar
            if ($planValue != null) {
                $this->add('Plan', 0, $planValue, 1 , ['prorrateo'=> $obj->montoProrateo, 'descuento'=> $obj->oportunidad->OPDescuento , 'totalOp'=> $obj->oportunidad->OPTotal  ]);
                $planAgregado = true;
            }

            $this->add($line->nombreProducto, $line->precio, $producto->codigo, 1, ['cedula'=>$cedula]);

            //agregar plan
            if (!$planAgregado){
                switch ($line->precio){
                    case $producto->precio:
                        $this->add('Plan', 0, 'mensual', 1 , ['prorrateo'=> $obj->montoProrateo, 'descuento'=> $obj->oportunidad->OPDescuento , 'totalOp'=> $obj->oportunidad->OPTotal  ]);
                    break;

                    case $producto->precio_semestral:
                        $this->add('Plan', 0, 'semestral', 1, ['prorrateo'=> $obj->montoProrateo, 'descuento'=> $obj->oportunidad->OPDescuento , 'totalOp'=> $obj->oportunidad->OPTotal ]);
                    break;

                    case $producto->precio_anual:
                        $this->add('Plan', 0, 'anual', 1, ['prorrateo'=> $obj->montoProrateo, 'descuento'=> $obj->oportunidad->OPDescuento ,'totalOp'=> $obj->oportunidad->OPTotal  ]);
                    break;
                }
                $planAgregado = true;

            }
        }
    }
    
    function obtenerSFPrimeraVenta(){
        //get shopping cart
        $sc = $this->obtener();
        $sc = json_decode($sc);

        //initial variable
        $oncoBene = array();
        $oncosmart = false;

        //obtener primera ronda de informacion
        foreach ($sc as $key => $value) {
            //TIPO DE PLAN
            if ($value->name == "Plan"){
                switch ($value->id){
                    case "mensual": $frecPago = "PLAN MENSUAL"; break;
                    case "semestral": $frecPago = "PLAN SEMESTRAL"; break;
                    case "anual": $frecPago = "PLAN ANUAL"; break;
                }
            }

            //PLAN
            if ($value->id == "ADDPLAN") {
                $apersona = array(
                    'tipoId'              =>    $value->options->tipo_id,
                    'cedula'			  =>    $value->options->cedula,
                    'nombre'			  =>    $value->options->nombre." ".$value->options->apellido1." ".$value->options->apellido2,
                    'apellido1'           =>    "",
                    'apellido2'           =>    "",
                    'genero'			  =>    $value->options->genero,
                    'email'               =>    $value->options->email,
                    'telefono'            =>    $value->options->telefono,
                    'celular'             =>    $value->options->telefono,
                    'fecha_nac'           =>    $value->options->fechanacimiento,
                    'provincia'           =>    $value->options->provincia,
                    'canton'              =>    $value->options->canton,
                    'distrito'            =>    $value->options->distrito,
                );
            }

            //ONCOSMART AFILIADO
            if ($value->id == "ADDONCOAFIL") {
                $oncosmart = true;
            }

            //BENEFICIARIOS AGREGADOS
            if ($value->id == "ADDBENE") {
                switch ($value->options->tipo_id) {
                    case 1:$tipo="Cedula física";break;
                    case 2:$tipo="Dimex";break;
                    case 3:$tipo="Extranjero";break;
                }
            }

            //ONCOSMART BENEFICIARIOS
            if ($value->id == "ADDONCOBEN") {
                array_push($oncoBene, [
                    'cedula' => $value->options->cedula,
                ]);
            }
        }

        //initial variables
        $beneSF = array();
        $mascotaSF=array();
        $bene_personas = array();
        $bene_bene = array();

        //segunda ronda de informacion
        foreach ($sc as $key => $value) {
            //BENEFICIARIOS AGREGADOS
            if ($value->id == "ADDBENE"){
                $data = array(
                    'cedula'              =>  $value->options->cedula,
                    'tipoIdentificacion'  =>  $tipo,
                    'nombreCompleto'      =>  $value->options->nombre.' '.$value->options->apellido1.' '.$value->options->apellido2,
                    'fechaNacimiento'     =>  $value->options->fechanacimiento,
                    'telefonoCelular'     =>  $value->options->telefono,
                    'correo'              =>  $value->options->email,
                    'provincia'           =>  $value->options->provincia,
                    'canton'              =>  $value->options->canton,
                    'distrito'            =>  $value->options->distrito,
                    'genero'              =>  $value->options->genero,
                    'parentezco'          =>  $value->options->parentesco,
                    'coberturaOncosmart'  =>  false,
                );

                //add onco
                foreach ($oncoBene as $ob) {
                    if ($ob['cedula'] == $data['cedula']){
                        $data['coberturaOncosmart'] = true;
                    }
                }

                array_push($beneSF, $data);
            }

            //MASCOTAS
            if ($value->id == "ADDPET") {
                $mascotas_array = array(
                    'persona_cedula'  =>  $apersona['cedula'],
                    'nombre'          =>  $value->options->nombre,
                    'especie'         =>  $value->options->especie,
                    'raza'            =>  $value->options->raza,
                    'genero'          =>  $value->options->genero,
                    'edad'            =>  $value->options->edad,
                    'color'           =>  $value->options->color,
                );

                $data = array(
                    'nombreMascota'   =>  $value->options->nombre,
                    'raza'            =>  $value->options->especie.' '.$value->options->raza,
                    'genero'          =>  $value->options->genero,
                    'edad'            =>  $value->options->edad,
                    'color'           =>  $value->options->color,
                );
                array_push($mascotaSF, $data);
            }
        }

        switch ($apersona['tipoId']) {
            case 1:$personatipoid="Cedula física";break;
            case 2:$personatipoid="Dimex";break;
            case 3:$personatipoid="Extranjero";break;
        }

        switch($frecPago){
            case 'PLAN MENSUAL':$frecuenciaPago="Mensual";break;
            case 'PLAN SEMESTRAL':$frecuenciaPago="Semestral";break;
            case 'PLAN ANUAL':$frecuenciaPago="Anual";break;
          }

        $dataSF = array('frecuenciaPago' => $frecuenciaPago,
                        'tipoIdentificacion'=> $personatipoid,
                        'cedula'=> $apersona['cedula'],
                        'nombreCompleto' => $apersona['nombre'],
                        'fechaNacimiento' =>$apersona['fecha_nac'],
                        'telefonoCelular'=>$apersona['celular'],
                        'telefonoCasa' => $apersona['telefono'],
                        'correo'=> $apersona['email'],
                        'direccion'=>'',
                        'provincia'=>$apersona['provincia'],
                        'canton'=>$apersona['canton'],
                        'distrito'=>$apersona['distrito'],
                        'estadoCivil'=>'Soltero(a)',
                        'genero'=> $apersona['genero'],
                        'coberturaOncosmart'=>$oncosmart,
                        'beneficiarios'=>$beneSF,
                        'mascotas'=>$mascotaSF,
                        'promociones'=>array(),
                        'rebajoDias'=> date('j') <= 15 ? 30 : 15 );

        return $dataSF;
    }
}
