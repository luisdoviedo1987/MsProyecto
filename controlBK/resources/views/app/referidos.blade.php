@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <div class="gform_body" style="background-color: rgba(255, 255, 255, 0.7);">
        <div class="gform_page" id="gform_page_1_1">
            <h2>Datos de referidos</h2>
            <p>Utilizá esta sección para ganar puntos refiriendo a personas que les interese MediSmart. ¡Entre más personas referidas y afiliadas, más puntos ganarás!</p>
            <div class="gform_page_fields">
                <form id="form_referido">
                    <p>Podés también completar los datos del referido para ahorrar tiempo y asistir a tu contacto:</p>
                    <ul class="gform_fields top_label form_sublabel_below description_below" style="padding: 0px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="nombre" name="nombre" placeholder="Nombre *" required="" type="text" value="" />
                                        <!---->
                                        <span class="icon iconPencil"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="apellido1" name="apellido1" placeholder="Primer Apellido *" required="" type="text" value="" />
                                        <!---->
                                        <span class="icon iconPencil"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="apellido2" name="apellido2" placeholder="Segundo Apellido" type="text" value="" />
                                        <!---->
                                        <span class="icon iconPencil"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="email" name="email" placeholder="Correo electrónico" type="text" value="" />
                                        <!---->
                                        <span class="icon iconPencil"></span>
                                    </div>
                                </li>
                            </div>
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="cedula" name="cedula" placeholder="Nº de Cédula *" required="" type="text" value="" />
                                        <!---->
                                        <span class="icon iconPencil"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="telefono" mask="0000-0000" name="telefono" placeholder="Nº de Teléfono *" required="" type="text" value="" />
                                        <!---->
                                        <span class="icon iconPencil"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="parentesco" name="parentesco">
                                            <option value="Conyugue">Conyugue</option>
                                            <option value="Cunado(a)">Cuñado(a)</option>
                                            <option value="Esposo(a)">Esposo(a)</option>
                                            <option value="Hijo(a)">Hijo(a)</option>
                                            <option value="Padre">Padre</option>
                                            <option value="Madre">Madre</option>
                                            <option value="Hermano(a)">Hermano(a)</option>
                                            <option value="Abuelo(a)">Abuelo(a)</option>
                                            <option value="Tio(a)">Tio(a)</option>
                                            <option value="Nieto(a)">Nieto(a)</option>
                                            <option value="Sobrino(a)">Sobrino(a)</option>
                                            <option value="Pareja">Pareja</option>
                                            <option value="Primo(a)">Primo(a)</option>
                                            <option value="Amigo(a)">Amigo(a)</option>
                                            <option value="Suegro(a)">Suegro(a)</option>
                                            <option value="Novio(a)">Novio(a)</option>
                                            <option value="Yerno">Yerno</option>
                                            <option value="Nuera">Nuera</option>
                                            <option value="Otra Relacion" selected>Otra Relacion</option>
                                        </select>
                                        <!---->
                                    </div>
                                </li>
                            </div>
                        </div>
                    </ul>
                </form>
            </div>
            <div class="gform_page_footer">
                <div class="row">
                    <div class="col-sm-6 offset-sm-6">
                        <a class="gform_next_button button mt-2" id="generar_referido" style="cursor: pointer; text-align: center; pointer-events: auto; font-size:13px !important">CONTINUAR &gt;&gt;</a>
                    </div>
                </div>
            </div>
            <!---->
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#generar_referido').on('click', function(){
                var formData = $('#form_referido').serialize();
                var form = $( "#form_referido" );
                form.validate({
                    errorClass: 'ng-invalid',
                });
                var formData = $('#form_referido').serialize();
                if (form.valid()) {
                    $('.bd-loading-modal-lg').modal('show');
                    $.ajax({
                        type:'POST',
                        url:"{{ route('referidos.guardar') }}",
                        data:formData,
                        success:function(data){
                            window.location.replace("{{route('consulta.referidos', ['code' => '1'])}}");
                            // rmss(false,"Excelente","Referencia creada, ¡Corre y notificale para ganar premios!",null,null);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            if (XMLHttpRequest.responseJSON.message != "undefined" && XMLHttpRequest.responseJSON.message != null){
                                rmse("Error",XMLHttpRequest.responseJSON.message);
                            }else{
                                rmse("Error","Ha ocurrido un error, vuelva a intentarlo mas tarde");
                            }
                        }   
                    });
                }
            });

            //buscar por cedula
            $('#cedula').keyup(function () {
                if ($(this).val().length > 5) {

                    $.ajax({
                        type:'POST',
                        url:"{{ route('buscar.cedula') }}",
                        data:{'cedula':$(this).val()},
                        success:function(data){
                            var d = JSON.parse(data);
                            $.each(d.records, function( index, value ) {
                                if(value.found == "yes") {
                                    $('#nombre').val(value.nombre);
                                    $('#apellido1').val(value.apellido1);
                                    $('#apellido2').val(value.apellido2);
                                }
                            });
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            
                        }   
                    });
                }
            });
        });
    </script>
@endsection