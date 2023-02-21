<?php

namespace App\Http\Controllers;

//laravel
use Illuminate\Http\Request;
use Response;
use DB;
use Session;

//model
use App\Provincias;
use App\Cantones;
use App\Distritos;
use App\Afiliado;
use App\Beneficiario;
use App\User;
use App\Mascotas;
use App\Activity_Log;
use App\CuponesAplicados;
use App\AffiliateImageCode;

//controller
use App\Http\Controllers\SalesforceController;
use App\Http\Controllers\ClaviscoController;
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\HelpersController;
use App\Http\Controllers\AfiliadoController;

class AfiliacionController extends Controller
{
    // public function afiliarse($plan){
    //     $shoppingcartcontroller = new ShoppingcartController;
    //     //truncate
    //     $shoppingcartcontroller->limpiar();
    //     //add
    //     $shoppingcartcontroller->add('Plan', 0, $plan, 1);
    //     return view('afiliarse');
    // }

    public function afiliarse($plan, $code = null){
        $shoppingcartcontroller = new ShoppingcartController;
        //truncate
        $shoppingcartcontroller->limpiar();
        //add
        $shoppingcartcontroller->add('Plan', 0, $plan, 1);

        Activity_Log::create([
            'descripcion' => 'Selección de plan',
            'log' => $plan,
            'session' => Session::getId(),
        ]);

        if ($code != null) {
            $affiliateCodes = AffiliateImageCode::where('active', 1)
                            ->where('pageCode', $code)
                            ->get();

            if (count($affiliateCodes) > 0) {
                return view('afiliarse')
                    ->with('plan', $plan)
                    ->with('affiliateCodes', $affiliateCodes[0]);
            }
        }

        return view('afiliarse')
                ->with('plan', $plan);
    }

    // public function agregarServicios($modal = null, $reference = null, $promotion = null){
    //     $shoppingcartcontroller = new ShoppingcartController;

    //     //obtener primera ronda de informacion
    //     $totalBene = 0;
    //     $totalOncoBene = 0;
    //     $totalPet = 0;

    //     $sc = $shoppingcartcontroller->obtener();
    //     $sc = json_decode($sc);
    //     foreach ($sc as $key => $value) {
    //         if ($value->name == "Plan") {
    //             switch ($value->id) {
    //                 case 'mensual': $plan = "MENSUAL"; break;
    //                 case 'semestral': $plan = "SEMESTRAL"; break;
    //                 case 'anual': $plan = "ANUAL"; break;
    //             }
    //         }

    //         //totals
    //         if ($value->id == "ADDBENE") {
    //             $totalBene++;
    //         }
    //         if ($value->id == "ADDONCOBEN") {
    //             $totalOncoBene++;
    //         }
    //         if ($value->id == "ADDPET") {
    //             $totalPet++;
    //         }
    //     }

    //     //truncate
    //     $sc = $shoppingcartcontroller->obtener();
    //     return view('agregarservicios')
    //             ->with('shoppingcart', $sc)
    //             ->with('plan', $plan)
    //             ->with('totalBene', $totalBene)
    //             ->with('totalOncoBene', $totalOncoBene)
    //             ->with('totalPet', $totalPet)
    //             ->with('showmodal', $modal == null ? false : true)
    //             ->with('reference', $reference == null ? "" : $reference)
    //             ->with('promotion', $promotion == null ? "" : $promotion);
    // }

    public function agregarServicios($modal = null, $reference = null, $promotion = null){
        $shoppingcartcontroller = new ShoppingcartController;

        //obtener primera ronda de informacion
        $totalBene = 0;
        $totalOncoBene = 0;
        $totalPet = 0;
        $datos = '';

        $sc = $shoppingcartcontroller->obtener();
        if (count($sc) == 0) {
            //redirect
            return redirect()->route('afiliacion');
        }

        $sc = json_decode($sc);
        foreach ($sc as $key => $value) {
            if ($value->name == "Plan") {
                switch ($value->id) {
                    case 'mensual': $plan = "MENSUAL"; break;
                    case 'semestral': $plan = "SEMESTRAL"; break;
                    case 'anual': $plan = "ANUAL"; break;
                }
            }

            //totals
            if ($value->id == "ADDBENE") {
                $totalBene++;
            }
            if ($value->id == "ADDONCOBEN") {
                $totalOncoBene++;
            }
            if ($value->id == "ADDPET") {
                $totalPet++;
            }
            if ($value->id == "ADDPLAN") {
                $datos = $value;
            }
        }

        //truncate
        $sc = $shoppingcartcontroller->obtener();
        // return dd($sc);
        return view('agregarservicios')
                ->with('datos', $datos)
                ->with('shoppingcart', $sc)
                ->with('plan', $plan)
                ->with('totalBene', $totalBene)
                ->with('totalOncoBene', $totalOncoBene)
                ->with('totalPet', $totalPet)
                ->with('showmodal', $modal == null ? false : true)
                ->with('reference', $reference == null ? "" : $reference)
                ->with('promotion', $promotion == null ? "" : $promotion);
    }

    public function shoppingContent(){
        $shoppingcartcontroller = new ShoppingcartController;

        //obtener primera ronda de informacion
        $totalBene = 0;
        $totalOncoBene = 0;
        $totalPet = 0;

        $sc = $shoppingcartcontroller->obtener();
        $sc = json_decode($sc);
        foreach ($sc as $key => $value) {
            if ($value->name == "Plan") {
                switch ($value->id) {
                    case 'mensual': $plan = "MENSUAL"; break;
                    case 'semestral': $plan = "SEMESTRAL"; break;
                    case 'anual': $plan = "ANUAL"; break;
                }
            }

            //totals
            if ($value->id == "ADDBENE") {
                $totalBene++;
            }
            if ($value->id == "ADDONCOBEN") {
                $totalOncoBene++;
            }
            if ($value->id == "ADDPET") {
                $totalPet++;
            }
        }

        //truncate
        $sc = $shoppingcartcontroller->obtener();
        return response()->json(['shoppingcart' => $sc, 'plan' => $plan, 'totalBene' => $totalBene, 'totalOncoBene' => $totalOncoBene, 'totalPet' => $totalPet]);
    }

    function getPrecio($producto, $shoppingcartcontroller){
        //plan
        $plan = $shoppingcartcontroller->buscarXNombre('Plan');

        if ($plan == null || !isset($plan)){
            return null;
        }

        $plan = json_decode($plan);
        foreach ($plan as $key => $value) {
            switch ($value->id) {
                case 'mensual': return $producto->precio;
                case 'semestral': return $producto->precio_semestral;
                case 'anual': return $producto->precio_anual;
            }
        }
    }

    // public function saveAfiliado(Request $request){

    //     //return Response::json(['code' => '403','message' => var_dump($request)], 403);

    //     if(strlen($request->telefono) != 8){
    //         return Response::json(['code' => '403','message' => 'Por favor ingresa un número de teléfono celular de 8 digitos '], 403);
    //     }

    //     if(substr($request->telefono, 0, 1) == '1' ||
    //         substr($request->telefono, 0, 1) == '2' ||
    //         substr($request->telefono, 0, 1) == '3' ||
    //         substr($request->telefono, 0, 1) == '4' ||
    //         substr($request->telefono, 0, 1) == '5' ||
    //         substr($request->telefono, 0, 1) == '9'  ){
    //         return Response::json(['code' => '403','message' => 'Por favor ingresa un número de teléfono celular valido de algun operador (Kölbi - Movistar - Claro)'], 403);
            
    //     }
        
    //     if (User::where('celular', $request->telefono)
    //             ->where('cedula' , '!=',$request->cedula )
    //             ->get()->count() > 0){
    //         return Response::json(['code' => '403','message' => 'Lo sentimos el número de teléfono celular ingresado ya se encuentra registrado por otro usuario'], 403);
    //     }

    //     $shoppingcartcontroller = new ShoppingcartController;
    //     //producto
    //     $productocontroller = new ProductosController;
    //     $producto = $productocontroller->getAgregarPlan();
    //     //precio
    //     $precio = $this->getPrecio($producto, $shoppingcartcontroller);

    //     if ($precio == null){
    //         return redirect()->route('afiliarse');
    //     }

    //     //add
    //     $shoppingcartcontroller->add($producto->nombre, $precio, $producto->codigo, 1, $request->all());

    //     //VALIDAR 
    //     $salesforcontroller = new SalesforceController;
    //     $responseSF = $salesforcontroller->userStatus($request->cedula);
       
    //     if ($responseSF['existe']) {
    //         switch ($responseSF['status']) {
    //             case 0: 
    //                 $shoppingcartcontroller->limpiar();
    //                 return Response::json(['code' => '403','message' => '¡Tu usuario se encuentra inactivo!. Puedes volver a activarlo llamando al 2211-4444'], 403);
    //             case 1: 
    //                 $shoppingcartcontroller->limpiar();
    //                 if ($responseSF['afiliado']) {
    //                     return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);
    //                 }else{
    //                     return Response::json(['code' => '403','message' => '¡Ya eres beneficiario en un plan con MediSmart!'], 403);
    //                 }
    //             case 2:
    //                 $dataSF = $shoppingcartcontroller->obtenerSFPrimeraVenta();
    //                 $salesforcontroller = new SalesforceController;
    //                 $responseSF = $salesforcontroller->primeraventa(json_encode($dataSF));
    //                 $res=json_decode($responseSF, true);
    //                 $res['idFactura'] = rand();

