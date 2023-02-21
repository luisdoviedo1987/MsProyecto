<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/afiliacion/afiliarse/{plan}', 'AfiliacionController@afiliarse')->name('afiliarse');
// Route::post('/afiliacion/afiliarse', 'AfiliacionController@saveAfiliado')->name('afiliarse.post');

//new HTML
Route::get('/afiliacion/afiliarse/{plan}/{code?}', 'AfiliacionController@afiliarse')->name('afiliarse');
Route::post('/afiliacion/afiliarse', 'AfiliacionController@saveAfiliado')->name('afiliarse.post');


// Route::post('/afiliacion/agregarservicios', 'AfiliacionController@afiliacion');
// Route::post('/afiliacion/agregarservicios/nuevo_beneficiario', 'AfiliacionController@addBeneficiario')->name('agregar.beneficiario');
Route::post('/afiliacion/agregarservicios/eliminar_beneficiario', 'AfiliacionController@deleteBeneficiario')->name('eliminar.beneficiario');
Route::post('/afiliacion/agregarservicios/nueva_mascota', 'AfiliacionController@addMascota')->name('agregar.mascota');
Route::post('/afiliacion/agregarservicios/eliminar_mascota', 'AfiliacionController@deleteMascota')->name('eliminar.mascota');
Route::post('/afiliacion/agregarservicios/agregar_oncosmart_afiliado', 'AfiliacionController@addOncosmartAfiliado')->name('agregar.oncosmart.afiliado');
Route::post('/afiliacion/agregarservicios/agregar_oncosmart', 'AfiliacionController@addOncosmart')->name('agregar.oncosmart');
// Route::get('/afiliacion/agregarservicios/{modal?}/{reference?}/{promotion?}', 'AfiliacionController@agregarServicios')->name('agregarservicios');

//new HTML
Route::post('/afiliacion/agregarservicios', 'AfiliacionController@afiliacion')->name('agregarservicios.post');
Route::post('/afiliacion/agregarservicios/nuevo_beneficiario', 'AfiliacionController@addBeneficiario')->name('agregar.beneficiario');
Route::get('/afiliacion/agregarservicios/{modal?}/{reference?}/{promotion?}', 'AfiliacionController@agregarServicios')->name('agregarservicios');
Route::post('/afiliacion/consultar-promocion', 'AfiliacionController@getPromotion')->name('consultar-promocion');
Route::get('/afiliacion/consultar-promocion/{promocion}/{frecPago}', 'AfiliacionController@getPromotion');

// Route::get('/afiliacion/factura-afiliacion', 'PagoController@facturaafiliacion')->name('facturaafiliacion');
Route::get('/afiliacion/factura-afiliacion', 'PagoController@facturaafiliacion')->name('facturaafiliacion');

// Route::post('/afiliacion/afiliar-tarjeta', 'TarjetasController@afiliarTarjeta')->name('afiliar.tarjeta');
Route::post('/afiliacion/afiliar-tarjeta', 'TarjetasController@afiliarTarjeta')->name('afiliar.tarjeta');

Route::post('/afiliacion/reenviar-sms', 'TarjetasController@reenviarSms')->name('reenviar.sms');


Route::post('/afiliacion/generate-password', 'AfiliadoController@setNewPassword')->name('generate.password.post');
Route::get('/afiliacion/generate-password/{data}', 'AfiliadoController@generateNewPassword')->name('generate.password');
Route::get('/afiliacion/generate/{autouniq}', 'AfiliadoController@generateNewPasswordAutouniq')->name('generate.password.autouniq');

Route::get('/afiliacion', 'ViewsController@irAfiliacion')->name('afiliacion');
Route::get('/afiliacion/{code?}', 'ViewsController@irAfiliacion')->name('afiliacion');

Route::get('/create-password', 'ViewsController@createpasswords')->name('createpassword');

Route::get('/login', 'ViewsController@login')->name('login');

Route::get('/forgotpass', 'ViewsController@forgotPass')->name('forgotpass');

Route::get('/logout', 'ViewsController@logout')->name('logout');

