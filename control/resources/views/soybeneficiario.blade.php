@extends('layout.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4 justify-content-center">  
            <form style="text-align:center; " id="form-cb" action="javascript:void(0);">
                {{ csrf_field() }}
                <div id="gform_page_1_1" class="justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-3">
                            <h2 style="text-align:center; color: #0098d6" >Ingresá tu código BEN</h2>
                        </div>
                    </div>      
                    <div class="row justify-content-center">
                        <div class="col-md-12 justify-content-center">
                            <p style="text-align:center"> Ingresá a continuación tu número de beneficiario
                            <br>Si no lo tenés a mano, podés solicitarlo vía telefónica al 2528-5400:</p>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8 mt-4">
                            <input aria-invalid="false" id="ben" name="ben" aria-required="true" type="text" value placeholder="Código de Afiliado(BEN)" required="true">
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
            var form = $( "#form-cb" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form-cb').serialize();
            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('create.password.beneficiario')}}",
                    data:formData,
                    success:function(data){
                        rmss(false,"Correo enviado.","Te enviamos un correo , por favor ingresa al correo verifica tu e-mail, para completar la creacion de tu usuario y tu contraseña.");
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