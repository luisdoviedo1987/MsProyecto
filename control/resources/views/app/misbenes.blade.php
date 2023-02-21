@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <div class="gform_body" style="background-color: rgba(255, 255, 255, 0.7);">
        <div class="gform_page" id="gform_page_1_1">
            <h2 >Mis beneficiarios</h2>
            <p >Conocé acá los beneficiarios que están en tu plan.</p>
            <table class="table" style="font-size: 18px; margin: 0;" width="595">
                <tbody>
                    <tr>
                        <td style="width: 60%; background-color: #0f93d2; color: white;">Nombre</td>
                        <td style="width: 20%; background-color: #0f93d2; color: white;">Modificar</td>
                        <td style="width: 20%; background-color: #0f93d2; color: white;">Eliminar</td>
                    </tr>
                    @foreach ($data->getData()->beneficiarios as $beneficiario)
                        @if($beneficiario->estadoBeneficiario == 'Activo')
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
                                <td style="border-top: none;" class="ng-star-inserted">
                                    <a class="col-12 col-md-4 confirm-delete-show-md" beneficiario="{{ json_encode($beneficiario) }}"><span class="iconTable iconTrash confirm-delete-show-md" beneficiario="{{ json_encode($beneficiario) }}" style="color: black; margin: 0;"></span></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

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
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="tipoId" name="tipoId" required="">
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
                                            aria-invalid="false"
                                            aria-required="true"
                                            class="medium"
                                            id="cedula"
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
                                        <input aria-invalid="false" aria-required="true" class="medium" id="nombre" name="nombre" placeholder="Nombre" required="" type="text" value="" />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_date mt-4">
                                        <label for="fecha_nac" style="display: block !important; color: #73d8d0 !important; font-size: 16px; font-family: 'Roboto', sans-serif !important;">Fecha de Nacimiento :</label>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium" id="datepicker" name="fechanacimiento" placeholder="dd-MM-yyyy" required="" type="text" value="" />
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
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine ng-valid" id="provincia" name="provincia" required="">
                                            <option hidden="selected" selected="selected" value="0">PROVINCIA</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine" id="canton" name="canton" required="">
                                            <option hidden="selected" selected="selected" value="0">Cantón</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine" id="distrito" name="distrito" required="">
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
</div>

@endsection

@section('js')
<script>
    $( document ).ready(function() {
        $( function() {
            $( "#datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate : '-18y'
            });
        });

        $("#provincia").on('change', function(event, canton, distrito) {
            $('#distrito').html('');
            $('#distrito').append('<option value="0" selected>DISTRITO</option>');
            $('#distrito').prop('disabled', 'disabled');

            $('#canton').html('');
            $('#canton').append('<option value="0" selected>CANTON</option>');
            var url = "{{ route('api.cantones', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (canton !== undefined && value.CODIGOCANTON_C == canton ) {
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                        $('#canton').trigger('change', distrito);
                    }else{
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            });
        });

        $("#canton").on('change', function(event, distrito) {
            $('#distrito').html('');
            if ($(this).children("option:selected").val() != 0) {
                $('#distrito').prop('disabled', false);
            }

            $('#distrito').append('<option value="0" selected>DISTRITO</option>');
            var url = "{{ route('api.distritos', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (distrito !== undefined && value.CODIGODISTRITO_C == distrito ) {
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                    }else{
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            }); 
        });

        $.get("{{ route('api.provincias') }}", function(data, status){
            $.each(data, function( index, value ) {
                $('#provincia').append('<option value="'+value.CODIGOPROVINCIA+'" >'+value.NAME+'</option>'); 
            });
        });

        $('.modificar_beneficiario').click(function() {
            var beneficiario = JSON.parse($(this).attr("beneficiario"));
            $('#form_beneficiario').show();

            $("#tipoId option:selected").prop("selected",false);
            $("#tipoId option[value=" + beneficiario.tipoId + "]").prop("selected",true);
            $('#cedula').val(beneficiario.cedula);
            $('#nombre').val(beneficiario.nombre);
            $('#datepicker').val(beneficiario.fecha_nac);
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
            var formData = $('#form_beneficiario').serialize();
            var form = $( "#form_beneficiario" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form_beneficiario').serialize();
            if (form.valid()) {
                $('#modal_loading').modal('show');

                $.ajax({
                    type:'POST',
                    url:"{{ route('beneficiario.acciones') }}",
                    data:formData,
                    success:function(data){
                        rmss(false,"Excelente","Los datos han sido actualizados exitosamente",null,null);
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
                    if (XMLHttpRequest.responseJSON.message != "undefined" && XMLHttpRequest.responseJSON.message != null){
                        rmse("Error",XMLHttpRequest.responseJSON.message);
                    }else{
                        rmse("Error","Ha ocurrido un error, vuelva a intentarlo mas tarde");
                    }
                }   
            });
        });
    });
</script>
@endsection