Route::post('/login', 'LoginController@login')->name('login');
Route::post('/check-login', 'LoginController@loginAfiliado')->name('check.login');

//create password afiliado
Route::get('/create-password/soytitular', 'ViewsController@soyTitular')->name('soytitular');
Route::get('/afiliado-crear-contrasena/{data}/{afilemail?}', 'ViewsController@createPassword')->name('afiliado.create.password');
Route::get('/afiliado-link-no-valido', 'ViewsController@linknovalido')->name('afiliado.link.desactivado');
Route::post('/create-password', 'AfiliadoController@generatepassword')->name('create.password');
Route::post('/afiliado-save-password', 'AfiliadoController@savePassword')->name('afiliado.savepassword');

//create password beneficiario
Route::get('/create-password/soybeneficiario', 'ViewsController@soyBeneficiario')->name('soybeneficiario');
Route::get('/beneficiario-crear-contrasena/{data}', 'ViewsController@createPasswordBene')->name('beneficiario.create.password');
Route::post('/create-password-beneficiario', 'BeneficiarioController@generatepassword')->name('create.password.beneficiario');
Route::post('/beneficiario-save-password', 'BeneficiarioController@savePassword')->name('beneficiario.save.password');

Route::post('/forgotpass_post', 'EmailController@updatePassword')->name('forgot.password');
Route::get('/afiliado-recuperar-contrasena/{data}/{afilemail?}', 'ViewsController@updatePassword')->name('afiliado.create.password');
Route::post('/update-password', 'AfiliadoController@updatePassword')->name('update.password');


//buscar cedula
Route::post('/buscar_cedula', 'ViewsController@buscarCedula')->name('buscar.cedula');

/**
 * Only Authenticated
*/
Route::middleware(['auth'])->group(function () {
    //home
    Route::get('/perfil', 'ViewsController@irPerfil')->name('perfil');
    Route::get('/validacion', 'ViewsController@irValidacion')->name('validacion');

    Route::prefix('validacion')->group(function () {
        Route::post('crear', 'ValidacionController@generarCodigo')->name('validacion.crear');
    });

    Route::get('/perfil/{usuario}', 'ViewsController@irPerfilUsuario')->name('perfil.usuario');
    Route::get('/servicios', 'ViewsController@irServicios')->name('servicios');
    Route::get('/cambiocontrasena', 'ViewsController@cambiarContrasena')->name('cambiocontrasena');
    Route::post('/cambiocontrasena', 'UserController@cambiarContrasena')->name('contrasena.cambiar');

    //home
    Route::get('/afiliado', 'ViewsController@irAfiliado')->name('afiliado');

    //beneficiarios
    Route::get('/misbenes', 'ViewsController@irBeneficiarios')->name('misbenes');

    //tarjetas
    Route::get('/tarjetas', 'ViewsController@irTarjetas')->name('tarjetas');

    //carnet-virtual
    Route::get('/carnet-virtual', 'ViewsController@irCarnet')->name('carnet');

    //citas
    Route::get('/citas', 'ViewsController@irCitas')->name('citas');


    //beneficios
    Route::get('/beneficios', 'ViewsController@irCitas')->name('beneficios');


    //oncosmart
    Route::get('/oncosmart', 'ViewsController@irOncosmart')->name('oncosmart');

    //beneficiario
    Route::get('/beneficiario', 'ViewsController@irBeneficiario')->name('beneficiario');

    //mascotas
    Route::get('/mascotas', 'ViewsController@irMascotas')->name('mascotas');

    //mascotas
    Route::prefix('mascotas')->group(function () {
        Route::post('editar', 'MascotasController@actualizarMascotas')->name('mascotas.editar');
    });

    //carrito de compras
    Route::get('/carrito', 'ViewsController@irShoppingcart')->name('carrito');

    //REFERIDOS
    Route::get('/referidos', 'ViewsController@irReferidos')->name('referidos');
    Route::get('/consulta-referidos/{code?}', 'ViewsController@irConsultaReferidos')->name('consulta.referidos');
    Route::get('/consulta-regalias', 'ViewsController@irConsultaRegalias')->name('consulta.regalias');
    Route::prefix('referidos')->group(function () {
        Route::post('guardar', 'ReferidosController@createReferido')->name('referidos.guardar');
        Route::post('consultar', 'ReferidosController@consultarReferencias')->name('referidos.consultar');
    });

    Route::prefix('regalias')->group(function () {
        Route::post('consultar', 'ReferidosController@consultarRegalias')->name('regalias.consultar');
    });

    //TARJETAS
    Route::prefix('tarjetas')->group(function () {
        Route::post('guardar', 'TarjetasController@addTarjeta')->name('tarjetas.guardar');
        Route::post('eliminar', 'TarjetasController@deleteTarjeta')->name('tarjetas.eliminar');
    });

    //AFILIADOS
    Route::prefix('afiliado')->group(function () {
        Route::post('actualizar', 'AfiliadoController@actualizarAfiliado')->name('afiliado.actualizar');
        Route::post('validarconvenios', 'UserController@validarConvenios')->name('afiliado.validarconvenios');
    });

    //BENEFICIARIOS
    Route::prefix('beneficiario')->group(function () {
        Route::post('acciones', 'BeneficiarioController@accionesBeneficiario')->name('beneficiario.acciones');
        Route::post('actualizar', 'BeneficiarioController@actualizarBeneficiario')->name('beneficiario.actualizar');
    });

    //carritos de compras
    Route::prefix('shoppingcart')->group(function(){
        Route::post('agregar_oncosmart_beneficiario', 'ShoppingcartController@agregarOncosmartBeneficiario')->name('shoppingcart.agregar.oncosmart.beneficiario');
        Route::post('agregar_oncosmart_afiliado', 'ShoppingcartController@agregarOncosmartAfiliado')->name('shoppingcart.agregar.oncosmart.afiliado');
        Route::post('agregar_beneficiario', 'ShoppingcartController@agregarBeneficiario')->name('shoppingcart.agregar.beneficiario');
        Route::post('agregar_mascota', 'ShoppingcartController@agregarMascota')->name('shoppingcart.agregar.mascota');
        Route::post('eliminar', 'ShoppingcartController@delete')->name('shoppingcart.delete');

        Route::post('send_email', 'EmailController@send')->name('shoppingcart.send.email');
    });
});


