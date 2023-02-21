@extends('app.layout.master')

@section('content')
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
                                        <input aria-invalid="false" aria-required="true" class="medium" id="edad" name="edad" placeholder="Edad" required="" type="text" value="" />
                                        <span class="icon iconPencil"></span>
                                        <!---->
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

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
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
            $('#form_editar_mascota').hide();
            $('#form_mascota').show();
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