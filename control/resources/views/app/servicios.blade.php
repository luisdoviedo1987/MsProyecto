@extends('app.layout.master')

@section('content')
<div id="accordion" class="mt-4">
    <div style="margin-bottom: 5px !important;">
        <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn collapsed" data-toggle="collapse" data-target="#oncosmart" aria-expanded="false" aria-controls="perfil">
                <h2 >OncoSmart</h2>
            </button>
        </h5>
        </div>

        <div id="oncosmart" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
                    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
                    <form id="gform_1" novalidate="" class="ng-untouched ng-pristine ng-valid">
                        <div class="gform_body">
                            <div class="gform_page" id="gform_page_1_1">
                                <h2 >Servicio OncoSmart</h2>
                                <p >Seleccioná si vos o tus beneficiarios estaran dentro de nuestro plan OncoSmart:</p>
                                <h3 class="mb-1" style="font-size: 20px; color: #ed2980;">Titular</h3>
                                <div class="table-responsive">
                                    <table style="font-size: 18px; /*height: 763px;*/ text-align: center; width:100%" width="595">
                                        <tbody >
                                            <tr style="border-bottom: 1px solid #ed2980;">
                                                <td style="width: 33%; background-color: #0f93d2; color: white;">Cédula</td>
                                                <td style="width: 33%; background-color: #0f93d2; color: white;">Nombre</td>
                                                <td style="width: 33%; background-color: #0f93d2; color: white;"></td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #ed2980;">
                                                <td class="fixed-side">{{ $data->getData()->persona_cedula }}</td>
                                                <td >{{ $data->getData()->nombre }}</td>
                                                <td>
                                                    @if (!isset($data->getData()->shoppingcart))
                                                        @if($data->getData()->oncosmart != 1)
                                                            @if (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual')
                                                                <a class="gform_next_button button add_afiliado_shopping_cart" afiliado="{{ $data->getData()->cli }}" style="cursor: pointer; text-align: center; pointer-events: auto; font-size:13px !important">Agregar al plan</a>
                                                            @else
                                                                <a class="gform_next_button button add_afiliado_shopping_cart" afiliado="{{ $data->getData()->cli }}" style="cursor: pointer; text-align: center; pointer-events: auto; font-size:13px !important">Agregar al carrito</a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                                <!-- <td ><input name="oncosmart" type="checkbox" class="ng-untouched ng-pristine ng-valid" {{ ($data->getData()->oncosmart == 1) ? 'checked' : '' }}/></td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <h3 class="mb-1 mt-5" style="font-size: 20px; color: #ed2980;">Beneficiarios</h3>
                                <div class="table-responsive">

                                <table style="font-size: 18px; /*height: 763px;*/ text-align: center; width:100%" width="595">
                                    <tbody >
                                        <tr style="border-bottom: 1px solid #ed2980;">
                                            <!-- <td class="collapsable" style="width: 25%; background-color: #0f93d2; color: white;">Nr°</td> -->
                                            <td style="width: 25%; background-color: #0f93d2; color: white;">Cédula</td>
                                            <td style="width: 50%; background-color: #0f93d2; color: white;">Nombre</td>
                                            <td style="width: 25%; background-color: #0f93d2; color: white;"></td>
                                        </tr>
                                        @for($i = 0; $i < count($data->getData()->beneficiarios); $i++)
                                            @if ($data->getData()->beneficiarios[$i]->estadoBeneficiario == "Activo" || $data->getData()->beneficiarios[$i]->estadoBeneficiario == "Activo Titular Sin Cobertura")
                                                <!---->
                                                <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                                    <!---->
                                                    <!-- <td class="fixed-side collapsable ng-star-inserted">{{$i+1}}</td> -->
                                                    <!---->
                                                    <td class="ng-star-inserted">{{ $data->getData()->beneficiarios[$i]->persona_cedula }}</td>
                                                    <!---->
                                                    <td class="ng-star-inserted">{{ $data->getData()->beneficiarios[$i]->nombre }}</td>
                                                    <!---->
                                                    <td>
                                                        @if (!isset($data->getData()->beneficiarios[$i]->shoppingcart))
                                                            @if($data->getData()->beneficiarios[$i]->oncosmart != 1)
                                                                @if (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual')
                                                                    <a class="gform_next_button button add_beneficiario_shopping_cart" bene="{{$data->getData()->beneficiarios[$i]->NumeroBeneficiaro}}" style="cursor: pointer; text-align: center; pointer-events: auto; font-size:13px !important">Agregar al plan</a>
                                                                @else
                                                                    <a class="gform_next_button button add_beneficiario_shopping_cart" bene="{{$data->getData()->beneficiarios[$i]->NumeroBeneficiaro}}" style="cursor: pointer; text-align: center; pointer-events: auto; font-size:13px !important">Agregar al carrito</a>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <!-- <td class="ng-star-inserted"><input type="checkbox" class="ng-untouched ng-pristine ng-valid" {{ ($data->getData()->beneficiarios[$i]->oncosmart == 1) ? 'checked' : '' }}/></td> -->
                                                </tr>
                                            @endif
                                        @endfor
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 5px !important;">
        <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn collapsed" data-toggle="collapse" data-target="#collapBene" aria-expanded="false" aria-controls="perfil">
                <h2 >Beneficiarios</h2>
            </button>
        </h5>
        </div>

        <div id="collapBene" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
                    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
                    <div class="gform_body" style="background-color: rgba(255, 255, 255, 0.7);">
                        <div class="gform_page" id="gform_page_1_1">
                            <h2 >Agregá o modificá beneficiarios</h2>
                            <p >Agregá o modificá en esta sección la familia o amigos que desees agregar a tu plan:</p>
                            
                            <div class="table-responsive">
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
                                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select beneficiarioTipoId" id="tipo_id" name="tipo_id" required="">
                                                            <option hidden="true">Elegí tu tipo de identificación</option>
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
                                                    <div class="ginput_container ginput_container_select">
                                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="estadocivil" name="estadocivil" required="" >
                                                            <option hidden="" value="">Estado civil</option>
                                                            <option value="Soltero">Soltero(a)</option>
                                                            <option value="Casado">Casado(a)</option>
                                                            <option value="Divorciado">Divorciado(a)</option>
                                                            <option value="Viudo">Viudo(a)</option>
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
                                                            name="telefono"
                                                            placeholder="Teléfono 1"
                                                            required=""
                                                            type="number"
                                                            step="1"
                                                            max="99999999"
                                                            min="11111111"
                                                            maxlength = "8"
                                                            value=""
                                                            oninput="this.value|=0"
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
                                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select nuevoBeneficiarioTipoId" id="tipo_id" name="tipoId" required="">
                                                            <option disabled="" hidden="" value="0">Elegí tu tipo de identificación</option>
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
                                                    <div class="ginput_container ginput_container_select">
                                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="estadocivil" name="estadocivil" required="" >
                                                            <option hidden="" value="">Estado civil</option>
                                                            <option value="Soltero">Soltero(a)</option>
                                                            <option value="Casado">Casado(a)</option>
                                                            <option value="Divorciado">Divorciado(a)</option>
                                                            <option value="Viudo">Viudo(a)</option>
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
                                                            id="insert_telefono"
                                                            name="telefono"
                                                            placeholder="Teléfono"
                                                            required=""
                                                            type="number"
                                                            step="1"
                                                            max="99999999"
                                                            min="11111111"
                                                            maxlength = "8"
                                                            value=""
                                                            oninput="this.value|=0"
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
            </div>
        </div>
    </div>

    <div style="margin-bottom: 5px !important;">
        <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn collapsed" data-toggle="collapse" data-target="#collapmasco" aria-expanded="false" aria-controls="perfil">
                <h2 >Mascotas</h2>
            </button>
        </h5>
        </div>

        <div id="collapmasco" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
                    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
                    <div class="gform_body" id="gform_1">
                        <div class="gform_page" id="gform_page_1_1">
                            <h2>Agregá o modificá tus mascotas</h2>
                            <p>Agregá o modificá en esta sección las mascotas que deseas tengan cobertura MediSmart:</p>
                        </div>
                        <div class="gform_page" id="gform_page_1_2">
                            <ul id="additional-plans-accordion" style="text-align: center; padding: 0;">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="col-12 table-responsive" style="padding: 0; margin: 0;">
                                            <table class="table" style="font-size: 18px; margin: 0;" width="595">
                                                <tbody id="tbody_mascotas">
                                                    <tr>
                                                        <td style="width: 60%; background-color: #0f93d2; color: white;">Nombre</td>
                                                        <td style="width: 20%; background-color: #0f93d2; color: white;">Modificar</td>
                                                        <td style="width: 20%; background-color: #0f93d2; color: white;">Eliminar</td>
                                                    </tr>
                                                    @foreach ($data->getData()->mascotas as $mascota)
                                                        <!---->
                                                        <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                                            <td class="fixed-side" id="{{$mascota->idPet}}" style="border-top: none;">{{$mascota->nombre}}</td>
                                                            <td style="border-top: none;">
                                                                <a class="col-12 col-md-4"  id="editar_mascota" mascota="{{ json_encode($mascota) }}">
                                                                    <span class="iconTable iconPencilColor" style="color: black; margin: 0;"></span>
                                                                </a>
                                                            </td>
                                                            <td style="border-top: none;">
                                                                <a class="col-12 col-md-4 confirm-delete-show-md" data-target="#clienteDelete" mascota="{{ json_encode($mascota) }}" data-toggle="modal"><span class="iconTable iconTrash confirm-delete-show-md" mascota="{{ json_encode($mascota) }}" style="color: black; margin: 0;"></span></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="gform_page_footer">
                                    <div class="row">
                                        <div class="col-sm-5 offset-sm-7">
                                            <a class="gform_next_button button" id="agregar_nueva_mascota" style="cursor: pointer; text-align: center;">Agregar <span class="iconTable iconDog" style="margin: 0;"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <!---->
                
                    <form id="form_mascota" class="ng-untouched ng-pristine ng-valid ng-star-inserted" style="display:none">
                        <input type="hidden" name="operacion" id="operacion" value="1">
                        <input type="hidden" name="idmascota" id="idmascota" value="1">
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
                                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="especie" name="especie" required="">
                                                            <option disabled="" hidden="selected" selected="selected" value="">Especie</option>
                                                            <option value="Perro">Perro</option>
                                                            <option value="Gato">Gato</option>
                                                        </select>
                                                        <!---->
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ginput_container ginput_container_text">
                                                        <input aria-invalid="false" aria-required="true" class="medium" id="raza" name="raza" placeholder="Raza" required="" type="text" value="" />
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
                                            </div>
                                            <div class="col-sm-6">
                                                <li>
                                                    <div class="ginput_container ginput_container_text">
                                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="edad" name="edad" required="">
                                                            <option disabled="" hidden="selected" selected="selected" value="">Edad</option>
                                                            <option value="1 año">1 año</option>
                                                            <option value="2 años">2 años</option>
                                                            <option value="3 años">3 años</option>
                                                            <option value="4 años">4 años</option>
                                                            <option value="5 años">5 años</option>
                                                            <option value="6 años">6 años</option>
                                                            <option value="7 años">7 años</option>
                                                            <option value="8 años">8 años</option>
                                                            <option value="9 años">9 años</option>
                                                            <option value="10 años">10 años</option>
                                                            <option value="11 años">11 años</option>
                                                            <option value="12 años">12 años</option>
                                                            <option value="13 años">13 años</option>
                                                            <option value="14 años">14 años</option>
                                                            <option value="15 años">15 años</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ginput_container ginput_container_text">
                                                        <input aria-invalid="false" class="medium" id="color" name="color" placeholder="Color" required="" type="text" value="" /><span class="icon iconPencil"></span>
                                                        <!---->
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ginput_container ginput_container_select">
                                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select" id="genero" name="genero" required="">
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
                                            @if (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual')
                                                <a class="gform_next_button button" id="guardar_nueva_mascota" style="cursor: pointer; text-align: center; pointer-events: auto;">AGREGAR &gt;&gt;</a>
                                            @else
                                                <a class="gform_next_button button" id="guardar_nueva_mascota" style="cursor: pointer; text-align: center; pointer-events: auto;">AGREGAR AL CARRITO &gt;&gt;</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                
                
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
</div>


@endsection

@section('js')

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

    $(document).ready(function(){
        $('.add_afiliado_shopping_cart').on('click', function(){
            var afiliado = $(this).attr('afiliado');
            var a_td = $(this);

            $('.bd-loading-modal-lg').modal('show');
            $.ajax({
                type:'POST',
                url:"{{ route('shoppingcart.agregar.oncosmart.afiliado') }}",
                data:{'afiliado': afiliado},
                success:function(data){
                    if (typeof(data.agregar) != "undefined" && data.agregar !== null) {
                        rmse("Error","Ha ocurrido un error, vuelva a intentar mas tarde");
                    }else{
                        a_td.hide();
                        @if (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual')
                            rmss(true,"Agregado","Se agregó exitosamente");
                        @else
                            rmss(true,"Agregado","Agregado al carrito","Ir al carrito","{{route('carrito')}}");
                        @endif
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    rmse("Error!", "Ha ocurrido un error, intente mas tarde!.");
                }   
            });
        });

        $('.add_beneficiario_shopping_cart').on('click', function(){
            var beneficiario = $(this).attr('bene');
            var a_td = $(this);

            $('.bd-loading-modal-lg').modal('show');
            $.ajax({
                type:'POST',
                url:"{{ route('shoppingcart.agregar.oncosmart.beneficiario') }}",
                data:{'beneficiario': beneficiario},
                success:function(data){
                    if (typeof(data.agregar) != "undefined" && data.agregar !== null) {
                        rmse("Error","Ha ocurrido un error, vuelva a intentar mas tarde");
                    }else{
                        a_td.hide();
                        @if (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual')
                            rmss(true,"Agregado","Se agregó exitosamente");
                        @else
                            rmss(true,"Agregado","Agregado al carrito","Ir al carrito","{{route('carrito')}}");
                        @endif
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    rmse("Error!", "Ha ocurrido un error, intente mas tarde!.");
                }   
            });
        });
    });
</script>

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
            if (form.valid() && validarTelefonoID($('#cedula').val(),$('.nuevoBeneficiarioTipoId').val(),$('#telefono').val())) {
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
            $.ajax({
                type:'POST',
                url:"{{ route('afiliado.validarconvenios') }}",
                data:{},
                success:function(data){
                    if (data.resultado) {
                        $('#form_beneficiario_insert').show()
                        $('#form_beneficiario').hide()
                    }else{
                        rmse("Error!", " No puedes agregar un nuevo beneficiario porque tienes el convenio "+ data.convenio +". Ponte en contacto con el número 2528-5400 para mas información!.");
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    rmse("Error!", "Ha ocurrido un error, intente mas tarde!.");
                }   
            });
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

           if(!validateId($("#nueva_cedula").val())){
                rmse("Error!", "El numero de cedula no es valido. Intente de nuevo.");
                return;
           }


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
            if (form.valid() && validarTelefonoID($('#nueva_cedula').val(),$('.nuevoBeneficiarioTipoId').val(),$('#insert_telefono').val())) {
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

    });
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>

    function validateId(id) {
        if ($('select[name=tipoId]').val() == "1"){
            var re = '^[0-9]*$';

            if (id.match(re) == null) {
                return false;
            }

            if (id.length != 9) {
                return false;
            }

        }else{
            var re = '^[a-zA-Z0-9]*$';

            if (id.match(re) == null) {
                return false;
            }
        }
        
        return true;
    }


    $(document).ready(function(){

        $('#editar_mascota').click(function() {
            var mascota = JSON.parse($(this).attr("mascota"));
            $('#form_mascota').hide();
            $('#form_editar_mascota').show();

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

        $('#agregar_nueva_mascota').on('click', function(){
            $.ajax({
                type:'POST',
                url:"{{ route('afiliado.validarconvenios') }}",
                data:{},
                success:function(data){
                    if (data.resultado) {
                        $('#form_editar_mascota').hide();
                        $('#form_mascota').show();
                    }else{
                        rmse("Error!", " No puedes agregar un nueva mascota porque tienes el convenio "+ data.convenio +". Ponte en contacto con el número 2528-5400 para mas información!.");
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    rmse("Error!", "Ha ocurrido un error, intente mas tarde!.");
                }   
            });
        });

       $('#guardar_nueva_mascota').on('click', function(){
            var form = $( "#form_mascota" );
            form.validate({
                errorClass: 'ng-invalid',
            });

            //get data
            var formData = $('#form_mascota').serialize();

            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('shoppingcart.agregar.mascota') }}",
                    data:formData,
                    success:function(data){
                        $('#form_mascota')[0].reset();

                        @if (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual')
                            rmss(false,"Agregado","Mascota agregada correctamente.",null,null);
                            $('#tbody_mascotas').append('<tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted"><td class="fixed-side" id="'+ data.mascota.idPet +'" style="border-top: none;">'+ data.mascota.nombre +'</td><td style="border-top: none;"><a class="col-12 col-md-4"  id="editar_mascota" mascota="'+ JSON.stringify(data.mascota) +'"><span class="iconTable iconPencilColor" style="color: black; margin: 0;"></span></a></td><td style="border-top: none;"><a class="col-12 col-md-4 confirm-delete-show-md" data-target="#clienteDelete" mascota="'+ JSON.stringify(data.mascota) +'" data-toggle="modal"><span class="iconTable iconTrash confirm-delete-show-md" mascota="'+ JSON.stringify(data.mascota) +'" style="color: black; margin: 0;"></span></a></td></tr>');
                        @else
                            if (typeof(data.agregar) != "undefined" && data.agregar !== null) {
                                rmse("Error","Ha ocurrido un error, vuelva a intentar mas tarde");
                            }else{
                                rmss(true,"Agregado","Agregado al carrito","Ir al carrito","{{route('carrito')}}");
                            }
                        @endif
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
                        $('#'+data.id).html(data.nombre);

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

        $('.confirm-delete-show-md').on('click',function(){
            tr = $(this).closest('tr');
            mascota = JSON.parse($(this).attr("mascota"));
            $('#confirm-delete').modal('show');
        });

        $('.btn-delete').click(function(e){
            e.preventDefault();
            $('.bd-loading-modal-lg').modal('show');
            $.ajax({
                type:'POST',
                url:"{{ route('mascotas.editar') }}",
                data: { 'idmascota': mascota.id, 'cli': '{{$data->getData()->cli}}', 'idPet': mascota.idPet, 'operacion': 3 },
                success:function(data){
                    tr.remove();
                    rmss(false,"Eliminado","Se eliminó el beneficiario correctamente");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    if (XMLHttpRequest.status == 403) {
                        rmse('Error', XMLHttpRequest.responseJSON.message);
                    }else{
                        rmse('Error', 'Ocurrió un error, intente mas tarde');
                    }
                }   
            });
        });

    });
</script>
@endsection