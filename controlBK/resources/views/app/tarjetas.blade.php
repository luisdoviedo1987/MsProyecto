@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
        <div class="gform_body">
            <div class="gform_page" id="gform_page_1_1">
                <h2>Información pagos</h2>
                <p>Conocé la modalidad de tu plan y gestioná la tarjeta con la que se está pagando en forma recurrente.</p>
                <div class="table-responsive">
                    <table style="font-size: 18px; text-align: center;">
                        <tbody>
                            <tr style="border-bottom: 1px solid #ed2980;">
                                <td style="width: 20%; background-color: #0f93d2; color: white;">Tipo de cobertura</td>
                                <td style="width: 20%; background-color: #0f93d2; color: white;">Forma de pago</td>
                                <td class="collapsable" style="width: 20%; background-color: #0f93d2; color: white;">Día de cobro</td>
                                <td style="width: 20%; background-color: #0f93d2; color: white;">Costo del plan</td>
                                <td class="collapsable" style="width: 20%; background-color: #0f93d2; color: white;">Estado del plan del cliente</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #ed2980;">
                                <td>{{$data->getData()->tipoCobertura}}</td>
                                <td>{{$data->getData()->formaPago}}</td>
                                <td class="collapsable">{{$data->getData()->fechaPago}}</td>
                                <td>${{$data->getData()->costoPlan}}</td>
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
                <div class="col-sm-12">
                    <a class="gform_next_button button" id="agregar_tarjeta" style="cursor: pointer; text-align: center;">Agregar tarjeta<span class="iconTable iconCardColor" style="margin: 0;"></span></a>
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
                                    <td class="ng-star-inserted">{{ $tarjeta->principal == 1 ? 'Principal' : 'Segundaria' }}</td>
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
                                                    <input aria-invalid="false" aria-required="true" class="medium" id="principal" name="principal" placeholder="Tarjeta seleccionada para cobro" type="text" value="" />
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
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#agregar_tarjeta').on('click', function(){
                $('#form_nueva_tarjeta').show();
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
                            tipo = (data.respuesta.principal) ? "Principal" : "Segundaria";
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
@endsection