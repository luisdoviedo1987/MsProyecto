@extends('layout.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4 justify-content-center" id="gform_1">  
            <form id="form-cp" style="text-align:center;" action="javascript:void(0);">
                {{ csrf_field() }}
                <div id="gform_page_1_1 " class="justify-content-center"> 
                    <div class="row justify-content-center">
                        <div class="col-md-12 mt-3">
                            <h2 style="text-align:center; color: #0098d6" >Ingresá tu número de identificación</h2>
                        </div> 
                    </div>  
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-4 justify-content-center">
                            <h6 style="color:#6c757d; col-sm-6 offset-md-3 ng-tns-c0-0 ng-star-inserted font-size: 19px; font-family: Lato,sans-serif!important;">Ingresá a continuación tu número de identificación. Luego enviaremos un correo electrónico al email asociado a tu cuenta en MediSmart:</h6>
                        </div>
                    </div>    
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-4">
                            <input aria-invalid="false" aria-required="true" type="text" id="cedula" name="cedula" value placeholder="Número de identificación" required="true">
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-12 col-md-4 p-1" style="line-height: 27px;">
                        <!---->
                            <a class="gform_next_button button justify-content-center" id="continuar" style="cursor: pointer; pointer-events: auto; text-align:center!important;">CONTINUAR</a>
                        <!---->
                        </div>
                    </div>
                </div>
            </form>
        </div>
       
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#continuar').on('click', function(){
            var form = $( "#form-cp" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form-cp').serialize();
            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('create.password') }}",
                    data:formData,
                    success:function(data){
                        rmss(false,"Correo enviado.","Te enviamos un correo electronico, por favor ingresa al correo verifica tu e-mail, para completar la creacion de tu usuario y tu contraseña.");
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        if (XMLHttpRequest.status == 403) {
                            rmse('Error', XMLHttpRequest.responseJSON.message);
                            //rmse('Error', XMLHttpRequest.responseJSON.message);
                        }else{
                            rmse('Error', 'Ocurrió un error, intente mas tarde');
                        }
                    }   
                });
            }
        });
    });
</script>
@endsection