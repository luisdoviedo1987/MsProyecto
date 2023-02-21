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
<div class="modal fade" id="repetidosModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Selecciona un usuario para continuar</h5>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                       <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th></th>
                       </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = 1;   
                        @endphp
                        @foreach ($repetidos as $repetido)
                            @foreach ($repetido as $usuario)
                                <tr>
                                    <th scope="row">{{ $usuario->cedula }}</th>
                                    <td>{{$usuario->nombre}}</td>
                                    <td> <a href="{{ route('perfil.usuario', ['usuario'=>$usuario->encryptId]) }}"> Usar </a> </td>
                                </tr>

                                @php
                                    $contador = $contador + 1;   
                                @endphp
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="accordion" class="mt-4">
    <div style="margin-bottom: 5px !important;">
        <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn collapsed" data-toggle="collapse" data-target="#perfil" aria-expanded="false" aria-controls="perfil">
                <h2 >Datos del titular</h2>
            </button>
        </h5>
        </div>

        <div id="perfil" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
            <div  class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
                <div  class="gform_anchor" id="gf_1" tabindex="-1"></div>
                <form  id="form_afiliado" class="ng-untouched ng-valid ng-dirty">
                    {{ csrf_field() }}
                    <div  class="gform_body">
                        <div  class="gform_page" id="gform_page_1_1">
                            @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                                <p >El estado actual de tu plan es : <span  style="color: green; font-weight: bold !important;">{{ isset($data->getData()->estadoTitular) ? $data->getData()->estadoTitular : '' }}</span>.</p>
                                <p >Conocé y de ser necesario modificá en esta sección los datos personales del titular:</p>
                            @else
                                <h2>Datos del Titular</h2>
                                <p>En esta sección podrá modificar sus datos como titular del Plan Médico Prepagado.</p>
                            @endif

                            <div class="row mt-2 mb-2">
                                <div class="col-sm-6 offset-sm-3 col-xs-12">
                                    @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                                        <a class="gform_next_button button" id="titular" style="cursor: pointer; text-align: center; font-size: 15px !important;" nombre="{{ $data->getData()->nombre }}" ben="{{ $data->getData()->NumeroBeneficiaro }}" tipo="Beneficiario" Estado="Activo">
                                            <div id="qrtitularimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate( isset($data->getData()->NumeroBeneficiaro) ? $data->getData()->NumeroBeneficiaro : "00000" ); !!}</div>
                                            Ver mí carnet virtual
                                        </a>
                                    @elseif($data->getData()->estadoTitular != "Sin Cobertura")
                                        <a class="gform_next_button button" id="titular" style="cursor: pointer; text-align: center; font-size: 15px !important;" nombre="{{$data->getData()->nombre}}" ben="{{$data->getData()->cli}}" tipo="Titular" Estado="Activo" >
                                            <div id="qrtitularimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate(isset($data->getData()->cli) ? $data->getData()->cli  : "00000" ); !!}</div>
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
                                                    <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-pristine ng-valid ng-touched tipoIdTitular" id="tipoid" name="tipoid" required="" readonly="true" disabled>
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
                                                        readonly="true"
                                                        readonly
                                                    />
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_text">
                                                    <input aria-invalid="false" aria-required="true" class="medium" id="nombre" name="nombre" placeholder="Nombre" required="" type="text" value="{{$data->getData()->nombre}}" readonly="true" readonly/>
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                            @if ($data->getData()->apellido1 != '')
                                                <li>
                                                    <div class="ginput_container ginput_container_text">
                                                        <input aria-invalid="false" aria-required="true" class="medium" id="apellido1" name="apellido1" placeholder="Primer apellido" required="" type="text" value="{{$data->getData()->apellido1}}" readonly="true" readonly/>
                                                        <span class="icon iconPencil"></span>
                                                        <!---->
                                                    </div>
                                                </li>
                                            @endif
                                            @if ($data->getData()->apellido2 != '')
                                                <li>
                                                    <div class="ginput_container ginput_container_text">
                                                        <input aria-invalid="false" aria-required="true" class="medium" id="apellido2" name="apellido2" placeholder="Segundo apellido" required="" type="text" value="{{$data->getData()->apellido2}}" readonly="true" readonly/>
                                                        <span class="icon iconPencil"></span>
                                                        <!---->
                                                    </div>
                                                </li>
                                            @endif
                                            <li>
                                                <div class="ginput_container ginput_container_date mt-4">
                                                    <label for="fecha_nac" style="display: block !important; font-size: 16px; font-family: 'Roboto', sans-serif !important;">Fecha de Nacimiento :</label>
                                                    <div class="ginput_container ginput_container_text">
                                                        <input aria-invalid="false" aria-required="true" class="medium" id="datepicker" name="datepicker" placeholder="dd-MM-yyyy" required="" type="text" value="{{$data->getData()->fecha_nac}}" readonly="true" readonly/>
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
                                                        readonly
                                                    />
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                        </div>
                                        <div class="col-sm-6">
                                            <li>
                                                <div class="ginput_container ginput_container_email">
                                                    <input aria-invalid="false" aria-required="true" class="medium" id="email" name="email" placeholder="Email" required="" type="text" value="{{ $data->getData()->email }}" readonly/>
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
        </div>
        </div>
    </div>
    <div style="margin-bottom: 5px !important;">
        <div class="card-header" id="headingTwo">
        <h5 class="mb-0">
            <button class="btn collapsed" data-toggle="collapse" data-target="#beneficiarios" aria-expanded="false" aria-controls="beneficiarios">
                <h2 >Mis beneficiarios</h2>
            </button>
        </h5>
        </div>
        <div id="beneficiarios" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
            <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
                <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
                <div class="gform_body" style="background-color: rgba(255, 255, 255, 0.7);">
                    <div class="gform_page" id="gform_page_1_1">
                        <p >Conocé acá los beneficiarios que están en tu plan.</p>
                        <div class="table-responsive">
                            <table class="table" style="font-size: 18px; margin: 0;" width="595">
                                <tbody>
                                    <tr>
                                        <td style="width: 40%; background-color: #0f93d2; color: white;">Nombre</td>
                                        <td style="width: 20%; background-color: #0f93d2; color: white;">Tipo</td>
                                        <td style="width: 10%; background-color: #0f93d2; color: white;">Modificar</td>
                                        <td style="width: 20%; background-color: #0f93d2; color: white;">Estado</td>
                                        <td style="width: 10%; background-color: #0f93d2; color: white;">Carnet</td>
                                    </tr>
                                    @foreach ($data->getData()->beneficiarios as $beneficiario)
                                        @if( $beneficiario->estadoBeneficiario == 'Activo' || $beneficiario->estadoBeneficiario == 'Activo Titular Sin Cobertura' )
                                            <!---->
                                            <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                                <!---->
                                                <td class="fixed-side ng-star-inserted" style="border-top: none;">{{$beneficiario->nombre}}</td>
                                                <td class="fixed-side ng-star-inserted" style="border-top: none;">Beneficiario</td>
                                                <!---->
                                                <td style="border-top: none;" class="ng-star-inserted">
                                                    <a
                                                        aria-selected="true"
                                                        class="col-12 col-md-4 active modificar_beneficiario"
                                                        id="modificar_beneficiario"
                                                        beneficiario="{{ json_encode($beneficiario) }}"
                                                        style="cursor: pointer;"
                                                    >
                                                        <span class="iconTable iconPencilColor" style="color: black; margin: 0;"></span>
                                                    </a>
                                                </td>
                                                <td class="fixed-side ng-star-inserted" style="border-top: none;">{{$beneficiario->estadoBeneficiario}}</td>
                                                <td class="fixed-side ng-star-inserted" style="width: 30% !important; border-top: none;">
                                                    <!---->
                                                    @if (isset($beneficiario->NumeroBeneficiaro) && $beneficiario->NumeroBeneficiaro != "")
                                                        <a class="col-12 col-md-4 abrirmodal" nombre="{{$beneficiario->nombre}}" estado="Activo" tipo="Beneficiario" ben="{{$beneficiario->NumeroBeneficiaro}}" style="cursor: pointer;">
                                                            <div id="qrbeneimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate( isset($beneficiario->NumeroBeneficiaro) ?  $beneficiario->NumeroBeneficiaro : '000000' ); !!}</div>
                                                            <span class="iconTable iconCarnet" style="color: black; margin: 0;"></span>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($data->getData()->mascotas as $mascota)
                                        <!---->
                                        <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                            <td class="fixed-side" id="{{$mascota->idPet}}" style="border-top: none;">{{$mascota->nombre}}</td>
                                            <td class="fixed-side ng-star-inserted" style="border-top: none;">Mascota</td>
                                            <td style="border-top: none;">
                                                <a class="col-12 col-md-4 editar_mascota" id="editar_mascota" mascota="{{json_encode($mascota)}}" style="cursor: pointer;">
                                                    <span class="iconTable iconPencilColor" style="color: black; margin: 0;"></span>
                                                </a>
                                            </td>
                                            <td class="fixed-side ng-star-inserted" style="border-top: none;">Activo</td>
                                            <td class="fixed-side ng-star-inserted" style="width: 30% !important; border-top: none;">
                                                <!---->
                                                <a class="col-12 col-md-4 abrirmodal" nombre="{{$mascota->nombre}}"  estado="Activo"  tipo="Mascota"   ben="{{$mascota->numeroPet}}" style="cursor: pointer;">
                                                    <div id="qrbeneimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate(isset($mascota->numeroPet) ? $mascota->numeroPet : '000000' ); !!}</div>
                                                    <span class="iconTable iconCarnet" style="color: black; margin: 0;"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br />
                       <center> <p>Si desea eliminar alguno de sus beneficiarios, debe llamar al call center <a href="tel:+50625285400">2528-5400</a></p> </center>
                    </div>
                </div>
                <!---->
                <form  id="form_beneficiario" novalidate="" class="ng-untouched ng-valid ng-dirty" style="display:none">
                    {{ csrf_field() }}
                    <input type="hidden" name="operacion" id="bene_operacion" value="2">
                    <input type="hidden" name="cli" id="bene_cli" value="{{ $data->getData()->cli }}">
                    <input type="hidden" name="ben" id="bene_ben" value="">
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
                                                <input type="hidden" name="tipoId" id="bene_tipoId_send" />
                                                <div class="ginput_container ginput_container_select">
                                                    <select aria-invalid="false" aria-required="true" class="medium gfield_select tipoIdBeneficiario" id="bene_tipoId" name="tipoIdActno" required="" readonly="true" disabled>
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
                                                        id="bene_cedula"
                                                        name="cedula"
                                                        placeholder="Número de identificación"
                                                        required=""
                                                        type="text"
                                                        pattern=""
                                                        value=""
                                                        readonly
                                                    />
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_text">
                                                    <input aria-invalid="false" aria-required="true" class="medium" id="bene_nombre" name="nombre" placeholder="Nombre" required="" type="text" value=""  readonly="true" readonly/>
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_date mt-4">
                                                    <label for="fecha_nac" style="display: block !important; font-size: 16px; font-family: 'Roboto', sans-serif !important;">Fecha de Nacimiento :</label>
                                                    <div class="ginput_container ginput_container_text">
                                                        <input aria-invalid="false" aria-required="true" class="medium" id="bene_datepicker" name="fechanacimiento" placeholder="dd-MM-yyyy" required="" type="text" value="" />
                                                        <span class="icon iconPencil"></span>
                                                        <!---->
                                                    </div>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_select">
                                                    <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="bene_genero" name="genero" required="" disabled>
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
                                                        id="bene_telefono"
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
                                                    <input aria-invalid="false" aria-required="true" class="medium" id="bene_email" name="email" placeholder="Email" required="" type="text" value=""  readonly="true" readonly/>
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                            <div class="form-html-one mt-4" >DIRECCIÓN*</div>
                                            <li>
                                                <div class="ginput_container ginput_container_select">
                                                    <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine ng-valid" id="bene_provincia" name="provincia" required="">
                                                        <option hidden="selected" selected="selected" value="0">PROVINCIA</option>
                                                        <!---->
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_select">
                                                    <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine" id="bene_canton" name="canton" required="">
                                                        <option hidden="selected" selected="selected" value="0">Cantón</option>
                                                        <!---->
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_select">
                                                    <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine" id="bene_distrito" name="distrito" required="">
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

                <form id="form_editar_mascota" class="ng-untouched ng-pristine ng-valid ng-star-inserted" style="display:none">
                    <input type="hidden" name="operacion" id="e_operacion" value="1">
                    <input type="hidden" name="idmascota" id="e_idmascota" value="1">
                    <input type="hidden" name="cli" id="cli" value="{{ $data->getData()->cli }}">
                    <div class="gform_body">
                        <div class="gform_page" id="gform_page_1_1">
                            <h2>Datos de la mascota</h2>
                            <p>En esta sección podrá modificar/incluir los datos de la mascota a su Plan Médico Prepagado.</p>
                            <div class="gform_page_fields">
                                <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <li>
                                                <div class="ginput_container ginput_container_select">
                                                    <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="e_especie" name="especie" required="">
                                                        <option disabled="" hidden="selected" selected="selected" value="">Especie</option>
                                                        <option value="Perro">Perro</option>
                                                        <option value="Gato">Gato</option>
                                                    </select>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_text">
                                                    <input aria-invalid="false" aria-required="true" class="medium" id="e_raza" name="raza" placeholder="Raza" required="" type="text" value="" />
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_text">
                                                    <input aria-invalid="false" aria-required="true" class="medium" id="e_nombre" name="nombre" placeholder="Nombre" required="" type="text" value="" />
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                        </div>
                                        <div class="col-sm-6">
                                            <li>
                                                <div class="ginput_container ginput_container_text">
                                                    <input aria-invalid="false" aria-required="true" class="medium" id="e_edad" name="edad" placeholder="Edad" required="" type="text" value="" />
                                                    <span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_text">
                                                    <input aria-invalid="false" class="medium" id="e_color" name="color" placeholder="Color" required="" type="text" value="" /><span class="icon iconPencil"></span>
                                                    <!---->
                                                </div>
                                            </li>
                                            <li>
                                                <div class="ginput_container ginput_container_select">
                                                    <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="e_genero" name="genero" required="">
                                                        <option disabled="" hidden="" value="">Género</option>
                                                        <option value="F">Hembra</option>
                                                        <option value="M">Macho</option>
                                                    </select>
                                                    <!---->
                                                </div>
                                            </li>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                            <div class="gform_page_footer">
                                <div  class="row">
                                    <div  class="col-sm-5 offset-sm-7">
                                    <a class="gform_next_button button" id="btn_editar_mascota" style="cursor: pointer; text-align: center; pointer-events: auto;">EDITAR &gt;&gt;</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        </div>
    </div>
    <div style="margin-bottom: 5px !important;">
        <div class="card-header" id="headingThree">
        <h5 class="mb-0">
            <button class="btn collapsed" data-toggle="collapse" data-target="#tarjetas" aria-expanded="false" aria-controls="tarjetas">
                <h2>Información pagos</h2>
            </button>
        </h5>
        </div>
        <div id="tarjetas" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
        <div class="card-body">
            <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
                <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
                    <div class="gform_body">
                        <div class="gform_page" id="gform_page_1_1">
                            <p>Conocé la modalidad de tu plan y gestioná la tarjeta con la que se está pagando en forma recurrente.</p>
                            <div class="table-responsive">
                                <table style="font-size: 18px; text-align: center;">
                                    <tbody>
                                        <tr style="border-bottom: 1px solid #ed2980;">
                                            <td style="width: 20%; background-color: #0f93d2; color: white;">Tipo de cobertura</td>
                                            <td style="width: 20%; background-color: #0f93d2; color: white;">Forma de pago</td>
                                            <td class="collapsable" style="width: 10%; background-color: #0f93d2; color: white;">Día de cobro</td>
                                            <td style="width: 10%; background-color: #0f93d2; color: white;">Costo del plan</td>
                                            <td style="width: 10%; background-color: #0f93d2; color: white;">Frecuencia</td>
                                            <td class="collapsable" style="width: 20%; background-color: #0f93d2; color: white;">Estado del plan del cliente</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #ed2980;">
                                            <td>{{$data->getData()->tipoCobertura}}</td>
                                            <td>{{$data->getData()->formaPago}}</td>
                                            <td class="collapsable">{{$data->getData()->fechaPago}}</td>
                                            <td>${{$data->getData()->costoPlan}}</td>
                                            <td>{{$data->getData()->frecuenciaPago}}</td>
                                            <td class="collapsable">{{$data->getData()->estadoTitular}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <a
                                aria-controls="v-pills-agregar_beneficiario"
                                aria-selected="true"
                                class="col-12 col-md-10"
                                data-toggle="pill"
                                id="agregar_tarjeta"
                                style="cursor: pointer; background-color: none !important;"
                            >
                                <h3 style="color: #787878;">Agregar tarjeta <span class="iconTable iconCardColor" style="margin: 0;"></span></h3>
                               
                            </a> --}}
                            <br>
                            <div class="col-sm-5 mt-3">
                                <a class="gform_next_button button" id="agregar_tarjeta" style="cursor: pointer; text-align: center;margin-bottom:10px">Agregar tarjeta  <span class="iconTable iconCardColor" style="margin-left: 6px;"></span></a>
                            </div>
                            <div class="table-responsive">
                                <table style="font-size: 18px; text-align: center; width: 100% !important;">
                                    <tbody id="tbd-tarjetas">
                                        <tr style="border-bottom: 1px solid #ed2980;">
                                            <td style="background-color: #0f93d2; color: white;">Número de tarjeta</td>
                                            <td style="background-color: #0f93d2; color: white;">Tipo de tarjeta para pago</td>
                                            <!---->
                                            <td style="background-color: #0f93d2; color: white;" class="ng-star-inserted">Eliminar</td>
                                        </tr>
                                        @foreach ($data->getData()->tarjetas as $tarjeta) 
                                            <!---->
                                            <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                                <td>{{ $tarjeta->numeroTarjeta }}</td>
                                                <!----><!---->
                                                <td class="ng-star-inserted">{{ $tarjeta->principal == 1 ? 'Principal' : 'Secundaria' }}</td>
                                                <!---->
                                                <td class="ng-star-inserted">
                                                    <!---->
                                                    @if ($tarjeta->principal != 1)
                                                        <a style="cursor: pointer;" class="ng-star-inserted"><span tarjeta="{{ json_encode($tarjeta) }}" class="iconTable iconTrash deleteTarjeta"></span></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
