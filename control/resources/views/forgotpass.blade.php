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
                            <h2 style="text-align:center; color: #0098d6" >Olvidó su contraseña</h2>
                        </div> 
                    </div>  
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-4 justify-content-center">
                            <h6 style="color:#6c757d; col-sm-6 offset-md-3 ng-tns-c0-0 ng-star-inserted font-size: 19px; font-family: Lato,sans-serif!important;">Seguí los pasos para recuperar tu contraseña</h6>
                        </div>
                    </div>    
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-4">
                            <input aria-invalid="false" aria-required="true" type="text" id="email" name="email" value placeholder="Correo Electrónico" required="true">
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

            if ($("#email").val()  == ""){
                rmse('Error', 'Por favor ingrese un correo electronico');
                return;
            }

            var form = $( "#form-cp" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form-cp').serialize();
            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('forgot.password') }}",
                    data:formData,
                    success:function(data){
                        rmss(false,'Correo enviado', 'Se ha enviado un correo con la información necesaria para que recuperes tu contraseña');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        if (XMLHttpRequest.status == 403) {
                            rmse('Error', 'No se encontro ningún usuario con el correo electronico ingresado');
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