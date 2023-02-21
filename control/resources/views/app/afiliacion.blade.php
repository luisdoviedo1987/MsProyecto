@extends('app.layout.master')

@section('css')
<style>
    .text-bottom-center {
        position: absolute;
        bottom: 17%;
        left: 37%;
        font-size: 30px;
        color: #ffffff;
        font-weight: 900;
    }

    @media screen and (max-width: 575px){
        .text-bottom-center {
            position: absolute;
            bottom: 15%;
            left: 30%;
            font-size: 30px;
            color: #ffffff;
            font-weight: 900;
        }
    }
</style>

@endsection

@section('content')
<div  class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div  class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <form  id="form_afiliado" class="ng-untouched ng-valid ng-dirty">
        {{ csrf_field() }}
        <div  class="gform_body">
            <div  class="gform_page" id="gform_page_1_1">
                <h2>Datos del Titular</h2>
                <p>En esta sección podrá modificar sus datos como titular del Plan Médico Prepagado.</p>

                <div class="row mt-2 mb-2">
                    <div class="col-sm-6 offset-sm-3 col-xs-12">
                        @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                            <a class="gform_next_button button" id="titular" style="cursor: pointer; text-align: center; font-size: 15px !important;" nombre="{{ $data->getData()->nombre }}" ben="{{ $data->getData()->NumeroBeneficiaro }}">
                                <div id="qrtitularimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate($data->getData()->NumeroBeneficiaro); !!}</div>
                                Ver mí carnet virtual
                            </a>
                        @else
                            <a class="gform_next_button button" id="titular" style="cursor: pointer; text-align: center; font-size: 15px !important;" nombre="{{$data->getData()->nombre}}" ben="{{$data->getData()->cli}}">
                                <div id="qrtitularimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate($data->getData()->cli); !!}</div>
                                Ver mí carnet virtual
                            </a>
                        @endif
                            
                    </div>
                </div>

                <div class="gform_page_fields">
                    <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                        <div class="row">
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-pristine ng-valid ng-touched" id="tipoid" name="tipoid" required="" disabled>
                                            <option hidden="true" value="0">Elegí tu tipo de identificación</option>
                                            <option value="1" {{ $data->getData()->tipoId == 1 ? 'selected="selected"' : '' }}>Cédula Nacional</option>
                                            <option value="2" {{ $data->getData()->tipoId == 2 ? 'selected="selected"' : '' }}>Cédula Residente (DIMEX)</option>
                                            <option value="3" {{ $data->getData()->tipoId == 3 ? 'selected="selected"' : '' }}>Pasaporte</option>
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
                                            type="text"
                                            value="{{$data->getData()->persona_cedula}}"
                                            disabled
                                        />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="nombre" name="nombre" placeholder="Nombre" required="" type="text" value="{{$data->getData()->nombre}}" disabled />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                @if ($data->getData()->apellido1 != '')
                                    <li>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium" id="apellido1" name="apellido1" placeholder="Primer apellido" required="" type="text" value="{{$data->getData()->apellido1}}" disabled />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                    </li>
                                @endif
                                @if ($data->getData()->apellido2 != '')
                                    <li>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium" id="apellido2" name="apellido2" placeholder="Segundo apellido" required="" type="text" value="{{$data->getData()->apellido2}}" disabled />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                    </li>
                                @endif
                                <li>
                                    <div class="ginput_container ginput_container_date mt-4">
                                        <label for="fecha_nac" style="display: block !important; color: #73d8d0 !important; font-size: 16px; font-family: 'Roboto', sans-serif !important;">Fecha de Nacimiento :</label>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium" id="datepicker" name="datepicker" placeholder="dd-MM-yyyy" required="" type="text" value="{{$data->getData()->fecha_nac}}" disabled />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="genero" name="genero" required="" disabled>
                                            <option hidden="" value="">Género</option>
                                            <option value="Masculino" {{ $data->getData()->genero == "Masculino" ? 'selected' : '' }}>Hombre</option>
                                            <option value="Femenino" {{ $data->getData()->genero == "Femenino" ? 'selected' : '' }}>Mujer</option>
                                        </select>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input
                                            class="medium"
                                            id="telefono"
                                            mask="0000-0000"
                                            name="telefono"
                                            placeholder="Teléfono 1"
                                            required=""
                                            pattern=".{8,8}"
                                            prefix="(+506) "
                                            type="text"
                                            value="{{ $data->getData()->telefono }}"
                                            {{(isset($data->getData()->afiliado) && !$data->getData()->afiliado) ? 'disabled' : ''}}
                                        />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                            </div>
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_email">
                                        <input aria-invalid="false" aria-required="true" class="medium" id="email" name="email" placeholder="Email" required="" type="text" value="{{ $data->getData()->email }}" {{(isset($data->getData()->afiliado) && !$data->getData()->afiliado) ? 'disabled' : ''}}/>
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
                            <a class="gform_next_button button submit" style="cursor: pointer; text-align: center; pointer-events: auto;">GUARDAR &gt;&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@if (isset($promocion))
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="promocionModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content bd-0 bg-transparent rounded overflow-hidden">
                <div class="modal-body p-0">
                    <button aria-label="Close" class="close" data-dismiss="modal" style="position: absolute;top: 0px;right: 0px;border-bottom: 0px solid #73d8d0 !important;" type="button">x</button>
                    <img src="{{ asset('control/images/popup-oct.jpg')}}" style="width:100%" usemap="#image_map">
                    <div class="text-bottom-center">{{$promocion->codigo}}</div>
                    <map name="image_map">
                        <area alt="" title="" href="{{route('beneficiario')}}" coords="55,271,446,333" shape="rect">
                    </map>
                </div>
            </div>
        </div>
    </div>
