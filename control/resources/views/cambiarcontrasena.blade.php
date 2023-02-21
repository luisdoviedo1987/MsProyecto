@extends('layout.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4 justify-content-center" id="gform_1">  
            <form id="form-cp" style="text-align:center;">
                {{ csrf_field() }}
                <input type="hidden" name="data" value="{{ $data }}" />
                <div id="gform_page_1_1 " class="justify-content-center"> 
                    <div class="row justify-content-center">
                        <div class="col-md-12 mt-3">
                            <h2 style="text-align:center; color: #0098d6" >Ingresá tu nueva contrasena</h2>
                        </div> 
                    </div>  
                    @if (isset($afilemail) && $afilemail != "")
                    <div class="row justify-content-center">
                        <div class="col-md-12 mt-3">
                            <h4>Tu usuario es: <a style="text-align:center; color: #a682bf"> {{ $afilemail }} </a></h4>
                        </div> 
                    </div>  
                    @endif
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-4 justify-content-center">
                            <h6 style="color:#6c757d; col-sm-6 offset-md-3 ng-tns-c0-0 ng-star-inserted font-size: 19px; font-family: Lato,sans-serif!important;">Ingresá a continuación la contraseña que desea utilizar para ingresar a Medismart:</h6>
                        </div>
                    </div>    
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-4">
                            <input aria-invalid="false" aria-required="true" type="password" id="contrasena" name="contrasena" value placeholder="Contraseña">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-4">
                            <input aria-invalid="false" aria-required="true" type="password" id="repeat_password" name="repeat_password" value placeholder="Confirmar contraseña">
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
                    url:'{{ route("afiliado.savepassword") }}',
                    data:formData,
                    success:function(data){
                        window.location.replace('{{route("index", ["code"=>"c1"])}}');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        if (XMLHttpRequest.status == 403) {
                            rmse('Error', XMLHttpRequest.responseJSON.message);
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