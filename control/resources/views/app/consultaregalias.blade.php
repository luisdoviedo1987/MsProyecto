@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
</div>
<div class="gform_body" id="gform_1">
    <div class="gform_page" id="gform_page_1_1">
        <h2>Datos de las regalías</h2>
        <p>En esta sección podés canjear la regalía obtenida gracias la referencia que efectuaste:</p>
        <div class="gform_page_fields" style="padding: 0 !important;">
            <!---->
            <p id="p-regalias" style="text-align: center;" class="ng-star-inserted">No tienes ninguna regalía disponible</p>
            <!---->
        </div>
        <!---->
        <div id="table-regalias" class="table-responsive ng-star-inserted" style="display:none">
            <table style="font-size: 18px; text-align: center;">
                <thead>
                    <tr style="border-bottom: 1px solid #ed2980;">
                        <td style="width: 25%; background-color: #0f93d2; color: white;">Nombre del referido</td>
                        <td style="width: 25%; background-color: #0f93d2; color: white;">Regalía</td>
                        <td class="collapsable" style="width: 25%; background-color: #0f93d2; color: white;">Fecha del vencimiento de la regalía</td>
                        <td style="width: 25%; background-color: #0f93d2; color: white;">Canjeado</td>
                    </tr>
                </thead>
                <tbody id='tbRegalias'>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $.ajax({
            type:'POST',
            url:"{{ route('regalias.consultar') }}",
            data:{},
            success:function(data){
                if (data.resultado !== undefined && data.resultado) {
                    $('#p-regalias').hide();
                    $('#table-regalias').show();
                    $.each(data.Regalias, function( index, value ) {
                        $('#tbRegalias').append('<tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted"><td>'+ value.NombreReferido +'</td><td>'+ value.Regalia +'</td><td class="collapsable">'+ value.FechaVencimientoCanje +'</td><td class="ng-star-inserted">'+ ((value.CanjeAplicadoPorReferente == true) ? 'Si' : 'No' )+'</td></tr>');
                    });
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                
            }   
        });
    });
</script>
@endsection