@endif

<app-carnet >
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="carnetModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content bd-0 bg-transparent rounded overflow-hidden">
                <div class="modal-body p-0">
                    <div class="card" id="badge-content">
                        <div class="card-img-top view view-first" style="background-color: #789656;">
                            <div _ngcontent-xum-c18="">
                                <button aria-label="Close" class="close" data-dismiss="modal" style="margin-right: 8px; margin-top: 8px; right: 0; top: 0;" type="button">x</button>
                            </div>
                            <br />
                            <div class="row" style="margin: 0; width: 100%;">
                                <div class="col-sm-12" style="text-align: center;">
                                    <div class="text-white fontbold" style="font-size: 26px;">Carnet Virtual</div>
                                    <div class="col-sm-6 offset-sm-3" style="margin-top: 10px; margin-bottom: 10px;">
                                        <qrcode id="qrcode" title="1">
                                            
                                        </qrcode>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="text-align: center;"><img alt="" class="" id="medismart-logo-badge" src="https://medismart.net/control/assets/images/logo01.png" style="width: 80%;" /></div>
                        </div>
                        <div class="card-body" style="background-color: #003749; padding: 0;">
                            <div class="card-title text-white fontbold ml-4 mt-3" id="name-badge" style="font-size: 18px;"></div>
                            <!----><!---->
                            <div class="card-text text-white fontlight ng-star-inserted ml-4" id="type-badge" style="margin-top: -13px; font-size: 12px;">Beneficiario</div>
                            <div class="card-title text-white fontnormal ml-4" id="cli-badge">1</div>
                            <div class="card-text text-white fontlight" id="status-badge" style="margin-top: -13px; font-size: 12px;"></div>
                            <div class="card-text" style="margin-top: 20px;">
                                <div style="text-align: center;">
                                    <div class="card-text text-white fontlight">
                                        www.medismart.net<br />
                                        <div hidden="" id="btn-save-badge-div">
                                            <button
                                                _ngcontent-xum-c18=""
                                                class="btn btn-wd btn-warning ladda-button m-t-10 text-white"
                                                data-spinner-color="#FFF"
                                                data-style="zoom-in"
                                                id="btn-save-badge"
                                                style="margin-top: -5px;"
                                                type="button"
                                            >
                                                <span class="ladda-label">Guardar</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                                                <div class="ladda-progress" style="width: 140px;"></div>
                                            </button>
                                            <br />
                                        </div>
                                        <span class="fontlight" id="id-ios-banner" style="margin-top: -5px; font-size: 12px;"> Por favor tome una captura de pantalla y guárdela en su dispositivo </span>
                                    </div>
                                    <div style="text-align: center;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</app-carnet>
