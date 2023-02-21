@extends('layout.master')

@section('content')
<div class="container">
    <div class="col-sm-8 offset-sm-2 mt-4">
        <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
            <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
            <form id="form_cambio_contrasena" novalidate="" class="ng-untouched ng-pristine ng-invalid">
                <div class="gform_body">
                    <div class="gform_page" id="gform_page_1_1">
                    <!---->
                    <h2 style="text-align:center" class="ng-star-inserted">Cambio de contraseña</h2>                    <!---->
                    <div class="gform_page_fields">
                        <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                            <div class="row">
                                <div class="col-sm-12">
                                    <li>
                                        <div class="ginput_container ginput_container_text">
                                            <input
                                                aria-invalid="false"
                                                aria-required="true"
                                                class="medium"
                                                id="contrasena"
                                                name="contrasena"
                                                placeholder="Nueva contraseña"
                                                required=""
                                                type="password"
                                                pattern=""
                                                value=""
                                            />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                    </li>
                                    <li>
                                        <div class="ginput_container ginput_container_text">
                                            <input
                                                aria-invalid="false"
                                                aria-required="true"
                                                class="medium"
                                                id="contrasena_repeat"
                                                name="contrasena_repeat"
                                                placeholder="Repetir contraseña"
                                                required=""
                                                type="password"
                                                pattern=""
                                                value=""
                                            />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                    </li>
                                </div>
                            </div>
                        </ul>
                    </div>
                    <div class="gform_page_footer">
                        <div class="row mt-3">
                            <div class="col-sm-6"><a class="gform_next_button button" id="btn_continuar" style="text-align:center;"> Cambiar contraseña &gt;&gt;</a></div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(){
        $('#btn_continuar').on('click', function(){
            var form = $( "#form_cambio_contrasena" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form_cambio_contrasena').serialize();
            if (form.valid()) {
                if ($('#contrasena').val() === $('#contrasena_repeat').val()){
                    $('#modal_loading').modal('show');
                    $.ajax({
                        type:'POST',
                        url:"{{ route('contrasena.cambiar') }}",
                        data: formData,
                        success:function(data){
                            window.location.replace("{{route('perfil')}}");
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            if (XMLHttpRequest.status == 403) {
                                rmse('Error', XMLHttpRequest.responseJSON.message);
                            }else{
                                rmse('Error', 'Ocurrió un error, intente mas tarde');
                            }
                        }   
                    });
                }else{
                    swal({
                        title: "Lo sentimos",
                        text: "Las contraseñas no coinciden. Intente de nuevo.",
                        icon: "error",
                        button: "Entendido",
                    });
                }
            }
        });
    });
</script>
@endsection