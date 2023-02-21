@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <form id="gform_1" novalidate="" class="ng-untouched ng-pristine ng-valid">
        <div class="gform_body">
            <div class="gform_page" id="div-tbl-carrito">
                <h2 >Carrito de compras</h2>
                @if (count($cart) == 0)
                    <p class="ng-tns-c7-1">No hay articulos en el carrito de compras.</p>
                @else
                    <table style="font-size: 18px; /*height: 763px;*/ text-align: center; width:100%" id="tbl-carrito" width="595">
                        <tbody >
                            <tr style="border-bottom: 1px solid #ed2980;">
                                <td class="collapsable" style="width: 15%; background-color: #0f93d2; color: white;">Cantidad</td>
                                <td style="width: 50%; background-color: #0f93d2; color: white;">Descripción</td>
                                <td style="width: 30%; background-color: #0f93d2; color: white;"></td>
                                <td style="width: 5%; background-color: #0f93d2; color: white;"></td>
                            </tr>
                            @foreach ($cart as $i=>$c)
                                <!---->
                                <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                    <!---->
                                    <td class="fixed-side collapsable ng-star-inserted">{{$c->qty}}</td>
                                    <!---->
                                    <td class="ng-star-inserted">{{$c->name}}</td>
                                    <!---->
                                    <td class="ng-star-inserted"></td>
                                    <!---->
                                    <td class="ng-star-inserted">
                                        <a class="col-12 col-md-4 deleteCartItem" rowid="{{$c->rowId}}"><span class="iconTable iconTrash deleteCartItem" rowid="{{$c->rowId}}" style="color: black; margin: 0;"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            @if (count($cart) > 0)
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="col-sm-5 offset-sm-7">
                        <a class="gform_logout_button button justify-content-center" id="solicitar" style="cursor: pointer; pointer-events: auto; text-align:center!important; font-size:15px">Solicitar productos</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $('#solicitar').on('click', function(){
            var table = $(this).closest('table');
            $('.bd-loading-modal-lg').modal('show');
            $.ajax({
                type:'POST',
                url:"{{ route('shoppingcart.send.email') }}",
                data:{},
                success:function(data){
                    $('#tbl-carrito').remove();
                    $('#solicitar').remove();
                    $('#div-tbl-carrito').append('<p class="ng-tns-c7-1">No hay articulos en el carrito de compras.</p>');
                    rmss(true,'Solicitado','Tu solicitud fue recibida uno de nuestros agentes te contactara en las proximas 24 horas para terminar el proceso');
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    rmse("Error","Ha ocurrido un error, vuelva a intentarlo mas tarde.");
                }   
            });
        });

        $('.deleteCartItem').on('click', function(){
            var rowId = $(this).attr('rowId');
            var td = $(this).closest('tr');

            //shoppingcart.delete
            $('.bd-loading-modal-lg').modal('show');

            $.ajax({
                type:'POST',
                url:"{{ route('shoppingcart.delete') }}",
                data:{'rowId': rowId},
                success:function(data){
                    $('.bd-loading-modal-lg').modal('hide');
                    window.location.replace("{{ route('carrito') }}");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    rmse("Error","Ha ocurrido un error, vuelva a intentarlo mas tarde.");
                }   
            });
        });
    });
</script>
@endsection