@endsection

@section('js')
<script src="{{ asset('control/js/imageMapResizer.min.js')}}"></script>
<script>
    $( document ).ready(function() {
        $( "#datepicker" ).datepicker({
            dateFormat: 'yyyy-MM-dd'
        });

        $("#provincia").on('change', function() {
            $('#distrito').html('');
            $('#distrito').append('<option value="0" selected>DISTRITO</option>');
            $('#distrito').prop('disabled', 'disabled');

            $('#canton').html('');
            $('#canton').append('<option value="0" selected>CANTON</option>');
            var url = "{{ route('api.cantones', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                });
            }); 
        });

        $("#canton").on('change', function() {
            $('#distrito').html('');
            if ($(this).children("option:selected").val() != 0) {
                $('#distrito').prop('disabled', false);
            }

            $('#distrito').append('<option value="0" selected>DISTRITO</option>');
            var url = "{{ route('api.distritos', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                });
            }); 
        });

        $.get("{{ route('api.provincias') }}", function(data, status){
            $.each(data, function( index, value ) {
                if (value.CODIGOPROVINCIA == {{ isset($data->getData()->provincia) ? $data->getData()->provincia : 0 }} ) {
                    $('#provincia').append('<option value="'+value.CODIGOPROVINCIA+'" selected>'+value.NAME+'</option>'); 
                }else{
                    $('#provincia').append('<option value="'+value.CODIGOPROVINCIA+'" >'+value.NAME+'</option>'); 
                }
            });
        });

        $.get("{{ route('api.cantones', ['distelec' => $data->getData()->provincia]) }}", function(data, status){
            $.each(data, function( index, value ) {
                if (value.CODIGOCANTON_C == {{ isset($data->getData()->canton) ? $data->getData()->canton : 0 }} ) {
                    $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                }else{
                    $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                }
            });
        });

        $.get("{{ route('api.distritos', ['distelec' => $data->getData()->canton]) }}", function(data, status){
            $.each(data, function( index, value ) {
                if (value.CODIGODISTRITO_C == {{ isset($data->getData()->distrito) ? $data->getData()->distrito : 0 }} ) {
                    $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                }else{
                    $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                }
            });
        });

        $('.submit').on('click', function(){
            var formData = $('#form_afiliado').serialize();
            var form = $( "#form_afiliado" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form_afiliado').serialize();
            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ (isset($data->getData()->afiliado) && !$data->getData()->afiliado) ? route('beneficiario.actualizar') : route('afiliado.actualizar') }}",
                    data:formData,
                    success:function(data){
                        if (data.code == "201" || data.code == "200") {
                            rmss(false,"Excelente","Los datos han sido actualizados exitosamente",null,null);
                        }else{
                            rmse("Error","Ha ocurrido un error, vuelva a intentarlo mas tarde");
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        rmse("Error","Ha ocurrido un error, vuelva a intentarlo mas tarde");
                    }   
                });
            }
        });

        $(".abrirmodal").on('click', function() {
            $('#qrcode').html($(this).children('#qrbeneimage').html());
            $('#name-badge').html($(this).attr('nombre'));
            $('#cli-badge').html($(this).attr('ben'));
            $('#carnetModal').modal('show');
        });
        
        $("#titular").on('click', function() {
            $('#qrcode').html($(this).children('#qrtitularimage').html());
            $('#name-badge').html($(this).attr('nombre'));
            $('#cli-badge').html($(this).attr('ben'));
            $('#carnetModal').modal('show');
        });
        
    });

    
</script>

@if (isset($promocion))
    <script>
        $( document ).ready(function() {
            if ({{$configuracion->valor_configuracion}} == 1){
                $('#promocionModal').modal('show');
            }

            $('map').imageMapResize();
        });
    </script>
@endif
@endsection