    //                 if(!$res["resultado"]){
    //                    return Response::json(['code' => '403','message' =>$res["mensaje"]], 403);
    //                 }
                    
    //                 //generar carrito de compras
    //                 $shoppingcartcontroller = new ShoppingcartController;
    //                 $shoppingcartcontroller->setFromFacturaJSON(json_encode($res), $request->cedula);

    //                 //crear usuario
    //                 //obtener afiliado
    //                 $salesforcontroller = new SalesforceController;
    //                 $resData = json_decode(json_decode($salesforcontroller->getData($request->cedula)), true);

    //                 $cli = $resData['accountResults'][0]['numeroCliente'];
    //                 $res2 = json_decode(json_decode($salesforcontroller->getClientInformation($cli)), true);

    //                 switch ($res2['cliente']['tipoIdentificacion']) {
    //                     case "Cedula física":$tipoId=1;break;
    //                     case "Dimex":$tipoId=2;break;
    //                     case "Extranjero":$tipoId=3;break;
    //                     default: $tipoId=1; break;
    //                 }

    //                 switch ($res2['cliente']['frecuenciaPago']) {
    //                     case "Mensual":$frecuancia="PLAN MENSUAL";break;
    //                     case "Semestra":$frecuancia="PLAN SEMESTRAL";break;
    //                     default:$frecuancia="PLAN MENSUAL";break;
    //                 }

    //                 $provincia = count(Provincias::where('NAME',$res2['cliente']['provincia'])->get()) > 1 ? Provincias::where('NAME',$res2['cliente']['provincia'])->first(): Provincias::where('CODIGOPROVINCIA',10)->first();
    //                 $canton = count(Cantones::where('NAME',$res2['cliente']['canton'])->get()) > 1 ? Cantones::where('NAME',$res2['cliente']['canton'])->first() : Cantones::where('CODIGOCANTON_C',"1010")->first();
    //                 $distrito = count(Distritos::where('NAME',$res2['cliente']['distrito'])->get()) > 1 ? Distritos::where('NAME',$res2['cliente']['distrito'])->first() : Distritos::where('CODIGODISTRITO_C',"101001")->first();

    //                 if (!isset($res2['cliente']['correo'])){
    //                     return Response::json(['message' => 'El usuario no tiene un correo electrónico asignado'], 403);
    //                 }

    //                 if (!isset($res2['cliente']['cedula'])){
    //                     return Response::json(['message'=> 'El usuario no tiene cédula asignada'], 403);
    //                 }

    //                 //create persona
    //                 $persona = User::updateOrCreate(
    //                     ['cedula' => $res2['cliente']['cedula']],
    //                     [
    //                         'tipoId'    => $tipoId,
    //                         'cedula'    => $res2['cliente']['cedula'],
    //                         'nombre'    => isset($res2['cliente']['nombreCompleto']) ? $res2['cliente']['nombreCompleto'] : '',
    //                         'telefono'  => isset($res2['cliente']['telefonoCelular']) ? $res2['cliente']['telefonoCelular'] : '',
    //                         'celular'   => isset($res2['cliente']['telefonoCelular']) ? $res2['cliente']['telefonoCelular'] : '',
    //                         'genero'    => isset($res2['cliente']['genero']) ? $res2['cliente']['genero'] : '',
    //                         'email'     => $res2['cliente']['correo'],
    //                         'provincia' => $provincia->CODIGOPROVINCIA,
    //                         'canton'    => $canton->CODIGOCANTON_C,
    //                         'distrito'  => $distrito->CODIGODISTRITO_C
    //                     ]
    //                 );
                    

    //                 //create afiliado
    //                 $afiliado = Afiliado::updateOrCreate(
    //                     ['persona_cedula'=>$res2['cliente']['cedula']],
    //                     [
    //                         'persona_cedula'   => $res2['cliente']['cedula'],
    //                         'usuario'          => $res2['cliente']['correo'],
    //                         'idFrecPago'       => $frecuancia,
    //                         'oncosmart'        => (isset($res2['cliente']['coberturaOncosmart']) ? $res2['cliente']['coberturaOncosmart'] : false) ? 1 : 0,
    //                         'cli'              => $resData['accountResults'][0]['numeroCliente'],
    //                         'estadoTitular'    => isset($res2['cliente']['estadoTitular']) ? $res2['cliente']['estadoTitular'] : '',
    //                         'fechaPago'        => isset($res2['cliente']['fechaPago']) ? $res2['cliente']['fechaPago'] : '',
    //                         'fechaUltimaInactivacionOncosmart' => isset($res2['cliente']['fechaUltimaInactivacionOncosmart']) ? $res2['cliente']['fechaUltimaInactivacionOncosmart'] : '',
    //                         'formaPago'        => isset($res2['cliente']['formaPago']) ? $res2['cliente']['formaPago'] : '',
    //                         'frecuenciaPago'   => isset($res2['cliente']['frecuenciaPago']) ? $res2['cliente']['frecuenciaPago'] : '',
    //                         'tipoCobertura'    => isset($res2['cliente']['tipoCobertura']) ? $res2['cliente']['tipoCobertura'] : '',
    //                         'facturaSF'        => json_encode($res),
    //                     ]
    //                 );

    //                 return Response::json([route('facturaafiliacion')], 201);

    //             case 3: 
    //                 $shoppingcartcontroller->limpiar();
    //                 return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);

    //             default:
    //              break;
    //         }
    //     }

    //     //validar si es afiliado
    //     $afil = Afiliado::where('persona_cedula', $request->cedula)->first();
    //     $a = json_decode(json_encode($afil), true);
    //     if (!empty($a)) {
    //         if ($afil->afiliacion_terminada != 1){
    //             $afiliado = Afiliado::where('persona_cedula', $request->cedula)->first();
    //             $user = User::where('cedula', $request->cedula)->first();
    //             $bene = Beneficiario::where('persona_cedula', $request->cedula)->first();
    //             //generar carrito de compras
    //             $afiliadoController = new AfiliadoController;
    //             $afiliadoController->eliminar($afiliado, $user, $bene);
    //         }
    //     }
        
    //     //ok
    //     return route('agregarservicios');
    // }

