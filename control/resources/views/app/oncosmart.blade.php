@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <form id="gform_1" novalidate="" class="ng-untouched ng-pristine ng-valid">
        <div class="gform_body">
            <div class="gform_page" id="gform_page_1_1">
                <h2 >Servicio OncoSmart</h2>
                <p >Seleccioná si vos o tus beneficiarios estaran dentro de nuestro plan OncoSmart:</p>
                <h3 class="mb-1" style="font-size: 20px; color: #ed2980;">Afiliado</h3>
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
                <h3 class="mb-1 mt-5" style="font-size: 20px; color: #ed2980;">Beneficiarios</h3>
                <table style="font-size: 18px; /*height: 763px;*/ text-align: center; width:100%" width="595">
                    <tbody >
                        <tr style="border-bottom: 1px solid #ed2980;">
                            <td class="collapsable" style="width: 25%; background-color: #0f93d2; color: white;">Nr°</td>
                            <td style="width: 25%; background-color: #0f93d2; color: white;">Cédula</td>
                            <td style="width: 25%; background-color: #0f93d2; color: white;">Nombre</td>
                            <td style="width: 25%; background-color: #0f93d2; color: white;"></td>
                        </tr>
                        @for($i = 0; $i < count($data->getData()->beneficiarios); $i++)
                            @if ($data->getData()->beneficiarios[$i]->estadoBeneficiario == "Activo")
                                <!---->
                                <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                    <!---->
                                    <td class="fixed-side collapsable ng-star-inserted">{{$i+1}}</td>
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
    </form>
</div>
@endsection

@section('js')
<script>
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
@endsection