<br>
                               <center> <p>*Para poder cambiar la tarjeta de la cual se hace el rebajo de su plan, debe agregar una segunda tarjeta primero y así poder realizar el cambio.</p><center>
                            </div>
                        </div>
                        <div class="gform_page" id="form_nueva_tarjeta" style="display:none">
                            <form id="tarjetaForm" class="ng-untouched ng-pristine ng-valid ng-star-inserted">
                                {{ csrf_field() }}
                                <input type="hidden" name="cli" value="{{ $data->getData()->cli }}" />
                                <div class="gform_body">
                                    <div class="gform_page" id="gform_page_1_1">
                                        <h2>Datos de la tarjeta</h2>
                                        <p>En esta sección podrá agregar una tarjeta a su Plan Médico Prepagado, MediSmart.</p>
                                        <div class="gform_page_fields">
                                            <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <li>
                                                            <div class="ginput_container ginput_container_text">
                                                                <input class="medium"
                                                                    id="numero"
                                                                    mask="0000-0000-0000-0000"
                                                                    name="numero"
                                                                    pattern=".{15,16}"
                                                                    placeholder="Numero de tarjeta"
                                                                    required=""
                                                                    type="text"
                                                                />
                                                                <span class="icon iconPencil"></span>
                                                                <!---->
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="ginput_container ginput_container_text">
                                                                <input class="medium"
                                                                    id="nombre"
                                                                    name="nombre"
                                                                    placeholder="Nombre del titular"
                                                                    required=""
                                                                    type="text"
                                                                />
                                                                <span class="icon iconPencil"></span>
                                                                <!---->
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="ginput_container ginput_container_select">
                                                                <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="tipo" name="tipo" required="">
                                                                    <option disabled="" hidden="" selected="" value="">Tipo de Tarjeta</option>
                                                                    <option value="Visa">Visa</option>
                                                                    <option value="Mastercard">Mastercard</option>
                                                                    <option value="Amex">Amex</option>
                                                                    <option value="Discover">Discover</option>
                                                                </select>
                                                                <!---->
                                                            </div>
                                                        </li>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-html-one" style="color: #73d8d0 !important;">FECHA DE VENCIMIENTO*</div>
                                                        <li>
                                                            <div class="container m-0 p-0">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-12 col-md-12 m-0">
                                                                        <div class="col-6 col-sm-6 col-md-6 m-0 p-0">
                                                                            <select id="mes" name="mes" placeholder="Fecha de vencimiento" required="" type="text">
                                                                                <option hidden="" value="">Mes</option>
                                                                                <option value="01">01</option>
                                                                                <option value="02">02</option>
                                                                                <option value="03">03</option>
                                                                                <option value="04">04</option>
                                                                                <option value="05">05</option>
                                                                                <option value="06">06</option>
                                                                                <option value="07">07</option>
                                                                                <option value="08">08</option>
                                                                                <option value="09">09</option>
                                                                                <option value="10">10</option>
                                                                                <option value="11">11</option>
                                                                                <option value="12">12</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-6 col-sm-6 col-md-6 m-0 p-0">
                                                                        <select id="ano" name="ano" required="" type="text">
                                                                            <option hidden="" value="">Año</option>
                                                                            <!---->
                                                                            @for ($i = 0; $i < 10; $i++)
                                                                                <option value="{{ date('Y', strtotime('+'.$i.' year')) }}" class="ng-star-inserted">{{ date('Y', strtotime('+'.$i.' year')) }}</option>
                                                                            @endfor
                                                                        </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="ginput_container ginput_container_text">
                                                                <input class="medium"
                                                                    id="principal"
                                                                    name="principal"
                                                                    style="font-size: inherit; font-weight: 400; position: absolute; left: 40%; top: 40%;"
                                                                    type="checkbox"
                                                                />
                                                                <!---->
                                                                <input aria-invalid="false" readonly="true" aria-required="true" class="medium" id="principal_add" name="principal_add" placeholder="Tarjeta seleccionada para cobro" type="text" value="" />
                                                            </div>
                                                        </li>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="gform_page_footer">
                                        <div class="row">
                                            <div class="col-sm-5 offset-sm-7"><a class="gform_next_button button mt-3" id="guardar_tarjeta" style="text-align: center;">GUARDAR &gt;&gt;</a></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
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
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content bd-0 bg-transparent rounded overflow-hidden">
                <div class="modal-body p-0">
                    <div class="card" id="badge-content">
                        <div class="card-img-top view view-first" style="background-color: #789656;">
                            <div><span  class="close" data-dismiss="modal" aria-label="Close"
                                    style="margin-right: 8px;margin-top:  8px;">
                                    <span aria-hidden="true">X</span>
                                </span></div>
                            <br>
                            <div>
                                <center>
                                    <div class="text-white fontbold" style="font-size: 26px;margin-left:  20px">Carnet Virtual</div>
                                        <qrcode id="qrcode" title="1" height="70px"
                                        style="margin-top: 15px;margin-bottom: 25px">
                                        </qrcode>
                                        <br><br>
                                </center>
                            </div>
                        </div>
                        <div class="card-body">
                            <center>
                             <div style="text-align: center;"><img alt="" class="" id="medismart-logo-badge" src="https://medismart.net/control/images/cropped-logomedismart-11-300x131-2.png" style="width: 80%;" /></div>

                               
                            </center>
                        </div>
                        <div class="card-body" style="background-color: #003749;">
                            <div class="card-title text-white fontbold" id="name-badge" style="font-size: 18px"></div>
                            <div class="card-title text-white fontbold" id="status-badge" style="font-size: 12px">{{ isset($data->getData()->estadoTitular) ? $data->getData()->estadoTitular : '' }}</div>
                            <div class="card-text text-white fontlight" style="margin-top: -13px ;font-size: 12px" id="type-badge"></div>
                            <div class="card-title text-white fontnormal" id="cli-badge"></div>
                            <br>
                            @php
                            $timezone  = -6;
                            $fechaAcutual = gmdate("Y-m-d", time() + 3600*($timezone+date("I")));
                            @endphp
                            <div class="card-title text-white fontlight" style="margin-top: -13px ;font-size: 12px" id="date-badge">Fecha generado: {{ $fechaAcutual }}</div>
                            <div class="card-text" style="margin-top: 10px ">
                                <center>
                                    <div class="card-text text-white fontlight"><small>www.medismart.net<small><br><br>

                                        <div id="btn-save-badge-div"> <button type="button" id="btn-save-badge"
                                                class="btn btn-wd btn-warning ladda-button m-t-10 text-white" 
                                                data-style="zoom-in" data-spinner-color="#FFF" style="border-bottom:0px solid #73d8d0!important">
                                                <span class="ladda-label">Guardar</span>
                                                <span class="ladda-spinner"></span>
                                                <span class="ladda-spinner"></span>
                                                <div class="ladda-progress" style="width: 140px;">

                                                </div>
                                            </button><br></div>
                                        <span class="fontlight" style="margin-top: -5px;font-size: 12px"
                                            id="id-ios-banner"></span>

                                    </div>


                                    <center>
                                        </p>
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
<script src="{{ asset('control/js/html2canvas.min.js')}}"></script>
<script src="{{ asset('control/js/canvas2image.js')}}"></script>
<script src="{{ asset('control/js/jquery.quickfit.js')}}"></script>
<script>
    var telno = /^\d{8}$/;
    var cedno = /^[0-9]{9}$/;
    var dimex = /^[0-9]{11}$|^[0-9]{12}$/;

    function validarTelefonoID(id, tipoId, telefono){
        if (tipoId == 1 && !cedno.test(id)){
            rmse("Error","El número de cédula no tiene el formato correcto.");
            return false;
        }

        if (tipoId == 2 && !dimex.test(id)){
            rmse("Error","El número DIMEX no tiene el formato correcto.");
            return false;
        }

        if (!telno.test(telefono)){
            rmse("Error","El número de teléfono no tiene el formato correcto. Debe ser de 8 dígitos sin guiones.");
            return false;
        }

        if (telefono.charAt(0) != 8 && telefono.charAt(0) != 7 && telefono.charAt(0) != 2 && telefono.charAt(0) != 6 && telefono.charAt(0) != 5) {
            rmse("Error","El número de teléfono debe de ser un teléfono válido.");
            return false;
        }

        return true;
    }

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
                    $('#bene_provincia').append('<option value="'+value.CODIGOPROVINCIA+'" selected>'+value.NAME+'</option>'); 
                }else{
                    $('#provincia').append('<option value="'+value.CODIGOPROVINCIA+'" >'+value.NAME+'</option>'); 
                    $('#bene_provincia').append('<option value="'+value.CODIGOPROVINCIA+'" selected>'+value.NAME+'</option>'); 
                }
            });
        });

        $.get("{{ route('api.cantones', ['distelec' => $data->getData()->provincia]) }}", function(data, status){
            $.each(data, function( index, value ) {
                if (value.CODIGOCANTON_C == {{ isset($data->getData()->canton) ? $data->getData()->canton : 0 }} ) {
                    $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                    $('#bene_canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                }else{
                    $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                    $('#bene_canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                }
            });
        });

        $.get("{{ route('api.distritos', ['distelec' => $data->getData()->canton]) }}", function(data, status){
            $.each(data, function( index, value ) {
                if (value.CODIGODISTRITO_C == {{ isset($data->getData()->distrito) ? $data->getData()->distrito : 0 }} ) {
                    $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                    $('#bene_distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                }else{
                    $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                    $('#bene_distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
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
            if (form.valid()  && validarTelefonoID($('#cedula').val(),$('.tipoIdTitular').val(),$('#telefono').val())) {
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

        @if(isset($totalRepetidos) && $totalRepetidos >= 2)
            $('#repetidosModal').modal('show');
        @endif
        
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

<script>
    function saveAs(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download === 'string') {
            link.href = uri;
            link.download = filename;
            //Firefox requires the link to be in the body
            document.body.appendChild(link);
            //simulate click
            link.click();
            //remove the link when done
            document.body.removeChild(link);
        } else {
            window.open(uri);
        }
    }

    $( document ).ready(function() {
        $( function() {
            $( "#datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate : '-18y'
            });
        });

        $("#bene_provincia").on('change', function(event, canton, distrito) {
            $('#bene_distrito').html('');
            $('#bene_distrito').append('<option value="0" selected>DISTRITO</option>');
            $('#bene_distrito').prop('disabled', 'disabled');

            $('#bene_canton').html('');
            $('#bene_canton').append('<option value="0" selected>CANTON</option>');
            var url = "{{ route('api.cantones', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (canton !== undefined && value.CODIGOCANTON_C == canton ) {
                        $('#bene_canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                        $('#bene_canton').trigger('change', distrito);
                    }else{
                        $('#bene_canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            });
        });

        $("#bene_canton").on('change', function(event, distrito) {
            $('#bene_distrito').html('');
            if ($(this).children("option:selected").val() != 0) {
                $('#bene_distrito').prop('disabled', false);
            }

            $('#bene_distrito').append('<option value="0" selected>DISTRITO</option>');
            var url = "{{ route('api.distritos', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (distrito !== undefined && value.CODIGODISTRITO_C == distrito ) {
                        $('#bene_distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                    }else{
                        $('#bene_distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
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
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#form_beneficiario").offset().top
            }, 2000);

            $('#form_editar_mascota').hide();

            $("#bene_tipoId option:selected").prop("selected",false);
            $("#bene_tipoId option[value=" + beneficiario.tipoId + "]").prop("selected",true);
            $('#bene_tipoId_send').val($('#bene_tipoId').val());
            $('#bene_cedula').val(beneficiario.cedula);
            $('#bene_nombre').val(beneficiario.nombre);
            $('#bene_datepicker').val(beneficiario.fecha_nac);
            $("#bene_genero option:selected").prop("selected",false);
            $("#bene_genero option[value=" + beneficiario.genero + "]").prop("selected",true);
            $('#bene_telefono').val(beneficiario.telefono);
            $('#bene_email').val(beneficiario.email);

            $("#bene_provincia option:selected").prop("selected",false);
            $("#bene_provincia option[value=" + beneficiario.provincia + "]").prop("selected",true);
            $("#bene_provincia").trigger('change', [beneficiario.canton, beneficiario.distrito]);

            $('#bene_ben').val(beneficiario.NumeroBeneficiaro);
        });

        $('#guardar_beneficiario').on('click', function(){
            var form = $( "#form_beneficiario" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#form_beneficiario').serialize();
            if (form.valid() && validarTelefonoID($('#bene_cedula').val(),$('.tipoIdBeneficiario').val(),$('#bene_telefono').val())) {
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
    });
</script>

<script>
    $(document).ready(function(){
        $('#agregar_tarjeta').on('click', function(){
            $('#form_nueva_tarjeta').show();

            $([document.documentElement, document.body]).animate({
                scrollTop: $("#form_nueva_tarjeta").offset().top
            }, 2000);
        });

        $('#guardar_tarjeta').on('click', function(){
            var form = $( "#tarjetaForm" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#tarjetaForm').serialize();
            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('tarjetas.guardar') }}",
                    data:formData,
                    success:function(data){
                        tipo = (data.respuesta.principal) ? "Principal" : "Secundaria";
                        tr = '<tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted"><td>'+data.respuesta.numeroTarjeta+'</td><td class="ng-star-inserted">'+ tipo +'</td><td class="ng-star-inserted"><a style="cursor: pointer;" class="ng-star-inserted"><span tarjeta="'+ JSON.stringify(data.respuesta) +'" id="deleteTarjeta" class="iconTable iconTrash"></span></a></td></tr>';
                        $('#tbd-tarjetas').append(tr);
                        rmss(false,"Excelente","Se ingresó la nueva tarjeta",null,null);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        rmse("Error","Ha ocurrido un error, vuelva a intentarlo mas tarde");
                    }   
                });
            }
        });

        $('.deleteTarjeta').on('click', function(){
            tr = $(this).closest('tr');
            tarjeta = JSON.parse($(this).attr('tarjeta'));
            $('#confirm-delete').modal('show');
        });

        $('.btn-delete').click(function(e){
            e.preventDefault();
            $('.bd-loading-modal-lg').modal('show');
            $.ajax({
                type:'POST',
                url:"{{ route('tarjetas.eliminar') }}",
                data: { 'numeroCliente':tarjeta.numeroCliente, 'idTarjeta': tarjeta.idTarjeta},
                success:function(data){
                    tr.remove();
                    rmss(false,"Eliminado","Se eliminó la tarjeta correctamente");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    rmse("Error!", "Ha ocurrido un error, intente mas tarde!.");
                }   
            });
        });
    });
</script>

<script>
    $('.editar_mascota').click(function() {
        var mascota = JSON.parse($(this).attr("mascota"));
        $('#form_beneficiario').hide();
        $('#form_editar_mascota').show();

        $([document.documentElement, document.body]).animate({
            scrollTop: $("#form_editar_mascota").offset().top
        }, 2000);

        $("#e_especie option:selected").prop("selected",false);
        $("#e_especie option[value='" + mascota.especie + "']").prop("selected",true);
        $('#e_idmascota').val(mascota.id);
        $('#e_nombre').val(mascota.nombre);
        $('#e_raza').val(mascota.raza);
        $('#e_edad').val(mascota.edad);
        $("#e_genero option:selected").prop("selected",false);
        $("#e_genero option[value='" + mascota.genero + "']").prop("selected",true);
        $('#e_color').val(mascota.color);

        $('#e_operacion').val("2");
    });

    $('#btn_editar_mascota').on('click', function(){
            var form = $( "#form_editar_mascota" );
            form.validate({
                errorClass: 'ng-invalid',
            });

            //get data
            var formData = $('#form_editar_mascota').serialize();

            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('mascotas.editar') }}",
                    data:formData,
                    success:function(data){
                        $('#form_editar_mascota').hide();
                        $('#'+data.id).html(data.mascota.nombre);

                        rmss(false,"Agregado","Información editada correctamente",null,null);
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
</script>
<script>
    $( document ).ready(function() {

        $("#btn-save-badge").on("click", function() {
            var element = $("#badge-content")[0];
            html2canvas(element).then(function(canvas) {
                self.saveAs(canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"), $("#cli-badge").html() + '.png');
            });
        });


        $(".abrirmodal").on('click', function() {
            iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

            $('#qrcode').html($(this).children('#qrbeneimage').html());
            $('#name-badge').html($(this).attr('nombre'));
            $('#cli-badge').html($(this).attr('ben'));

            $('#type-badge').html($(this).attr('tipo'));
            
            if ($(this).attr('tipo') == "Beneficiario") {
                if (iOS) {
                    $("#id-ios-banner").html("Por favor tome una captura de pantalla, guárdelo y envíelo a su beneficiario");
                    $("#btn-save-badge-div").hide();
                    $("#id-ios-banner").show();

                } else {
                    $("#id-ios-banner").html("Por favor guarde este carnet para enviarlo a su beneficiario");
                    $("#btn-save-badge-div").show();
                    $("#id-ios-banner").show();
                }
            } else {
                if (iOS) {
                    $("#id-ios-banner").html("Por favor tome una captura de pantalla y guárdela en su dispositivo");
                    $("#id-ios-banner").show();
                    $("#btn-save-badge-div").hide();
                } else {
                    $("#id-ios-banner").html("");
                    $("#id-ios-banner").hide();
                    $("#btn-save-badge-div").show();
                }
            }

            $('#carnetModal').modal('show');

            setInterval(function() {
                $('#name-badge').quickfit({ max: 28, min: 6, truncate: false, tolerance: 0.08 });
            }, 100);
        });

        $("#titular").on('click', function() {
            iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

            if ($(this).attr('tipo') == "Beneficiario") {
                if (iOS) {
                    $("#id-ios-banner").html("Por favor tome una captura de pantalla, guárdelo y envíelo a su beneficiario");
                    $("#btn-save-badge-div").hide();
                    $("#id-ios-banner").show();

                } else {
                    $("#id-ios-banner").html("Por favor guarde este carnet para enviarlo a su beneficiario");
                    $("#btn-save-badge-div").show();
                    $("#id-ios-banner").show();
                }
            } else {
                if (iOS) {
                    $("#id-ios-banner").html("Por favor tome una captura de pantalla y guárdela en su dispositivo");
                    $("#id-ios-banner").show();
                    $("#btn-save-badge-div").hide();
                } else {
                    $("#id-ios-banner").html("");
                    $("#id-ios-banner").hide();
                    $("#btn-save-badge-div").show();
                }
            }

            $('#qrcode').html($(this).children('#qrtitularimage').html());
            $('#name-badge').html($(this).attr('nombre'));
            $('#cli-badge').html($(this).attr('ben'));
            $('#type-badge').html($(this).attr('tipo'));

            $('#carnetModal').modal('show');

            setInterval(function() {
                $('#name-badge').quickfit({ max: 28, min: 6, truncate: false, tolerance: 0.08 });
            }, 100);
        });
    });
</script>
@endsection