    public function saveAfiliado(Request $request){

        //return Response::json(['code' => '403','message' => var_dump($request)], 403);

        Activity_Log::create([
            'descripcion' => 'Datos afiliacion',
            'log' => json_encode($request->all()),
            'session' => Session::getId(),
        ]);

        if(strlen($request->telefono) != 8){
            return Response::json(['code' => '403','message' => 'Por favor ingresa un número de teléfono celular de 8 digitos '], 403);
        }

        if(substr($request->telefono, 0, 1) == '1' ||
            substr($request->telefono, 0, 1) == '2' ||
            substr($request->telefono, 0, 1) == '3' ||
            substr($request->telefono, 0, 1) == '4' ||
            substr($request->telefono, 0, 1) == '5' ||
            substr($request->telefono, 0, 1) == '9'  ){
            return Response::json(['code' => '403','message' => 'Por favor ingresa un número de teléfono celular valido de algun operador (Kölbi - Movistar - Claro)'], 403);
            
        }
        
        if (User::where('celular', $request->telefono)
                ->where('cedula' , '!=',$request->cedula )
                ->get()->count() > 0){
            return Response::json(['code' => '403','message' => 'Lo sentimos el número de teléfono celular ingresado ya se encuentra registrado por otro usuario'], 403);
        }

        $shoppingcartcontroller = new ShoppingcartController;
        //producto
        $productocontroller = new ProductosController;
        $producto = $productocontroller->getAgregarPlan();
        //precio
        $precio = $this->getPrecio($producto, $shoppingcartcontroller);

        if ($precio == null){
            return redirect()->back();
        }

        if ($request->has('oncosmart')){
            $requestOnco = new Request([
                'agregar'   => 1,
                'cedula' => $request->cedula,
            ]);
            $this->addOncosmartAfiliado($requestOnco);
        }

        //add
        $shoppingcartcontroller->add($producto->nombre, $precio, $producto->codigo, 1, $request->all());

        //VALIDAR 
        $salesforcontroller = new SalesforceController;
        $responseSF = $salesforcontroller->userStatus($request->cedula);
       
        if ($responseSF['existe']) {
            switch ($responseSF['status']) {
                case 0: 
                    $shoppingcartcontroller->limpiar();
                    return Response::json(['code' => '403','message' => '¡Tu usuario se encuentra inactivo!. Puedes volver a activarlo llamando al 2211-4444'], 403);
                case 1: 
                    $shoppingcartcontroller->limpiar();
                    if ($responseSF['afiliado']) {
                        return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);
                    }else{
                        return Response::json(['code' => '403','message' => '¡Ya eres beneficiario en un plan con MediSmart!'], 403);
                    }
                case 2:
                    $dataSF = $shoppingcartcontroller->obtenerSFPrimeraVenta();
                    $salesforcontroller = new SalesforceController;
                    $responseSF = $salesforcontroller->primeraventa(json_encode($dataSF));
                    $res=json_decode($responseSF, true);
                    $res['idFactura'] = rand();

                    if(!$res["resultado"]){
                       return Response::json(['code' => '403','message' =>$res["mensaje"]], 403);
                    }
                    
                    //generar carrito de compras
                    $shoppingcartcontroller = new ShoppingcartController;
                    $shoppingcartcontroller->setFromFacturaJSON(json_encode($res), $request->cedula);

                    //crear usuario
                    //obtener afiliado
                    $salesforcontroller = new SalesforceController;
                    $resData = json_decode(json_decode($salesforcontroller->getData($request->cedula)), true);

                    $cli = $resData['accountResults'][0]['numeroCliente'];
                    $res2 = json_decode(json_decode($salesforcontroller->getClientInformation($cli)), true);

                    switch ($res2['cliente']['tipoIdentificacion']) {
                        case "Cedula física":$tipoId=1;break;
                        case "Dimex":$tipoId=2;break;
                        case "Extranjero":$tipoId=3;break;
                        default: $tipoId=1; break;
                    }

                    switch ($res2['cliente']['frecuenciaPago']) {
                        case "Mensual":$frecuancia="PLAN MENSUAL";break;
                        case "Semestra":$frecuancia="PLAN SEMESTRAL";break;
                        default:$frecuancia="PLAN MENSUAL";break;
                    }

                    $provincia = count(Provincias::where('NAME',$res2['cliente']['provincia'])->get()) > 1 ? Provincias::where('NAME',$res2['cliente']['provincia'])->first(): Provincias::where('CODIGOPROVINCIA',10)->first();
                    $canton = count(Cantones::where('NAME',$res2['cliente']['canton'])->get()) > 1 ? Cantones::where('NAME',$res2['cliente']['canton'])->first() : Cantones::where('CODIGOCANTON_C',"1010")->first();
                    $distrito = count(Distritos::where('NAME',$res2['cliente']['distrito'])->get()) > 1 ? Distritos::where('NAME',$res2['cliente']['distrito'])->first() : Distritos::where('CODIGODISTRITO_C',"101001")->first();

                    if (!isset($res2['cliente']['correo'])){
                        return Response::json(['message' => 'El usuario no tiene un correo electrónico asignado'], 403);
                    }

                    if (!isset($res2['cliente']['cedula'])){
                        return Response::json(['message'=> 'El usuario no tiene cédula asignada'], 403);
                    }

                    //create persona
                    $persona = User::updateOrCreate(
                        ['cedula' => $res2['cliente']['cedula']],
                        [
                            'tipoId'    => $tipoId,
                            'cedula'    => $res2['cliente']['cedula'],
                            'nombre'    => isset($res2['cliente']['nombreCompleto']) ? $res2['cliente']['nombreCompleto'] : '',
                            'telefono'  => isset($res2['cliente']['telefonoCelular']) ? $res2['cliente']['telefonoCelular'] : '',
                            'celular'   => isset($res2['cliente']['telefonoCelular']) ? $res2['cliente']['telefonoCelular'] : '',
                            'genero'    => isset($res2['cliente']['genero']) ? $res2['cliente']['genero'] : '',
                            'email'     => $res2['cliente']['correo'],
                            'provincia' => $provincia->CODIGOPROVINCIA,
                            'canton'    => $canton->CODIGOCANTON_C,
                            'distrito'  => $distrito->CODIGODISTRITO_C
                        ]
                    );
                    

                    //create afiliado
                    $afiliado = Afiliado::updateOrCreate(
                        ['persona_cedula'=>$res2['cliente']['cedula']],
                        [
                            'persona_cedula'   => $res2['cliente']['cedula'],
                            'usuario'          => $res2['cliente']['correo'],
                            'idFrecPago'       => $frecuancia,
                            'oncosmart'        => (isset($res2['cliente']['coberturaOncosmart']) ? $res2['cliente']['coberturaOncosmart'] : false) ? 1 : 0,
                            'cli'              => $resData['accountResults'][0]['numeroCliente'],
                            'estadoTitular'    => isset($res2['cliente']['estadoTitular']) ? $res2['cliente']['estadoTitular'] : '',
                            'fechaPago'        => isset($res2['cliente']['fechaPago']) ? $res2['cliente']['fechaPago'] : '',
                            'fechaUltimaInactivacionOncosmart' => isset($res2['cliente']['fechaUltimaInactivacionOncosmart']) ? $res2['cliente']['fechaUltimaInactivacionOncosmart'] : '',
                            'formaPago'        => isset($res2['cliente']['formaPago']) ? $res2['cliente']['formaPago'] : '',
                            'frecuenciaPago'   => isset($res2['cliente']['frecuenciaPago']) ? $res2['cliente']['frecuenciaPago'] : '',
                            'tipoCobertura'    => isset($res2['cliente']['tipoCobertura']) ? $res2['cliente']['tipoCobertura'] : '',
                            'facturaSF'        => json_encode($res),
                        ]
                    );

                    return Response::json([route('facturaafiliacion')], 201);

                case 3: 
                    $shoppingcartcontroller->limpiar();
                    return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);

                default:
                 break;
            }
        }

        //validar si es afiliado
        $afil = Afiliado::where('persona_cedula', $request->cedula)->first();
        $a = json_decode(json_encode($afil), true);
        if (!empty($a)) {
            if ($afil->afiliacion_terminada != 1){
                $afiliado = Afiliado::where('persona_cedula', $request->cedula)->first();
                $user = User::where('cedula', $request->cedula)->first();
                $bene = Beneficiario::where('persona_cedula', $request->cedula)->first();
                //generar carrito de compras
                $afiliadoController = new AfiliadoController;
                $afiliadoController->eliminar($afiliado, $user, $bene);
            }
        }
        
        //ok
        return route('agregarservicios');
    }

    // function addBeneficiario(Request $request){
    //     $shoppingcartcontroller = new ShoppingcartController;
    //     //producto
    //     $productocontroller = new ProductosController;
    //     $producto = $productocontroller->getAgregarBeneficiario();
    //     //precio
    //     $precio = $this->getPrecio($producto, $shoppingcartcontroller);
    //     //add
    //     $shoppingcartcontroller->add($producto->nombre, $precio, $producto->codigo, 1, $request->all());
    //     //ok
    //     return response()->json(['error'=>false, 'data'=>$request->all(), 'producto'=>$producto, 'precio'=>$precio], 200);
    // }

    function addBeneficiario(Request $request){
        Activity_Log::create([
            'descripcion' => 'Agregar beneficiario',
            'log' => json_encode($request->all()),
            'session' => Session::getId(),
        ]);

        $salesforcontroller = new SalesforceController;
        $shoppingcartcontroller = new ShoppingcartController;

        $responseSF = $salesforcontroller->userStatus($request->cedula);
        if ($responseSF['existe']) {
            switch ($responseSF['status']) {
                case 1: 
                    if ($responseSF['afiliado']) {
                        return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);
                    }else{
                        return Response::json(['code' => '403','message' => '¡Ya se encuentra registrado el beneficiario en un plan con MediSmart!'], 403);
                    }
                case 3: 
                    return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);

                default: break;
            }
        }

        //ver si existe el beneficiario
        $beneficiario = $shoppingcartcontroller->buscarXCodigoCedula('ADDBENE', $request->cedula);
        $beneficiarioJSON = json_decode($beneficiario);
        if (isset($beneficiarioJSON) && $beneficiarioJSON != null && $beneficiarioJSON != ""){
            foreach ($beneficiarioJSON as $key => $value) {
                return Response::json(['code' => '403','message' => '¡Ya se encuentra agregado un beneficiario con esta cédula.!'], 403);
            }
        }else if (isset($beneficiario) && $beneficiario != null && $beneficiario != ""){
            foreach ($beneficiario as $key => $value) {
                return Response::json(['code' => '403','message' => '¡Ya se encuentra agregado un beneficiario con esta cédula.!'], 403);
            }
        }

        $shoppingcartcontroller = new ShoppingcartController;
        //producto
        $productocontroller = new ProductosController;
        $producto = $productocontroller->getAgregarBeneficiario();
        //precio
        $precio = $this->getPrecio($producto, $shoppingcartcontroller);
        //add
        $shoppingcartcontroller->add($producto->nombre, $precio, $producto->codigo, 1, $request->all());

        if ($request->has('oncosmart')){
            //producto
            $producto = $productocontroller->getAgregarOncosmartBeneficiario();
            //precio
            $precioOnco = $this->getPrecio($producto, $shoppingcartcontroller);
            //add
            $shoppingcartcontroller->add($producto->nombre, $precioOnco, $producto->codigo, 1, $request->all());
        }

        //ok
        return response()->json(['error'=>false, 'data'=>$request->all(), 'producto'=>$producto, 'precio'=>$precio, 'precioOnco'=>( isset($precioOnco) ? $precioOnco : 0)], 200);
    }

    function addMascota(Request $request){
        Activity_Log::create([
            'descripcion' => 'Agregar mascota',
            'log' => json_encode($request->all()),
            'session' => Session::getId(),
        ]);

        $shoppingcartcontroller = new ShoppingcartController;
        //producto
        $productocontroller = new ProductosController;
        $producto = $productocontroller->getAgregarMascota();
        //precio
        $precio = $this->getPrecio($producto, $shoppingcartcontroller);
        //add
        $shoppingcartcontroller->add($producto->nombre, $precio, $producto->codigo, 1, $request->all());
        //ok
        return response()->json(['error'=>false, 'data'=>$request->all(), 'producto'=>$producto, 'precio'=>$precio], 200);
    }

    function addOncosmartAfiliado(Request $request){
        Activity_Log::create([
            'descripcion' => 'Agregar oncosmart afiliado',
            'log' => json_encode($request->all()),
            'session' => Session::getId(),
        ]);

        $shoppingcartcontroller = new ShoppingcartController;

        if ($request->agregar == 1){
            //producto
            $productocontroller = new ProductosController;
            $producto = $productocontroller->getAgregarOncosmartAfiliado();
            //precio
            $precio = $this->getPrecio($producto, $shoppingcartcontroller);
            //add
            $shoppingcartcontroller->add($producto->nombre, $precio, $producto->codigo, 1, $request->all());
        }else{
            $onco = $shoppingcartcontroller->buscarXCodigoCedula('ADDONCOAFIL', $request->cedula);
            $onco = json_decode($onco);
            foreach ($onco as $key => $value) {
                if ($value->id == 'ADDONCOAFIL'){
                    $shoppingcartcontroller->remove($key);
                }
            }
        }

        //ok
        return response()->json(['error'=>false, 'data'=>$request->all()], 200);
    }

    function addOncosmart(Request $request){
        Activity_Log::create([
            'descripcion' => 'Agregar oncosmart',
            'log' => json_encode($request->all()),
            'session' => Session::getId(),
        ]);

        $shoppingcartcontroller = new ShoppingcartController;    

        if ($request->agregar == 1){
            //producto
            $productocontroller = new ProductosController;
            $producto = $productocontroller->getAgregarOncosmartBeneficiario();
            //precio
            $precio = $this->getPrecio($producto, $shoppingcartcontroller);
            //add
            $shoppingcartcontroller->add($producto->nombre, $precio, $producto->codigo, 1, $request->all());
        }else{
            $onco = $shoppingcartcontroller->buscarXCodigoCedula('ADDONCOBEN', $request->cedula);
            $onco = json_decode($onco);
            foreach ($onco as $key => $value) {
                if ($value->id == 'ADDONCOBEN' && $value->options->cedula == $request->cedula) {
                    $shoppingcartcontroller->remove($key);
                }
            }
        }

        //ok
        return response()->json(['error'=>false, 'data'=>$request->all(), 'precio'=>$precio], 200);
    }


    function deleteBeneficiario(Request $request){
        Activity_Log::create([
            'descripcion' => 'Eliminar beneficiario',
            'log' => json_encode($request->all()),
            'session' => Session::getId(),
        ]);

        $shoppingcartcontroller = new ShoppingcartController;
        //buscar
        $beneficiario = $shoppingcartcontroller->buscarXCodigoCedula('ADDBENE', $request->cedula);
        $beneficiarioJSON = json_decode($beneficiario);
        if (isset($beneficiarioJSON) && $beneficiarioJSON != null && $beneficiarioJSON != ""){
            foreach ($beneficiarioJSON as $key => $value) {
                if ($value->id == 'ADDBENE' && $value->options->cedula == $request->cedula) {
                    $shoppingcartcontroller->remove($key);
                }
    
                $onco = $shoppingcartcontroller->buscarXCodigoCedula('ADDONCOBEN', $request->cedula);
                $onco = json_decode($onco);
                foreach ($onco as $key => $value) {
                    if ($value->id == 'ADDONCOBEN' && $value->options->cedula == $request->cedula) {
                        $shoppingcartcontroller->remove($key);
                    }
                }
            }
        }else if (isset($beneficiario) && $beneficiario != null && $beneficiario != ""){
            foreach ($beneficiario as $key => $value) {
                if ($value->id == 'ADDBENE' && $value->options->cedula == $request->cedula) {
                    $shoppingcartcontroller->remove($key);
                }
    
                $onco = $shoppingcartcontroller->buscarXCodigoCedula('ADDONCOBEN', $request->cedula);
                $onco = json_decode($onco);
                foreach ($onco as $key => $value) {
                    if ($value->id == 'ADDONCOBEN' && $value->options->cedula == $request->cedula) {
                        $shoppingcartcontroller->remove($key);
                    }
                }
            }
        }
        return response()->json(['error'=>false, 'data'=>$request->all()], 200);
    }

    function deleteMascota(Request $request){
        Activity_Log::create([
            'descripcion' => 'Eliminar mascota',
            'log' => json_encode($request->all()),
            'session' => Session::getId(),
        ]);

        $shoppingcartcontroller = new ShoppingcartController;
        //buscar
        $mascota = $shoppingcartcontroller->buscarXObcionNombre($request->nombre);
        $mascota = json_decode($mascota);
        foreach ($mascota as $key => $value) {
            if ($value->id == 'ADDPET' && $value->options->nombre == $request->nombre) {
                $shoppingcartcontroller->remove($key);
                break;
            }
        }
        return response()->json(['error'=>false, 'data'=>$request->all()], 200);
    }

    // public function afiliacion(Request $request){

    //     //get shopping cart
    //     $shoppingcartcontroller = new ShoppingcartController;
    //     $sc = $shoppingcartcontroller->obtener();
    //     $sc = json_decode($sc);

    //     foreach ($sc as $key => $value) {
    //         if ($value->name == "Plan"){
    //             switch ($value->id){
    //                 case "mensual": $frecPago = "PLAN MENSUAL"; break;
    //                 case "semestral": $frecPago = "PLAN SEMESTRAL"; break;
    //                 case "anual": $frecPago = "PLAN ANUAL"; break;
    //             }
    //         }
    //     }

    //     /*$promo=DB::table('promociones_productos_relacion')
    //                 ->select('promociones_productos_relacion.codigo_tabla_prodcortdes as idPromocion', 'promociones_productos_relacion.meses as cantidadMeses', 'promociones.tipoPlan as tipoPlan')
    //                 ->join('promociones', 'promociones_productos_relacion.codigo_tabla_promocion', '=', 'promociones.id')
    //                 ->where('promociones.CodigoPromo', $request->input('promocion'))
    //                 ->get();
                    
    //     $promoSF = json_decode(json_encode($promo), true);
    //     if (!empty($promoSF)) {
    //         if ($promoSF[0]['tipoPlan'] != $request->input('idFrecPago')) {
    //             $promoSF = array();
    //         }
    //     }*/


    //     $promoSF = array();
    //     if(count($promoSF) == 0){
    //         switch (strtoupper($request->input('promocion'))) {
    //             // case '100TEST':
    //             //         array_push($promoSF, array("idPromocion"=> "ALL-DESC-013" , "cantidadMeses"=> 1));
    //             // break;
    //             case 'FEB25':
    //                 if(count($promoSF) == 0){
    //                     array_push($promoSF, array("idPromocion"=> "ALL-DESC-FEB25" , "cantidadMeses"=> 1));
    //                 }
    //             break;
    //             case 'DIC20':
    //                 return Response::json(['code' => '403','message' => '¡El código promocional ha vencido!'], 403);
    //             break;
    //             case 'DIC30':
    //                 return Response::json(['code' => '403','message' => '¡El código promocional ha vencido!'], 403);
    //             break;
    //             case 'VACUNAINFLUENZA':
    //                 if(count($promoSF) == 0){
    //                     array_push($promoSF, array("idPromocion"=> "TIT-PROM-IND-040" , "cantidadMeses"=> 1));
    //                     array_push($promoSF, array("idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1));
    //                 }
    //             break;
    //             case 'INFLUENZA-21':
    //                 if ($frecPago == "PLAN SEMESTRAL"){
    //                     array_push($promoSF, array("idPromocion"=> "TIT-PROM-IND-040" , "cantidadMeses"=> 2));
    //                 }else{
    //                     return Response::json(['code' => '403','message' => '¡El código promocional [INFLUENZA-21] solo aplica para frecuencia de pago Semestral!'], 403);
    //                 }
    //             break;
    //             case 'MAYO30':
    //                 return Response::json(['code' => '403','message' => '¡El código promocional ha vencido!'], 403);
    //             break;
    //             case 'JULIO30':
    //                 return Response::json(['code' => '403','message' => '¡El código promocional ha vencido!'], 403);
    //             break;
    //             case 'CHEQUEO':
    //                 if(count($promoSF) == 0){
    //                     array_push($promoSF, array("idPromocion"=> "TIT-PROM-IND-014" , "cantidadMeses"=> 1));
    //                     array_push($promoSF, array("idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1));
    //                 }
    //             break;
    //             case '30MS':
    //                     return Response::json(['code' => '403','message' => '¡El código promocional ha vencido!'], 403);
    //             break;
    //             case '50MS':
    //                     return Response::json(['code' => '403','message' => '¡El código promocional ha vencido!'], 403);
    //             break;
    //             case 'AHORRO25':
    //                 if(count($promoSF) == 0){
    //                     array_push($promoSF, array("idPromocion"=> "ALL-DESC-005" , "cantidadMeses"=> 1));
    //                 }
    //                     //array_push($promoSF, array("idPromocion"=> "ALL-DESC-025" , "cantidadMeses"=> 1));
   
    //                     // switch($frecPago){
    //                     //     case 'PLAN MENSUAL':
    //                     //         return Response::json(['code' => '403','message' => '¡El codigo promocional [AHORRO25] no aplica para su frecuencia de pago Mensual!'], 403);
    //                     //     break;
    //                     //     case 'PLAN SEMESTRAL':
    //                     //         return Response::json(['code' => '403','message' => '¡El codigo promocional [AHORRO25] no aplica para su frecuencia de pago Semestral!'], 403);
    //                     //     break;
    //                     //     case 'PLAN ANUAL':
    //                     //         return Response::json(['code' => '403','message' => '¡El codigo promocional ha vencido!'], 403);
    //                     //         //array_push($promoSF, array("idPromocion"=> "ALL-DESC-025" , "cantidadMeses"=> 1));
    //                     //     break;
    //                     //   }
    //                 break;
    //             case 'SMART25':
    //                 if(count($promoSF) == 0){
    //                     array_push($promoSF, array("idPromocion"=> "ALL-DESC-018" , "cantidadMeses"=> 1));
    //                 }
    //             break;
    //             case 'BLACK40':
    //                 if(count($promoSF) == 0){
    //                     array_push($promoSF, array("idPromocion"=> "ALL-DESC-040" , "cantidadMeses"=> 1));
    //                 }
    //             break;
    //             default:
    //                 if(count($promoSF) == 0){
    //                   array_push($promoSF, array("idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1));
    //                 }
    //             break;
    //         }
    //     }
       

      
    
    //     //initial variable
    //     $oncoBene = array();

    //     $oncosmart = false;
    //     $referidoSF = $request->input('referido');
        

    //     //obtener primera ronda de informacion
    //     foreach ($sc as $key => $value) {
    //         //TIPO DE PLAN
    //         if ($value->name == "Plan"){
    //             switch ($value->id){
    //                 case "mensual": $frecPago = "PLAN MENSUAL"; break;
    //                 case "semestral": $frecPago = "PLAN SEMESTRAL"; break;
    //                 case "anual": $frecPago = "PLAN ANUAL"; break;
    //             }
    //         }

    //         //PLAN
    //         if ($value->id == "ADDPLAN") {
    //             $apersona = array(
    //                 'tipoId'              =>    $value->options->tipo_id,
    //                 'cedula'              =>    $value->options->cedula,
    //                 'nombre'              =>    $value->options->nombre." ".$value->options->apellido1." ".$value->options->apellido2,
    //                 'apellido1'           =>    "",
    //                 'apellido2'           =>    "",
    //                 'genero'              =>    $value->options->genero,
    //                 'email'               =>    $value->options->email,
    //                 'telefono'            =>    $value->options->telefono,
    //                 'celular'             =>    $value->options->telefono,
    //                 'fecha_nac'           =>    $value->options->fechanacimiento,
    //                 'provincia'           =>    $value->options->provincia,
    //                 'canton'              =>    $value->options->canton,
    //                 'distrito'            =>    $value->options->distrito,
    //             );
    //         }

    //         //ONCOSMART AFILIADO
    //         if ($value->id == "ADDONCOAFIL") {
    //             $oncosmart = true;
    //         }

    //         //BENEFICIARIOS AGREGADOS
    //         if ($value->id == "ADDBENE") {
    //             switch ($value->options->tipo_id) {
    //                 case 1:$tipo="Cedula física";break;
    //                 case 2:$tipo="Dimex";break;
    //                 case 3:$tipo="Extranjero";break;
    //             }
    //         }

    //         //ONCOSMART BENEFICIARIOS
    //         if ($value->id == "ADDONCOBEN") {
    //             array_push($oncoBene, [
    //                 'cedula' => $value->options->cedula,
    //             ]);
    //         }
    //     }

    //     //initial variables
    //     $beneSF = array();
    //     $mascotaSF=array();
    //     $bene_personas = array();
    //     $bene_bene = array();

    //     //segunda ronda de informacion
    //     foreach ($sc as $key => $value) {
    //         //BENEFICIARIOS AGREGADOS
    //         if ($value->id == "ADDBENE"){
    //             $data = array(
    //                 'cedula'              =>  $value->options->cedula,
    //                 'tipoIdentificacion'  =>  $tipo,
    //                 'nombreCompleto'      =>  $value->options->nombre.' '.$value->options->apellido1.' '.$value->options->apellido2,
    //                 'fechaNacimiento'     =>  $value->options->fechanacimiento,
    //                 'telefonoCelular'     =>  $value->options->telefono,
    //                 'correo'              =>  $value->options->email,
    //                 'provincia'           =>  $value->options->provincia,
    //                 'canton'              =>  $value->options->canton,
    //                 'distrito'            =>  $value->options->distrito,
    //                 'genero'              =>  $value->options->genero,
    //                 'coberturaOncosmart'  =>  false,
    //             );

    //             $abeneficiario_persona = array(
    //                 'tipoId'             =>  $value->options->tipo_id,
    //                 'cedula'             =>  $value->options->cedula,
    //                 'nombre'             =>  $value->options->nombre,
    //                 'apellido1'          =>  $value->options->apellido1,
    //                 'apellido2'          =>  $value->options->apellido2,
    //                 'genero'             =>  $value->options->genero,
    //                 'email'              =>  $value->options->email,
    //                 'telefono'           =>  $value->options->telefono,
    //                 'celular'            =>  $value->options->telefono,
    //                 'fecha_nac'          =>  $value->options->fechanacimiento,
    //                 'provincia'          =>  $value->options->provincia,
    //                 'canton'             =>  $value->options->canton,
    //                 'distrito'           =>  $value->options->distrito,
    //             );

    //             $abeneficiario_bene = array(
    //                 'persona_cedula'  =>  $value->options->cedula,
    //                 'afiliado_cedula' =>  $apersona['cedula'],
    //                 'parentesco'      =>  $value->options->parentesco,
    //                 'oncosmart'       =>  false,
    //             );

    //             //add onco
    //             foreach ($oncoBene as $ob) {
    //                 if ($ob['cedula'] == $data['cedula']){
    //                     $data['coberturaOncosmart'] = true;
    //                 }

    //                 if ($ob['cedula'] == $abeneficiario_bene['afiliado_cedula']){
    //                     $abeneficiario_bene['oncosmart'] = true;
    //                 }
    //             }

    //             array_push($beneSF, $data);
    //             array_push($bene_personas, $abeneficiario_persona);
    //             array_push($bene_bene, $abeneficiario_bene);
    //         }

    //         //MASCOTAS
    //         if ($value->id == "ADDPET") {
    //             $mascotas_array = array(
    //                 'persona_cedula'  =>  $apersona['cedula'],
    //                 'nombre'          =>  $value->options->nombre,
    //                 'especie'         =>  $value->options->especie,
    //                 'raza'            =>  $value->options->raza,
    //                 'genero'          =>  $value->options->genero,
    //                 'edad'            =>  $value->options->edad,
    //                 'color'           =>  $value->options->color,
    //             );

    //             $data = array(
    //                 'nombreMascota'   =>  $value->options->nombre,
    //                 'raza'            =>  $value->options->especie.' '.$value->options->raza,
    //                 'genero'          =>  $value->options->genero,
    //                 'edad'            =>  $value->options->edad,
    //                 'color'           =>  $value->options->color,
    //             );
    //             array_push($mascotaSF, $data);
    //         }
    //     }

    //     //VALIDAR 
    //     $salesforcontroller = new SalesforceController;
    //     $responseSF = $salesforcontroller->userStatus($request->cedula);
    //     if ($responseSF['existe']) {
    //         switch ($responseSF['status']) {
    //             case 0: return Response::json(['code' => '403','message' => '¡Tu usuario se encuentra inactivo!. Puedes volver a activarlo llamando al 2211-4444'], 403);

    //             case 1: 
    //                 if ($responseSF['afiliado']) {
    //                     return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);
    //                 }else{
    //                     return Response::json(['code' => '403','message' => '¡Ya eres beneficiario en un plan con MediSmart!'], 403);
    //                 }
                
    //             case 2:
    //                 $dataSF = $shoppingcartcontroller->obtenerSFPrimeraVenta();

    //                 //agregar cod referido
    //                 $dataSF['codreferidocliente'] = $referidoSF;

    //                 $salesforcontroller = new SalesforceController;
    //                 $responseSF = $salesforcontroller->primeraventa(json_encode($dataSF));
    //                 $res=json_decode($responseSF, true);
    //                 $res['idFactura'] = rand();
    //                 //generar carrito de compras
    //                 $shoppingcartcontroller = new ShoppingcartController;
    //                 $shoppingcartcontroller->setFromFacturaJSON(json_encode($res), $request->cedula);
    //                 return Response::json([route('facturaafiliacion')], 201);

    //             case 3: return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);

    //             default: break;
    //         }
    //     }

    //     //validar si es afiliado
    //     $afil = Afiliado::where('persona_cedula', $request->cedula)->first();
    //     $a = json_decode(json_encode($afil), true);
    //     if (!empty($a)) {
    //         if ($afil->afiliacion_terminada != 1){
    //             $afiliado = Afiliado::where('persona_cedula', $request->cedula)->first();
    //             $user = User::where('cedula', $request->cedula)->first();
    //             $bene = Beneficiario::where('persona_cedula', $request->cedula)->first();
    //             //generar carrito de compras
    //             $afiliadoController = new AfiliadoController;
    //             $afiliadoController->eliminar($afiliado, $user, $bene);
    //         }
    //     }

    //     $aafiliado= array(
    //         'persona_cedula'  => $apersona['cedula'],
    //         'usuario'         => $apersona['email'],
    //         'contrasena'      => HelpersController::generateRandomString(),
    //         'idFrecPago'      =>  $frecPago,
    //         'oncosmart'       =>  $oncosmart,
    //         'cli'             => '',
    //         'afiliacion_terminada'             => 0,
    //     );

    //     switch ($apersona['tipoId']) {
    //         case 1:$personatipoid="Cedula física";break;
    //         case 2:$personatipoid="Dimex";break;
    //         case 3:$personatipoid="Extranjero";break;
    //     }

    //     switch($aafiliado['idFrecPago']){
    //         case 'PLAN MENSUAL':$frecuenciaPago="Mensual";break;
    //         case 'PLAN SEMESTRAL':$frecuenciaPago="Semestral";break;
    //         case 'PLAN ANUAL':$frecuenciaPago="Anual";break;
    //       }

    //     $dataSF = array('frecuenciaPago' => $frecuenciaPago,
    //                 'tipoIdentificacion'=> $personatipoid,
    //                 'cedula'=> $apersona['cedula'],
    //                 'nombreCompleto' => $apersona['nombre'],
    //                 'fechaNacimiento' =>$apersona['fecha_nac'],
    //                 'telefonoCelular'=>$apersona['celular'],
    //                 'telefonoCasa' => $apersona['telefono'],
    //                 'correo'=> $apersona['email'],
    //                 'direccion'=>'',
    //                 'provincia'=>$apersona['provincia'],
    //                 'canton'=>$apersona['canton'],
    //                 'distrito'=>$apersona['distrito'],
    //                 'estadoCivil'=>'Soltero(a)',
    //                 'genero'=> $apersona['genero'],
    //                 'coberturaOncosmart'=>$aafiliado['oncosmart'],
    //                 'beneficiarios'=>$beneSF,
    //                 'mascotas'=>$mascotaSF,
    //                 'promociones'=>$promoSF,
    //                 'rebajoDias'=> date('j') <= 15 ? 30 : 15 );



    //     $salesforcontroller = new SalesforceController;
    //     $responseSF = $salesforcontroller->primeraventa(json_encode($dataSF));
       
    //     $res=json_decode($responseSF, true);

    //     if(!$res["resultado"]){
    //        return Response::json(['code' => '403','message' =>"Ocurrio un error : ".json_encode($res)], 403);
    //     }
    //    //DEBUG 

    //     $shoppingcartcontroller->setFromFacturaJSON(json_encode($res), $apersona['cedula']);
    //     if ($res['resultado']==true) {
    //         if (User::where('cedula', $apersona['cedula'])->get()->count() == 0){
    //             $persona = User::create($apersona);
    //             $persona->save();
    //         }

    //         $aafiliado['cli']=$res['cli'];
    //         $aafiliado['codigo_referido'] = $referidoSF;

    //         $res['idFactura'] = rand();
    //         $aafiliado['facturaSF'] = json_encode($res);

    //         if (Afiliado::where('persona_cedula', $apersona['cedula'])->get()->count() == 0) {
    //             $afiliado = Afiliado::create($aafiliado);
    //             $afiliado->save();

    //             if (!empty($arrayBene)) {
    //                 $beneficiario_persona = User::create($abeneficiario_persona);
    //                 $beneficiario_persona->save();
    
    //                 $beneficiario_bene = Beneficiario::create($abeneficiario_bene);
    //                 $beneficiario_bene->save();
    //             }
    
    //             if (!empty($arrayMascota)) {
    //                 $mascotas = Mascotas::create($mascotas_array);
    //                 $mascotas->save();
    //             }
    //         }else{
    //             $afiliado = Afiliado::where('persona_cedula', $apersona['cedula'])->first();
    //             $afiliado->facturaSF = $aafiliado['facturaSF'];
    //             $afiliado->codigo_referido = $referidoSF;
    //             $afiliado->save();
    //         }


    //         return Response::json(['code' => '201','url'=>route('facturaafiliacion')], 201);
    //     } else {
    //         if (strpos($res["mensaje"], 'DUPLICATE_VALUE')) {
    //             return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);
    //         } else {
    //             return Response::json(['code' => '403','message' => 'No se pudo crear su afiliado'], 403);
    //         }
    //     }
    // }

    public function afiliacion(Request $request){

        Activity_Log::create([
            'descripcion' => 'Click en: Proceder a pagar',
            'session' => Session::getId(),
        ]);

        //get shopping cart
        $shoppingcartcontroller = new ShoppingcartController;
        $sc = $shoppingcartcontroller->obtener();
        $sc = json_decode($sc);

        $planValue = "";

        foreach ($sc as $key => $value) {
            if ($value->name == "Plan"){
                $planValue = $value->id;
                switch ($value->id) {
                    case "mensual": $frecPago = "PLAN MENSUAL"; break;
                    case "semestral": $frecPago = "PLAN SEMESTRAL"; break;
                    case "anual": $frecPago = "PLAN ANUAL"; break;
                }
            }
        }

        if ($request->has('oncosmart')){
            $requestOnco = new Request([
                'agregar'   => 1,
                'cedula' => $request->cedula,
            ]);
            $this->addOncosmartAfiliado($requestOnco);
        }

        /*$promo=DB::table('promociones_productos_relacion')
                    ->select('promociones_productos_relacion.codigo_tabla_prodcortdes as idPromocion', 'promociones_productos_relacion.meses as cantidadMeses', 'promociones.tipoPlan as tipoPlan')
                    ->join('promociones', 'promociones_productos_relacion.codigo_tabla_promocion', '=', 'promociones.id')
                    ->where('promociones.CodigoPromo', $request->input('promocion'))
                    ->get();
                    
        $promoSF = json_decode(json_encode($promo), true);
        if (!empty($promoSF)) {
            if ($promoSF[0]['tipoPlan'] != $request->input('idFrecPago')) {
                $promoSF = array();
            }
        }*/


        $promoSF = $this->getPromotion(null, $request->input('promocion'), $frecPago);

        //initial variable
        $oncoBene = array();

        $oncosmart = false;
        $referidoSF = $request->input('referido');
        

        //obtener primera ronda de informacion
        foreach ($sc as $key => $value) {
            if (!isset($value->options) && !isset($value->options->tipo_id)){
                return Response::json(['code' => '201','url'=>route('index', ['code'=>'Su sesión terminó. Vuelva a intentarlo de nuevo.'])], 201);
            }

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
                    'cedula'              =>    $value->options->cedula,
                    'nombre'              =>    $value->options->nombre." ".$value->options->apellido1." ".$value->options->apellido2,
                    'apellido1'           =>    "",
                    'apellido2'           =>    "",
                    'genero'              =>    (isset($value->options->genero) ? $value->options->genero : 'Masculino'),
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
                $tipo="Cedula física";
                switch ($value->options->tipo_id) {
                    case 1:$tipo="Cedula física";break;
                    case 2:$tipo="Dimex";break;
                    case 3:$tipo="Extranjero";break;
                }

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
                    'coberturaOncosmart'  =>  false,
                );

                $abeneficiario_persona = array(
                    'tipoId'             =>  $value->options->tipo_id,
                    'cedula'             =>  $value->options->cedula,
                    'nombre'             =>  $value->options->nombre,
                    'apellido1'          =>  $value->options->apellido1,
                    'apellido2'          =>  $value->options->apellido2,
                    'genero'             =>  $value->options->genero,
                    'email'              =>  $value->options->email,
                    'telefono'           =>  $value->options->telefono,
                    'celular'            =>  $value->options->telefono,
                    'fecha_nac'          =>  $value->options->fechanacimiento,
                    'provincia'          =>  $value->options->provincia,
                    'canton'             =>  $value->options->canton,
                    'distrito'           =>  $value->options->distrito,
                );

                $abeneficiario_bene = array(
                    'persona_cedula'  =>  $value->options->cedula,
                    'afiliado_cedula' =>  $apersona['cedula'],
                    'parentesco'      =>  $value->options->parentesco,
                    'oncosmart'       =>  false,
                );

                //add onco
                foreach ($oncoBene as $ob) {
                    if ($ob['cedula'] == $data['cedula']){
                        $data['coberturaOncosmart'] = true;
                    }

                    if ($ob['cedula'] == $abeneficiario_bene['afiliado_cedula']){
                        $abeneficiario_bene['oncosmart'] = true;
                    }
                }

                array_push($beneSF, $data);
                array_push($bene_personas, $abeneficiario_persona);
                array_push($bene_bene, $abeneficiario_bene);
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

        //VALIDAR 
        $salesforcontroller = new SalesforceController;
        $responseSF = $salesforcontroller->userStatus($request->cedula);
        if ($responseSF['existe']) {
            switch ($responseSF['status']) {
                case 0: return Response::json(['code' => '403','message' => '¡Tu usuario se encuentra inactivo!. Puedes volver a activarlo llamando al 2211-4444'], 403);

                case 1: 
                    if ($responseSF['afiliado']) {
                        return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);
                    }else{
                        return Response::json(['code' => '403','message' => '¡Ya eres beneficiario en un plan con MediSmart!'], 403);
                    }
                
                case 2:
                    $dataSF = $shoppingcartcontroller->obtenerSFPrimeraVenta();
                    //agregar cod referido
                    $dataSF['codreferidocliente'] = $referidoSF;

                    $salesforcontroller = new SalesforceController;
                    $responseSF = $salesforcontroller->primeraventa(json_encode($dataSF));
                    $res=json_decode($responseSF, true);
                    $res['idFactura'] = rand();
                    //generar carrito de compras
                    $shoppingcartcontroller->setFromFacturaJSON(json_encode($res), $request->cedula);
                    return Response::json([route('facturaafiliacion')], 201);

                case 3: return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);

                default: break;
            }
        }

        //validar si es afiliado
        $afil = Afiliado::where('persona_cedula', $request->cedula)->first();
        $a = json_decode(json_encode($afil), true);
        if (!empty($a)) {
            if ($afil->afiliacion_terminada != 1){
                $afiliado = Afiliado::where('persona_cedula', $request->cedula)->first();
                $user = User::where('cedula', $request->cedula)->first();
                $bene = Beneficiario::where('persona_cedula', $request->cedula)->first();
                //generar carrito de compras
                $afiliadoController = new AfiliadoController;
                $afiliadoController->eliminar($afiliado, $user, $bene);
            }
        }

        $aafiliado= array(
            'persona_cedula'  => $apersona['cedula'],
            'usuario'         => $apersona['email'],
            'contrasena'      => HelpersController::generateRandomString(),
            'idFrecPago'      =>  $frecPago,
            'oncosmart'       =>  $oncosmart,
            'cli'             => '',
            'afiliacion_terminada'             => 0,
        );

        $personatipoid="Cedula física";
        switch ($apersona['tipoId']) {
            case 1:$personatipoid="Cedula física";break;
            case 2:$personatipoid="Dimex";break;
            case 3:$personatipoid="Extranjero";break;
        }

        switch($aafiliado['idFrecPago']){
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
                    'coberturaOncosmart'=>$aafiliado['oncosmart'],
                    'beneficiarios'=>$beneSF,
                    'mascotas'=>$mascotaSF,
                    'promociones'=>$promoSF,
                    'rebajoDias'=> date('j') <= 15 ? 30 : 15 );

        $salesforcontroller = new SalesforceController;
        $responseSF = $salesforcontroller->primeraventa(json_encode($dataSF));
        
        $res=json_decode($responseSF, true);

        if(!$res["resultado"]){
           return Response::json(['data'=>$dataSF ,'code' => '403','message' =>"Ocurrio un error : ".json_encode($res)], 403);
        }
       //DEBUG 

        $shoppingcartcontroller->setFromFacturaJSON(json_encode($res), $apersona['cedula'], $planValue);

        if ($res['resultado']==true) {
            if (User::where('cedula', $apersona['cedula'])->get()->count() == 0){
                $persona = User::create($apersona);
                $persona->save();
            }

            $aafiliado['cli']=$res['cli'];
            $aafiliado['codigo_referido'] = $referidoSF;

            $res['idFactura'] = rand();
            $aafiliado['facturaSF'] = json_encode($res);

            if (Afiliado::where('persona_cedula', $apersona['cedula'])->get()->count() == 0) {
                $afiliado = Afiliado::create($aafiliado);
                $afiliado->save();

                if (!empty($arrayBene)) {
                    $beneficiario_persona = User::create($abeneficiario_persona);
                    $beneficiario_persona->save();
    
                    $beneficiario_bene = Beneficiario::create($abeneficiario_bene);
                    $beneficiario_bene->save();
                }
    
                if (!empty($arrayMascota)) {
                    $mascotas = Mascotas::create($mascotas_array);
                    $mascotas->save();
                }
            }else{
                $afiliado = Afiliado::where('persona_cedula', $apersona['cedula'])->first();
                $afiliado->facturaSF = $aafiliado['facturaSF'];
                $afiliado->codigo_referido = $referidoSF;
                $afiliado->save();
            }

            //AGREGAR A TABLA DE CODIGOS DE DESCUENTO APLICADOS
            $porcentajeCupon = "0";
            $codigoCupon = "0";
            foreach ($promoSF as $codigoDescuento) {
                $porcentajeCupon = $codigoDescuento['descuento'];
                $codigoCupon = $codigoDescuento['idPromocion'];
            }
            CuponesAplicados::create([
                "codigoCupon" => $codigoCupon,
                "descuento" => $porcentajeCupon,
                "cli" => $res['cli'],
                "fecha" => date("Y-m-d H:i:s"),
                "cedula" => $apersona['cedula'],
            ]);

            Activity_Log::create([
                'descripcion' => 'Redirigido a página de pago',
                'session' => Session::getId(),
            ]);

            $sc = $shoppingcartcontroller->obtener();
            $request->session()->put('shoppingcart', $sc);
            $sc = json_decode($sc);
            return Response::json(['code' => '201', 'sc' => $sc, 'res' => $res,'url'=>route('facturaafiliacion')], 201);
        } else {
            if (strpos($res["mensaje"], 'DUPLICATE_VALUE')) {
                return Response::json(['code' => '403','message' => '¡La cédula que deseas afiliar ya cuenta con MediSmart!'], 403);
            } else {
                return Response::json(['code' => '403','message' => 'No se pudo crear su afiliado'], 403);
            }
        }
    }

    public function getPromotion(Request $request = null, $promocion = '', $frecPago = ''){
        Activity_Log::create([
            'descripcion' => 'Obtener promociones',
            'session' => Session::getId(),
        ]);

        $promoSF = array();

        if($promocion == '' && $frecPago == '' && $request != null){
            if ($request->has('promocion')){
                $promocion = $request->get('promocion');
                $frecPago = $request->get('frecPago');
            }
        }

        if(count($promoSF) == 0){
            switch (strtoupper($promocion)) {
                case "FEB20":
                    if(count($promoSF) == 0){
                        //array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                        array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 20, "idPromocion"=> "ALL-DESC-20FEB23" , "cantidadMeses"=> 1));
                       }   
                    break;
                case "WEB25":
                    if(count($promoSF) == 0){
                         //array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                         array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-WEB23" , "cantidadMeses"=> 1));
                        }   
                    break;
                case "ENE25":
                    if(count($promoSF) == 0){
                         array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                         //array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-25ENE23" , "cantidadMeses"=> 1));
                        }   
                    break;
                case "LIMON20":
                        if(count($promoSF) == 0){
                             //array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                             array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 20, "idPromocion"=> "ALL-DESC-20LIM" , "cantidadMeses"=> 1));
                            }   
                    break;
                case "DIC25":
                    if(count($promoSF) == 0){
                         array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                        //  array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-25DIC22" , "cantidadMeses"=> 1));
                        }   
                    break;
                case "SMART20":
                    if(count($promoSF) == 0){
                            //array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                            array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 20, "idPromocion"=> "ALL-DESC-20SMRT22" , "cantidadMeses"=> 1));
                    }   
                    break;
                case "NOV25":
                    if(count($promoSF) == 0){
                         //array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                         array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "NOV25" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                    }   
                    break;
                case "BLACK40":
                    if(count($promoSF) == 0){
                         array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 40,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "BLACK40" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                        // array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 40, "idPromocion"=> "BLACK40" , "cantidadMeses"=> 1));
                    }   
                    break;
                case "LIGA":
                        if(count($promoSF) == 0){
                             //array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                             array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 20, "idPromocion"=> "LIGA" , "cantidadMeses"=> 1));
                        }   
                    break;
                case "OCT25":
                    if(count($promoSF) == 0){
                         array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                         //array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1));
                    }   
                    break;
                case "SET25":
                    if(count($promoSF) == 0){
                         //array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-25SET22" , "cantidadMeses"=> 1));
                         array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                    }   
                    break;
                case "SET20":
                    if(count($promoSF) == 0){
                         array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 20, "idPromocion"=> "ALL-DESC-20SET22" , "cantidadMeses"=> 1));
                    }   
                    break;
                case "AGOS25":
                    if(count($promoSF) == 0){
                        array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25AGO22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                        //array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-25AGO22" , "cantidadMeses"=> 1));
                    }
                break;
                case "JUL20":
                    if(count($promoSF) == 0){
                        array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 20, "idPromocion"=> "ALL-DESC-20JUL22" , "cantidadMeses"=> 1));
                    }
                break;
                case "JUN25":
                    if(count($promoSF) == 0){
                        array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                    }
                break;
                case "PROMOXK":
                    if(count($promoSF) == 0){
                        if ($frecPago == "PLAN SEMESTRAL"){
                            array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 90, "idPromocion"=> "ALL-DESC-PRXK" , "cantidadMeses"=> 1));
                        }else{
                            array_push($promoSF, ["exist"=> true, "valid" => false,  "msg"=> "¡El código promocional [PROMOXK] solo aplica para frecuencia de pago Semestral!", "descuento"=> 0, 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional [PROMOXK] solo aplica para frecuencia de pago Semestral!'], 403);
                        }
                    }
                break;
                case "PROM25":
                    if(count($promoSF) == 0){
                        if ($frecPago == "PLAN SEMESTRAL"){
                            array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-25SET22" , "cantidadMeses"=> 1));
                        }else{
                            array_push($promoSF, ["exist"=> true, "valid" => false,  "msg"=> "¡El código promocional [PROM25] solo aplica para frecuencia de pago Semestral!", "descuento"=> 0, 'code' => '403', "idPromocion"=> "ALL-DESC-25SET22" , "cantidadMeses"=> 1,'message' => '¡El código promocional [PROM25] solo aplica para frecuencia de pago Semestral!'], 403);
                        }
                    }
                break;
                case "PROM35":
                    if(count($promoSF) == 0){
                        if ($frecPago == "PLAN ANUAL"){
                            array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 35, "idPromocion"=> "ALL-DESC-35OCT22" , "cantidadMeses"=> 1));
                        }else{
                            array_push($promoSF, ["exist"=> true, "valid" => false,  "msg"=> "¡El código promocional [PROM35] solo aplica para frecuencia de pago Anual!", "descuento"=> 0, 'code' => '403', "idPromocion"=> "ALL-DESC-35OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional [PROM35] solo aplica para frecuencia de pago Anual!'], 403);
                        }
                    }
                break;
                case "MAYO30":
                    if(count($promoSF) == 0){
                        array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                    }
                break;
                case "MS40":
                    if(count($promoSF) == 0){
                        array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 40, "idPromocion"=> "ALL-DESC-40ABR22" , "cantidadMeses"=> 1));
                    }
                break;
                case 'BEN1': 
                    if(count($promoSF) == 0){
                        if ($frecPago == "PLAN MENSUAL"){
                            array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "Gratis un beneficiario", "descuento"=> 0, "idPromocion"=> "BEN-CORT-IND-0001" , "cantidadMeses"=> 12));
                        }else if ($frecPago == "PLAN SEMESTRAL"){
                            array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "Gratis un beneficiario", "descuento"=> 0, "idPromocion"=> "BEN-CORT-IND-0003" , "cantidadMeses"=> 12));
                        }else if ($frecPago == "PLAN ANUAL"){
                            array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "Gratis un beneficiario", "descuento"=> 0, "idPromocion"=> "BEN-CORT-IND-0004" , "cantidadMeses"=> 12));
                        }else{
                            array_push($promoSF,['code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1, "exist"=> true, "valid"=>false, "descuento"=> 0,  "msg"=> "No pudimos determinar el tipo del plan, por favor vuelva a intentarlo", 'message' => 'No pudimos determinar el tipo del plan, por favor vuelva a intentarlo'], 403);
                        }
                    }
                break;
                case 'MAR25':
                    if(count($promoSF) == 0){
                        array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                    }
                    break;
                case 'PROMO25':
                    if(count($promoSF) == 0){
                        array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-25JUN22" , "cantidadMeses"=> 1));
                    }
                    break;
                case 'FEB25':
                    array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                break;
                case 'DIC20':
                    array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                break;
                case 'DIC30':
                    array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                break;
                case 'VACUNAINFLUENZA':
                    if(count($promoSF) == 0){
                        array_push($promoSF, array("exist"=> true, "valid" => true,  "msg"=> "", "descuento"=> 0, "idPromocion"=> "TIT-PROM-IND-040" , "cantidadMeses"=> 1));
                        array_push($promoSF, array("exist"=> true, "valid" => true,  "msg"=> "", "descuento"=> 0, "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1));
                    }
                break;
                case 'INFLUENZA-21':
                    if ($frecPago == "PLAN SEMESTRAL"){
                        array_push($promoSF, array("exist"=> true, "valid" => true,  "msg"=> "", "descuento"=> 0, "idPromocion"=> "TIT-PROM-IND-040" , "cantidadMeses"=> 2));
                    }else{
                        array_push($promoSF, ["exist"=> true, "valid" => false,  "msg"=> "¡El código promocional [INFLUENZA-21] solo aplica para frecuencia de pago Semestral!", "descuento"=> 0, 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional [INFLUENZA-21] solo aplica para frecuencia de pago Semestral!'], 403);
                    }
                break;
                case 'JULIO30':
                    array_push($promoSF,["exist"=> true, "valid" => false,  "msg"=> "¡El código promocional ha vencido!", "descuento"=> 0 ,'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                break;
                case 'CHEQUEO':
                    if(count($promoSF) == 0){
                        array_push($promoSF, array("exist"=> true, "valid" => true,  "msg"=> "", "descuento"=> 0, "idPromocion"=> "TIT-PROM-IND-014" , "cantidadMeses"=> 1));
                        array_push($promoSF, array("exist"=> true, "valid" => true,  "msg"=> "", "descuento"=> 0, "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1));
                    }
                break;
                case '30MS':
                     array_push($promoSF,["exist"=> true, "valid" => false,  "msg"=> "¡El código promocional ha vencido!", "descuento"=> 0, 'code' => '403', "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                break;
                case '50MS':
                     array_push($promoSF,["exist"=> true, "valid" => false,  "msg"=> "¡El código promocional ha vencido!", "descuento"=> 0, 'code' => '403','message' => '¡El código promocional ha vencido!'], 403);
                break;
                case 'AHORRO25':
                    if(count($promoSF) == 0){
                        array_push($promoSF, array("exist"=> true, "valid" => true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-005" , "cantidadMeses"=> 1));
                    }
                        //array_push($promoSF, array("idPromocion"=> "ALL-DESC-025" , "cantidadMeses"=> 1));
   
                        // switch($frecPago){
                        //     case 'PLAN MENSUAL':
                        //         return Response::json(['code' => '403','message' => '¡El codigo promocional [AHORRO25] no aplica para su frecuencia de pago Mensual!'], 403);
                        //     break;
                        //     case 'PLAN SEMESTRAL':
                        //         return Response::json(['code' => '403','message' => '¡El codigo promocional [AHORRO25] no aplica para su frecuencia de pago Semestral!'], 403);
                        //     break;
                        //     case 'PLAN ANUAL':
                        //         return Response::json(['code' => '403','message' => '¡El codigo promocional ha vencido!'], 403);
                        //         //array_push($promoSF, array("idPromocion"=> "ALL-DESC-025" , "cantidadMeses"=> 1));
                        //     break;
                        //   }
                    break;
                case "SMART25":
                        if(count($promoSF) == 0){
                                //array_push($promoSF,["exist"=> true, "valid"=>false, "descuento"=> 25,  "msg"=> "¡El código promocional ha vencido!", 'code' => '403', "idPromocion"=> "ALL-DESC-25OCT22" , "cantidadMeses"=> 1,'message' => '¡El código promocional ha vencido!'], 403);
                                array_push($promoSF, array("exist"=> true, "valid"=>true,  "msg"=> "", "descuento"=> 25, "idPromocion"=> "ALL-DESC-25SMRT22" , "cantidadMeses"=> 1));
                        }   
                    break;
                default:
                    if(count($promoSF) == 0){
                      array_push($promoSF, array("exist"=> false, "valid" => true,  "msg"=> "No existe el código ingresado", "descuento"=> 10, "idPromocion"=> "ALL-DESC-002" , "cantidadMeses"=> 1));
                    }
                break;
            }
        }

        return $promoSF;
    }
    
    public function recepcionReferido($cliBen, $codRef)
    {
        $arraySF = array(
          'codigoRef'       => $codRef,
          'idClienteCreado' => $cliBen
        );

        $salesforcontroller = new SalesforceController;
        $responseSF = $salesforcontroller->recepcionreferido(json_encode($arraySF));

        $res=json_decode($responseSF, true);
        return $res;
    }
      
    public function getFactura($cli)
    {
        $aafiliado = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where('cli', $cli)->first();

        $afiliado = json_decode(json_encode($aafiliado), true);

        $factura = json_decode($afiliado['facturaSF'], true);

        $abeneficiario=DB::table('beneficiario')
                          ->join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                          ->where('beneficiario.afiliado_cedula', '=', $afiliado['cedula'])
                          ->get();

        $beneficiario = json_decode(json_encode($abeneficiario), true);

        $amascotas=DB::table('mascotas')
                      ->where('persona_cedula', '=', $afiliado['cedula'])
                      ->get();

        $mascotas = json_decode(json_encode($amascotas), true);

        $afiliado['beneficiarios']=$beneficiario;
        $afiliado['mascotas']=$mascotas;

        return Response::json(['data' => $afiliado,'code' => '201','factura'=> $factura], 201);
    }
      
    public function findCorreo($correo)
    {
        $personas = User::where('email', $correo)->first();
        $response  = Response::json(array('entontrado'=>empty($personas)), 201);
        return $response;
    }
}
