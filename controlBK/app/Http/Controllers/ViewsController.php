<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Crypt;

//controller
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingcartController;
use App\Http\Controllers\PromocionesafiliadoController;

//models
use App\EmailTemplate;
use App\Configuraciones;
use App\Beneficiario;
use App\AffiliateImageCode;

class ViewsController extends Controller
{
    //user controller
    protected $userController = "";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userController = new UserController();
    }

    function buscarCedula(Request $request){
        $url = "https://tse.medismart.info/api/persona/buscarCedula.php?user=sfconsult&password=8Rh8hcRFMyGmqimA&buscarCedula=" . $request->cedula;
        $ch = curl_init($url);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            )
        );

        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'get');
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10000);

        //ejecutar
        $response = curl_exec( $ch );

        //cerrar conexion
        curl_close( $ch );
        if ($response === false) {
            return null;
        }

        return $response;
    }

    function index($code = null, Request $request){
        if (Auth::check()){
            return redirect()->route('perfil');
        }

        if ($request->has('url')){
            return view('index')
                ->with('code', $code)
                ->with('url', $request->get('url'));
        }else{
            return view('index')
                ->with('code', $code);
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('index');
    }

    function irAfiliacion($code = null){
        if ($code != null) {
            $affiliateCodes = AffiliateImageCode::where('active', 1)
                            ->where('pageCode', $code)
                            ->get();

            if (count($affiliateCodes) > 0) {
                return view('afiliacion')
                   ->with('affiliateCodes', $affiliateCodes[0]);
            }
        }

        return view('afiliacion');
    }

    function createpasswords(){
        return view('createpassword');
    }

    function login(Request $request){
        return redirect()->route('index');
    }

    function forgotPass(){
        return view('forgotpass');
    }

    function soyTitular(){
        return view('soytitular');
    }

    function soyBeneficiario(){
        return view('soybeneficiario');
    }

    function cambiarContrasena(){
        return view('cambiocontrasena');
    }

    function irPerfilUsuario($usuario){
        $idUsuario = Crypt::decryptString($usuario);

        $afiliado = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where('personas.cedula' , '=', $idUsuario)
                        ->first();

        if (isset($afiliado)){
            //logout
            Auth::logout();

            Auth::loginUsingId($afiliado->persona_cedula);
        }else{
            //logout
            Auth::logout();

            $beneficiario = DB::table('beneficiario')
                        ->join('personas', 'beneficiario.persona_cedula', '=', 'personas.cedula')
                        ->where('personas.cedula', '=', $idUsuario)
                        ->first();
            
            Auth::loginUsingId($beneficiario->persona_cedula);
        }

        return $this->irPerfil(false);
    }

    function irValidacion(){
        $mostrarrepetidos = true;
        if (Auth::user()->administrador == 1){
            return redirect()->route('admin.welcome.email');
        }
        $informacion = $this->userController->obtenerInformacion();
        $repetidos =  $this->userController->obtenerRepetidos();
        
        //contar los repetidos
        $totalRepetidos = 0;
        for ($i=0; $i < count($repetidos); $i++) { 
            for ($j=0; $j < count($repetidos[$i]); $j++) { 
                $repetidos[$i][$j]->{'encryptId'} = Crypt::encryptString($repetidos[$i][$j]->cedula);
            }

            $totalRepetidos = count($repetidos[$i]);
        }

        if(!$mostrarrepetidos) {
            $totalRepetidos = 1;
        }

        //tiene promocion
        $promocion = null;
        if (isset($informacion->getData()->cli)) {
            $promocionescontroller = new PromocionesafiliadoController;
            $promocion = $promocionescontroller->obtenerxCli($informacion->getData()->cli);
        }

        //obtener las configuraciones
        $configuraciones = Configuraciones::where('id_configuracion', 1)->first();

        //cambiar contraseña
        $user = Auth::user();
        $afiliado = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where([
                          [	'persona_cedula' , '=', $user->cedula]
                        ])->first();

        if ($afiliado) {
            if ($afiliado->changePassword == 1) {
                return redirect()->route('cambiocontrasena');
            }
        }else{
            $beneficiario = Beneficiario::join('personas', 'persona_cedula', '=', 'cedula')->where([
                ['persona_cedula', $user->cedula],
            ])->first();

            if ($beneficiario) {
                if ($beneficiario->changePassword == 1) {
                    return redirect()->route('cambiocontrasena');
                }
            }
        }

        //beneficiario y tarjetas tienen esto
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return view('app.afiliacion')
                ->with('data', $informacion)
                ->with('promocion', $promocion)
                ->with('configuracion', $configuraciones);
        }

        return view('app.validacion')
             ->with('data', $informacion)
             ->with('promocion', $promocion)
             ->with('configuracion', $configuraciones)
             ->with('totalRepetidos', $totalRepetidos)
             ->with('repetidos', $repetidos);

             
    }

    


    function irPerfil($mostrarrepetidos = true){
        if (Auth::user()->administrador == 1){
            return redirect()->route('admin.welcome.email');
        }
        
        $informacion = $this->userController->obtenerInformacion();
        $repetidos =  $this->userController->obtenerRepetidos();
        
        //contar los repetidos
        $totalRepetidos = 0;
        for ($i=0; $i < count($repetidos); $i++) { 
            for ($j=0; $j < count($repetidos[$i]); $j++) { 
                $repetidos[$i][$j]->{'encryptId'} = Crypt::encryptString($repetidos[$i][$j]->cedula);
            }

            $totalRepetidos = count($repetidos[$i]);
        }

        if(!$mostrarrepetidos) {
            $totalRepetidos = 1;
        }

        //tiene promocion
        $promocion = null;
        if (isset($informacion->getData()->cli)) {
            $promocionescontroller = new PromocionesafiliadoController;
            $promocion = $promocionescontroller->obtenerxCli($informacion->getData()->cli);
        }

        //obtener las configuraciones
        $configuraciones = Configuraciones::where('id_configuracion', 1)->first();

        //cambiar contraseña
        $user = Auth::user();
        $afiliado = DB::table('afiliado')
                        ->join('personas', 'afiliado.persona_cedula', '=', 'personas.cedula')
                        ->where([
                          [	'persona_cedula' , '=', $user->cedula]
                        ])->first();

        if ($afiliado) {
            if ($afiliado->changePassword == 1) {
                return redirect()->route('cambiocontrasena');
            }
        }else{
            $beneficiario = Beneficiario::join('personas', 'persona_cedula', '=', 'cedula')->where([
                ['persona_cedula', $user->cedula],
            ])->first();

            if ($beneficiario) {
                if ($beneficiario->changePassword == 1) {
                    return redirect()->route('cambiocontrasena');
                }
            }
        }

        //beneficiario y tarjetas tienen esto
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return view('app.afiliacion')
                ->with('data', $informacion)
                ->with('promocion', $promocion)
                ->with('configuracion', $configuraciones);
        }

        return view('app.perfil')
             ->with('data', $informacion)
             ->with('promocion', $promocion)
             ->with('configuracion', $configuraciones)
             ->with('totalRepetidos', $totalRepetidos)
             ->with('repetidos', $repetidos);
    }

    function irServicios(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        $informacion = $this->userController->obtenerInformacion();
        //tiene promocion
        $promocion = null;
        if (isset($informacion->getData()->cli)) {
            $promocionescontroller = new PromocionesafiliadoController;
            $promocion = $promocionescontroller->obtenerxCli($informacion->getData()->cli);
        }

        //obtener las configuraciones
        $configuraciones = Configuraciones::where('id_configuracion', 1)->first();

        return view('app.servicios')
                ->with('data', $this->userController->obtenerInformacion())
                ->with('promocion', $promocion)
                ->with('configuracion', $configuraciones);
    }

    function irAfiliado(){
        if (Auth::user()->administrador == 1){
            return redirect()->route('admin.welcome.email');
        }
        
        $informacion = $this->userController->obtenerInformacion();
        //tiene promocion
        $promocion = null;
        if (isset($informacion->getData()->cli)) {
            $promocionescontroller = new PromocionesafiliadoController;
            $promocion = $promocionescontroller->obtenerxCli($informacion->getData()->cli);
        }

        //obtener las configuraciones
        $configuraciones = Configuraciones::where('id_configuracion', 1)->first();

        return view('app.afiliacion')
             ->with('data', $informacion)
             ->with('promocion', $promocion)
             ->with('configuracion', $configuraciones);
    }

    function irBeneficiarios(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        $informacion = $this->userController->obtenerInformacion();
        //tiene promocion
        $promocion = null;
        if (isset($informacion->getData()->cli)) {
            $promocionescontroller = new PromocionesafiliadoController;
            $promocion = $promocionescontroller->obtenerxCli($informacion->getData()->cli);
        }

        //obtener las configuraciones
        $configuraciones = Configuraciones::where('id_configuracion', 1)->first();

        return view('app.misbenes')
                ->with('data', $informacion)
                ->with('promocion', $promocion)
                ->with('configuracion', $configuraciones);
    }

    function irTarjetas(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        return view('app.tarjetas')
                ->with('data', $this->userController->obtenerInformacion());
    }

    function irCarnet(){
        // return $this->userController->obtenerInformacion();
        return view('app.carnet')
                ->with('data', $this->userController->obtenerInformacion());
    }

    function irCitas(){
        return view('app.citas')
                ->with('data', $this->userController->obtenerInformacion());
    }

    function irOncosmart(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        return view('app.oncosmart')
                ->with('data', $this->userController->obtenerInformacion());
    }

    function irBeneficiario(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        $informacion = $this->userController->obtenerInformacion();
        //tiene promocion
        $promocion = null;
        if (isset($informacion->getData()->cli)) {
            $promocionescontroller = new PromocionesafiliadoController;
            $promocion = $promocionescontroller->obtenerxCli($informacion->getData()->cli);
        }

        //obtener las configuraciones
        $configuraciones = Configuraciones::where('id_configuracion', 1)->first();

        return view('app.beneficiario')
                ->with('data', $informacion)
                ->with('promocion', $promocion)
                ->with('configuracion', $configuraciones);
    }

    function irMascotas(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        return view('app.mascotas')
                ->with('data', $this->userController->obtenerInformacion());
    }

    function irShoppingcart(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        $shoppingcartcontroller = new ShoppingcartController();
        return view('app.carrito')
                ->with('data', $this->userController->obtenerInformacion())
                ->with('cart', $shoppingcartcontroller->obtener());
    }

    function irReferidos(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        return view('app.referidos')
                ->with('data', $this->userController->obtenerInformacion());
    }

    function irConsultaReferidos($code = null){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        if (!empty($code)) {
            return view('app.consultareferidos')
                ->with('data', $this->userController->obtenerInformacion())
                ->with('code', $code);
        }else{
            return view('app.consultareferidos')
                ->with('data', $this->userController->obtenerInformacion());
        }
    }

    function irConsultaRegalias(){
        if (isset($this->userController->obtenerInformacion()->getData()->afiliado) && !$this->userController->obtenerInformacion()->getData()->afiliado) {
            return redirect()->route('afiliado');
        }

        return view('app.consultaregalias')
                ->with('data', $this->userController->obtenerInformacion());
    }

    function createPassword($data, $afilemail = ""){
        return view('cambiarcontrasena')
                ->with('data', $data)
                ->with('afilemail', $afilemail);
    }

    function createPasswordBene($data){
        return view('cambiarcontrasenabene')
                ->with('data', $data);
    }

    function updatePassword($data, $afilemail = ""){
        return view('actualizarcontrasena')
                ->with('data', $data)
                ->with('afilemail', $afilemail);
    }

    function linknovalido(){
        return view('linknovalido');
    }

    //ADMINISTRATOR
    function irWelcomeEmail(){
        if (Auth::user()->full_acceso == 1){
            $email_template = EmailTemplate::where('id', 1)->first();
            return view('admin.index')
                    ->with('template', $email_template);
        }else{
            return redirect()->route('admin.users');
        }
    }

    function irReferEmail(){
        if (Auth::user()->full_acceso == 1){
            $email_template = EmailTemplate::where('id', 2)->first();
            return view('admin.refer')
                ->with('template', $email_template);
        }else{
            return redirect()->route('admin.users');
        }
    }

    function irUpdatepassEmail(){
        if (Auth::user()->full_acceso == 1){
            $email_template = EmailTemplate::where('id', 3)->first();
            return view('admin.pass')
                ->with('template', $email_template);
        }else{
            return redirect()->route('admin.users');
        }
    }

    function irSmsText(){
        if (Auth::user()->full_acceso == 1){
            $email_template = EmailTemplate::where('id', 4)->first();
            return view('admin.sms')
                ->with('template', $email_template);
        }else{
            return redirect()->route('admin.users');
        }
    }

    function irUsers(){
        // $users = $this->userController->all();
        return view('admin.users');
                // ->with('users', $users);
    }
}
