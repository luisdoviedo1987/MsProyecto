@extends('layout.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10 gform_page_fields">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <img src="https://medismart.net/control/images/Ingreso-Soy-Afiliado-MediSmart.png" style="max-width:100%">
                </div>
                <form class="col-lg-6 col-sm-12" id="loginForm" action="{{ route('login') }}" method="post">
                    {{ csrf_field() }}
                    <div >
                        <li>
                            <h5 class="mt-4">
                                <!---->
                                <div class="lato" style="text-align: center;">Ingresá con tus Datos</div>
                                <!---->
                            </h5>
                            <div class="mt-4">
                                <input class="medium" id="user" name="user" minlength="3" type="email" placeholder="Correo Electrónico" />
                            </div>
                        </li>
                        <li>
                            <div class="mt-3">
                                <input class="medium" id="password" minlength="3" name="password" type="password" placeholder="Contraseña" />
                            </div>
                        </li>
                        <li>
                            <div class="mt-5">
                                <div class="row m-1">
                                    <div class="col-12 col-sm-6 p-1" style="line-height: 27px;">
                                        <!---->
                                        <a class="gform_previous_button justify-content-center" style="cursor: pointer; text-align:center!important;">Limpiar</a>
                                        <!---->
                                    </div>
                                    <div class="col-12 col-sm-6 p-1" style="line-height: 27px;">
                                        <!---->
                                        <a class="gform_next_button button justify-content-center" style="cursor: pointer; pointer-events: auto; text-align:center!important;" id="aLogin">Entrar</a>
                                        <!---->
                                    </div>
                                </div>
                            </div>
                        </li>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="ng-tns-c0-0" style="text-align: center;">
            <!---->
            <p class="ng-tns-c0-0 ng-star-inserted mb-0">
                ¿Ya sos afiliado pero no tenés contraseña? Autogestioná tu plan médico: <br />
                <a class="ng-tns-c0-0" style="color: #ed2980; cursor: pointer;" href="{{ route('createpassword') }}"> Regístrate aquí.</a>
            </p>
            <!----><!---->
            <p class="ng-tns-c0-0 ng-star-inserted mb-0 mt-3">
                ¿Aún no sos afiliado? <br />
                <a class="ng-tns-c0-0" style="color: #ed2980; cursor: pointer;" href="{{ route('afiliacion') }}">Afiliate aquí</a>
            </p>
            <!----><!---->
            <p class="ng-tns-c0-0 ng-star-inserted mb-0 mt-3">
                <a class="ng-tns-c0-2" style="color: #ed2980; cursor: pointer;" href="{{ route('forgotpass') }}">¿Olvidaste tu contraseña?</a>
            </p>
            <!---->
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
     $(document).ready(function(){
        let searchParams = new URLSearchParams(window.location.search)
        if(searchParams.has('newPortal')){
            $('#update_modal').modal('show');
            
        } 
    });

    $( "#aLogin" ).click(function() {
        var form = $( "#loginForm" );
        form.validate({
            errorClass: 'ng-invalid',
        });
        var formData = $('#loginForm').serialize();
        if (form.valid()) {
            $('.bd-loading-modal-lg').modal('show');

            $.ajax({
                type:'POST',
                url:"{{ route('check.login') }}",
                data:formData,
                success:function(data){
                    @if (isset($url))
                        window.location.replace("{{ url('/control') . '/' . $url }}");
                    @else
                        window.location.replace('{{route("perfil")}}');
                    @endif
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    if (XMLHttpRequest.status == 403) {
                        rmse('Error', XMLHttpRequest.responseJSON.mensaje);
                    }else{
                        rmse('Error', 'Ocurrió un error al iniciar sesión, intente mas tarde');
                    }
                }   
            });
        }
    });
</script>
    @if ($code != null)
        @if($code == 'c1')
            <script>
                $(document).ready(function(){
                    $('#success_modal').modal('show');
                    $('#success_modal_title').html('Contraseña creada');
                    $('#success_modal_subtitle').html('Se ha creado su contraseña, puedes iniciar sesión utilizando esa contraseña');
                });
            </script>
        @elseif($code == 'c2')
            <script>
                $(document).ready(function(){
                    $('#success_modal').modal('show');
                    $('#success_modal_title').html('Contraseña actualizada');
                    $('#success_modal_subtitle').html('Se ha actualizado su contraseña, puedes iniciar sesión utilizando esa contraseña');
                });
            </script>
        @endif
    @endif
@endsection