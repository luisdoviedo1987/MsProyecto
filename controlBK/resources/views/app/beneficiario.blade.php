@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <div class="gform_body" style="background-color: rgba(255, 255, 255, 0.7);">
        <div class="gform_page" id="gform_page_1_1">
            <h2 >Agregá o modificá beneficiarios</h2>
            <p >Agregá o modificá en esta sección la familia o amigos que desees agregar a tu plan:</p>
            <table class="table" style="font-size: 18px; margin: 0;" width="595">
                <tbody>
                    <tr>
                        <td style="width: 60%; background-color: #0f93d2; color: white;">Nombre</td>
                        <td style="width: 20%; background-color: #0f93d2; color: white;">Modificar</td>
                        <td style="width: 20%; background-color: #0f93d2; color: white;">Estado</td>
                    </tr>
                    @foreach ($data->getData()->beneficiarios as $beneficiario)
                    @if ($beneficiario->estadoBeneficiario == "Activo" || $beneficiario->estadoBeneficiario == "Activo Titular Sin Cobertura")
                            <!---->
                            <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                <!---->
                                <td class="fixed-side ng-star-inserted" style="border-top: none;">{{$beneficiario->nombre}}</td>
                                <!---->
                                <td style="border-top: none;" class="ng-star-inserted">
                                    <a
                                        aria-selected="true"
                                        class="col-12 col-md-4 active modificar_beneficiario"
                                        id="modificar_beneficiario"
                                        beneficiario="{{ json_encode($beneficiario) }}"
                                    >
                                        <span class="iconTable iconPencilColor" style="color: black; margin: 0;"></span>
                                    </a>
                                </td>
                                <!---->
                                <td class="fixed-side ng-star-inserted" style="border-top: none;">{{$beneficiario->estadoBeneficiario}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="gform_page_footer mt-3">
        <div class="row">
            <div class="col-sm-5 offset-sm-7">
                <a class="gform_next_button button" id="agregar_beneficiario" style="cursor: pointer; text-align: center;">Agregar <span class="iconTable iconUserCog" style="margin: 0;"></span></a>
            </div>
        </div>
    </div>


    <!---->
    <form  id="form_beneficiario" novalidate="" class="ng-untouched ng-valid ng-dirty" style="display:none">
        {{ csrf_field() }}
        <input type="hidden" name="operacion" id="operacion" value="2">
        <input type="hidden" name="cli" id="cli" value="{{ $data->getData()->cli }}">
        <input type="hidden" name="ben" id="ben" value="">
        <div  class="gform_body">
            <div  class="gform_page mt-5" id="gform_page_1_1">
                <h2 >Datos del beneficiario</h2>
                <p >El estado actual de tu beneficiario es : <span  style="color: green; font-weight: bold !important;">Activo</span>.</p>
                <p >En esta sección podrá modificar los datos de tu beneficiario de tu Plan Médico Prepagado.</p>
                <div class="gform_page_fields">
                    <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                        <div class="row">
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="tipo_id" name="tipo_id" required="">
                                            <option hidden="true" value="0">Elegí tu tipo de identificación</option>
                                            <option value="1">Cédula Nacional</option>
                                            <option value="2">Cédula Residente (DIMEX)</option>
                                            <option value="3">Pasaporte</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input
                                            class="medium"
                                            id="cedula"
                                            name="cedula"
                                            placeholder="Número de identificación"
                                            required=""
                                            type="text"
                                            value="" 
                                        />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="nombre" name="nombre" placeholder="Nombre" required="" type="text" value=""  />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_date mt-4">
                                        <label for="fecha_nac" style="display: block !important; color: #73d8d0 !important; font-size: 16px; font-family: 'Roboto', sans-serif !important;">Fecha de Nacimiento :</label>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium" id="fechanacimiento" name="fechanacimiento" placeholder="yyyy-MM-dd" required="" type="text" value="" />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="genero" name="genero" required="" >
                                            <option hidden="" value="">Género</option>
                                            <option value="Masculino">Hombre</option>
                                            <option value="Femenino">Mujer</option>
                                        </select>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input
                                            aria-invalid="false"
                                            aria-required="true"
                                            class="medium"
                                            id="telefono"
                                            mask="0000-0000"
                                            name="telefono"
                                            placeholder="Teléfono 1"
                                            required=""
                                            type="text"
                                            value=""
                                        />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                            </div>
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_email">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="email" name="email" placeholder="Email" required="" type="text" value="" />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <div class="form-html-one mt-4" >DIRECCIÓN*</div>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine ng-valid provincias" id="provincia" name="provincia" required="">
                                            <option hidden="selected" selected="selected" value="0">PROVINCIA</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine cantones" id="canton" name="canton" required="">
                                            <option hidden="selected" selected="selected" value="0">Cantón</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine distritos" id="distrito" name="distrito" required="">
                                            <option hidden="selected" selected="selected" value="0">Distrito</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </ul>
                </div>

                <div  class="gform_page_footer">
                    <div  class="row">
                        <div  class="col-sm-5 offset-sm-7">
                            <a  class="gform_next_button button" id="guardar_beneficiario" style="cursor: pointer; text-align: center; pointer-events: auto;">GUARDAR &gt;&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!---->


    <!---->
    <form  id="form_beneficiario_insert" novalidate="" class="ng-untouched ng-valid ng-dirty" style="display:none">
        {{ csrf_field() }}
        <input type="hidden" name="operacion" id="operacion" value="1">
        <input type="hidden" name="cli" id="cli" value="{{ $data->getData()->cli }}">
        <input type="hidden" name="ben" id="ben" value="">
        <div  class="gform_body">
            <div  class="gform_page mt-5" id="gform_page_1_1">
                <h2 >Datos del beneficiario</h2>
                <p >En esta sección podrá agregar los datos de tu nuevo beneficiario a tu Plan Médico Prepagado.</p>
                <div class="gform_page_fields">
                    <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                        <div class="row">
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="tipo_id" name="tipoId" required="">
                                            <option disabled="" hidden="" selected="selected" value="">Elegí tu tipo de identificación</option>
                                            <option value="1">Cédula Nacional</option>
                                            <option value="2">Cédula Residente (DIMEX)</option>
                                            <option value="3">Pasaporte</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input
                                            aria-invalid="false"
                                            aria-required="true"
                                            class="medium"
                                            id="nueva_cedula"
                                            name="cedula"
                                            placeholder="Número de identificación"
                                            required=""
                                            type="text"
                                            pattern=""
                                            value=""
                                        />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="insert_nombre" name="nombre" placeholder="Nombre" required="" type="text" value=""  />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="insert_apellido1" name="apellido1" placeholder="Primer apellido" required="" type="text" value=""  />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="insert_apellido2" name="apellido2" placeholder="Segundo apellido" required="" type="text" value=""  />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_date mt-4">
                                        <label for="fecha_nac" style="display: block !important; color: #73d8d0 !important; font-size: 16px; font-family: 'Roboto', sans-serif !important;">Fecha de Nacimiento :</label>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium" id="insert_fechanacimiento" name="fechanacimiento" placeholder="yyyy-MM-dd" required="" type="text" value="" />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="insert_genero" name="genero" required="" >
                                            <option hidden="" value="">Género</option>
                                            <option value="Masculino">Hombre</option>
                                            <option value="Femenino">Mujer</option>
                                        </select>
                                        <!---->
                                    </div>
                                </li>
                            </div>
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input
                                            aria-invalid="false"
                                            aria-required="true"
                                            class="medium"
                                            id="insert_telefono"
                                            mask="0000-0000"
                                            name="telefono"
                                            placeholder="Teléfono"
                                            required=""
                                            type="text"
                                            value=""
                                        />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="insert_parentesco" name="parentesco" required="" >
                                            <option disabled="" hidden="" selected="selected" value="">Parentesco</option>
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
                                            <option value="Otra Relacion">Otra Relacion</option>
                                        </select>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_email">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="insert_email" name="email" placeholder="Email" required="" type="text" value="" />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <div class="form-html-one mt-4" >DIRECCIÓN*</div>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select provincias" id="insert_provincia" name="provincia" required="">
                                            <option disabled="" hidden="" selected="selected" value="">PROVINCIA</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select cantones" id="insert_canton" name="canton" required="">
                                            <option disabled="" hidden="" selected="selected" value="">CANTON</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select distritos" id="insert_distrito" name="distrito" required="">
                                            <option disabled="" hidden="" selected="selected" value="">DISTRITO</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                            </div>

                            <div class="col-sm-12" id="promocion">
                                <hr>
                                <div class="col-sm-6 pl-0">
                                    <li>
                                        <div class="ginput_container ginput_container_text">
                                            <input
                                                class="medium"
                                                id="codigo_promocion"
                                                name="codigo_promocion"
                                                placeholder="Código promoción"
                                                type="text"
                                                value=""
                                            />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                    </li>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>

                <div  class="gform_page_footer">
                    <div  class="row">
                        <div  class="col-sm-5 offset-sm-7">
                            @if (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual')
                                <a  class="gform_next_button button" id="guardar_nuevo_beneficiario" style="cursor: pointer; text-align: center; pointer-events: auto;">AGREGAR &gt;&gt;</a>
                            @else
                                <a  class="gform_next_button button" id="guardar_nuevo_beneficiario" style="cursor: pointer; text-align: center; pointer-events: auto;">AGREGAR AL CARRITO &gt;&gt;</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!---->
</div>

@endsection

@section('js')
<script>
    $( document ).ready(function() {
        $( "#fechanacimiento" ).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate : '-18y'
        });

        $( "#insert_fechanacimiento" ).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate : '-18y'
        });

        $(".provincias").on('change', function(event, canton, distrito) {
            $('#insert_distrito').html('');
            $('#insert_distrito').append('<option disabled="" hidden="" selected="selected" value="">DISTRITO</option>');
            $('#insert_distrito').prop('disabled', 'disabled');

            $('#distrito').html('');
            $('#distrito').append('<option disabled="" hidden="" selected="selected" value="">DISTRITO</option>');
            $('#distrito').prop('disabled', 'disabled');

            $('#insert_canton').html('');
            $('#insert_canton').append('<option disabled="" hidden="" selected="selected" value="">CANTON</option>');
            $('#canton').html('');
            $('#canton').append('<option disabled="" hidden="" selected="selected" value="">CANTON</option>');
            var url = "{{ route('api.cantones', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (canton !== undefined && (value.CODIGOCANTON_C == canton || value.NAME == canton) ) {
                        $('#insert_canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                        $('#insert_canton').trigger('change', distrito);
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                        $('#canton').trigger('change', distrito);
                    }else{
                        $('#insert_canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            });
        });

        $(".cantones").on('change', function(event, distrito) {
            $('#insert_distrito').html('');
            $('#distrito').html('');
            if ($(this).children("option:selected").val() != 0) {
                $('#insert_distrito').prop('disabled', false);
                $('#distrito').prop('disabled', false);
            }

            $('#insert_distrito').append('<option disabled="" hidden="" selected="selected" value="">DISTRITO</option>');
            $('#distrito').append('<option disabled="" hidden="" selected="selected" value="">DISTRITO</option>');
            var url = "{{ route('api.distritos', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (distrito !== undefined && (value.CODIGODISTRITO_C == distrito || value.NAME == distrito) ) {
                        $('#insert_distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                    }else{
                        $('#insert_distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            }); 
        });

        $.get("{{ route('api.provincias') }}", function(data, status){
            $.each(data, function( index, value ) {
                $('#insert_provincia').append('<option value="'+value.CODIGOPROVINCIA+'" name="' + value.NAME + '">'+value.NAME+'</option>'); 
                $('#provincia').append('<option value="'+value.CODIGOPROVINCIA+'" name="' + value.NAME + '">'+value.NAME+'</option>'); 
            });
        });

        $('.modificar_beneficiario').click(function() {
            var beneficiario = JSON.parse($(this).attr("beneficiario"));
            $('#form_beneficiario_insert').hide()
            $('#form_beneficiario').show()

            $("#tipo_id option:selected").prop("selected",false);
            $("#tipo_id option[value=" + beneficiario.tipoId + "]").prop("selected",true);
            $('#cedula').val(beneficiario.cedula);
            $('#nombre').val(beneficiario.nombre);
            $('#fechanacimiento').val(beneficiario.fecha_nac);
            $("#genero option:selected").prop("selected",false);
            $("#genero option[value=" + beneficiario.genero + "]").prop("selected",true);
            $('#telefono').val(beneficiario.telefono);
            $('#email').val(beneficiario.email);

            $("#provincia option:selected").prop("selected",false);
            $("#provincia option[value=" + beneficiario.provincia + "]").prop("selected",true);
            $("#provincia").trigger('change', [beneficiario.canton, beneficiario.distrito]);

            $('#ben').val(beneficiario.NumeroBeneficiaro);
        });

        $('#guardar_beneficiario').on('click', function(){
            $('#operacion').val("2");
            $('#modal_loading').modal('show');
            var form = $( "#form_beneficiario" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form_beneficiario').serialize();
            if (form.valid()) {
                $.ajax({
                    type:'POST',
                    url:"{{ route('beneficiario.acciones') }}",
                    data:formData,
                    success:function(data){
                        rmss(false,"Excelente","Los datos han sido actualizados exitosamente",null,null);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        rmse("Error!", "Ha ocurrido un error, intente mas tarde!.");
                    }   
                });
            }
        });

        $('#agregar_beneficiario').on('click', function(){
            $('#form_beneficiario_insert').show()
            $('#form_beneficiario').hide()
        })

        //buscar por cedula
        $('#nueva_cedula').keyup(function () {
            if ($(this).val().length > 5) {

                $.ajax({
                    type:'POST',
                    url:"{{ route('buscar.cedula') }}",
                    data:{'cedula':$(this).val()},
                    success:function(data){
                        var d = JSON.parse(data);
                        $.each(d.records, function( index, value ) {
                            if(value.found == "yes") {
                                $('#insert_nombre').val(value.nombre);
                                $('#insert_apellido1').val(value.apellido1);
                                $('#insert_apellido2').val(value.apellido2);

                                //fecha nacimiento
                                $("#insert_fechanacimiento").datepicker("setDate", value.fechaNacimiento);

                                //genero
                                var genero = (value.genero == 'M') ? 'Masculino' : 'Femenino';
                                $("#insert_genero option:selected").prop("selected",false);
                                $("#insert_genero option[value=" + genero + "]").prop("selected",true);

                                //provincia canton distrito
                                $("#insert_provincia option:selected").prop("selected",false);
                                $("#insert_provincia option[name='" + value.provincia + "']").prop("selected",true);
                                $(".provincias").trigger('change', [value.canton, value.distrito]);
                            }
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        
                    }   
                });
            }
        });

        $('#guardar_nuevo_beneficiario').on('click', function(){
            $('#operacion').val("1");

            @if (isset($promocion))
                if ({{$configuracion->valor_configuracion}} == 1){
                    if ($('#codigo_promocion').val() != "" && $('#codigo_promocion').val() != '{{$promocion->codigo}}'){
                        rmse("Error!", "El código de promoción no es correcto. Intente de nuevo.");
                        return;
                    }
                }
            @endif

            var form = $( "#form_beneficiario_insert" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form_beneficiario_insert').serialize();
            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('shoppingcart.agregar.beneficiario') }}",
                    data:formData,
                    success:function(data){
                        $('#form_beneficiario_insert')[0].reset();
                        @if (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual')

                            @if (isset($promocion))
                                if ({{$configuracion->valor_configuracion}} == 1){
                                    if ($('#codigo_promocion').val() != "" && $('#codigo_promocion').val() != '{{$promocion->codigo}}'){
                                    }else{
                                        rmss(false,"Agregado","Se agregó exitosamente el beneficiario. Su promoción será activada en las proximas 24 horas",null,null);
                                    }
                                }else{
                                    rmss(false,"Agregado","Se agregó exitosamente el beneficiario.",null,null);    
                                }
                            @else
                                rmss(false,"Agregado","Se agregó exitosamente el beneficiario.",null,null);
                            @endif

                            window.setTimeout(function(){location.reload()},3000)
                        @else
                            if (typeof(data.agregar) != "undefined" && data.agregar !== null) {
                                rmss(false,"Agregado","Se agregó exitosamente al carrito.","Ir al carrito",'{{ route("carrito") }}');
                            }else{
                                rmss(true,"Agregado","Se agregó exitosamente al carrito.","Ir al carrito",'{{ route("carrito") }}');
                            }
                        @endif
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        rmse("Error!", "Ha ocurrido un error, intente mas tarde!.");
                    }   
                });
            }
        });

        $('.confirm-delete-show-md').on('click',function(){
            tr = $(this).closest('tr');
            beneficiario = JSON.parse($(this).attr('beneficiario'));
            $('#confirm-delete').modal('show');
        });

        $('.btn-delete').click(function(e){
            e.preventDefault();
            $('.bd-loading-modal-lg').modal('show');
            $.ajax({
                type:'POST',
                url:"{{ route('beneficiario.acciones') }}",
                data: { 'operacion':3, 'cli': '{{$data->getData()->cli}}', 'benCedula': beneficiario.persona_cedula, 'ben' : beneficiario.NumeroBeneficiaro, 'tipoId': beneficiario.tipoId },
                success:function(data){
                    tr.remove();
                    rmss(false,"Eliminado","Se eliminó el beneficiario correctamente");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    rmse("Error!", "Ha ocurrido un error, intente mas tarde!.");
                }   
            });
        });
    });
</script>

@if (isset($promocion))
    <script>
        $( document ).ready(function() {
            
        });
    </script>
@endif
@endsection