/**
 * Only Authenticated ADMINISTRATOR
*/
Route::middleware(['auth'])->group(function () {
    //users
    Route::get('/users', 'ViewsController@irUsers')->name('admin.users');
    Route::post('/users', 'UserController@editUser');
    Route::post('/users/delete', 'UserController@delete')->name('admin.users.delete');
    Route::post('/users/resentemail', 'UserController@resendEmailPass')->name('admin.users.email');
    Route::get('/users/information', 'UserController@getUserData')->name('admin.users.information');

    //search user
    Route::post('/users/search', 'AdministratorController@searchUser')->name('admin.users.search');
    Route::post('/users/agregar', 'AdministratorController@agregarusuario')->name('admin.users.agregar');
    
    //welcome
    Route::get('/welcome_email', 'ViewsController@irWelcomeEmail')->name('admin.welcome.email');
    Route::post('/welcome_email', 'EmailtemplateController@updateWelcomeEmail');

    //refer
    Route::get('/refer_email', 'ViewsController@irReferEmail')->name('admin.refer.email');
    Route::post('/refer_email', 'EmailtemplateController@updateReferEmail');

    //update password
    Route::get('/update_password_email', 'ViewsController@irUpdatepassEmail')->name('admin.updatepass.email');
    Route::post('/update_password_email', 'EmailtemplateController@updatePasswordEmail');

    //sms
    Route::get('/sms', 'ViewsController@irSmsText')->name('admin.sms.text');
    Route::post('/sms', 'EmailtemplateController@upatedSmsText'); 
});


Route::get('ubicaciones/provincias/','UbicacionController@getProvincias')->name('api.provincias');
Route::get('ubicaciones/cantones/{distelec}','UbicacionController@getCantones')->name('api.cantones');
Route::get('ubicaciones/distritos/{distelec}','UbicacionController@getDistritos')->name('api.distritos');

Route::get('/{code?}', 'ViewsController@index')->name('index');