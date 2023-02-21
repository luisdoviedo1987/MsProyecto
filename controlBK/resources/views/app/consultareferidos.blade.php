@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <form id="gform_1" novalidate="" class="ng-untouched ng-pristine ng-valid">
        <div class="gform_body">
            <div class="gform_page" id="gform_page_1_1">
                <h2>Datos de los referidos</h2>
                <p>En esta sección podés consultar tus referencias.</p>
                <!---->
                <div  class="row">
                    <div  class="col-sm-5 offset-sm-7">
                        <a href="{{route('referidos')}}" class="gform_next_button button submit" style="cursor: pointer; text-align: center; pointer-events: auto;">Referir más &gt;&gt;</a>
                    </div>
                </div>
            </div>
        </div>
        <p id="p-referidos" class="ng-star-inserted">Aún no tenés referidos, cliqueá <a style="cursor:pointer;color:#73d8d0" href="{{route('referidos')}}">aquí</a> para empezar a ganar</p>
        <!---->
        <div id="table-referidos" class="table-responsive ng-star-inserted" style="display:none">
            <table style="font-size: 18px; text-align: center;">
                <thead>
                    <tr style="border-bottom: 1px solid #ed2980;">
                        <td style="width: 25%; background-color: #0f93d2; color: white;">Nombre del referido</td>
                        <td style="width: 25%; background-color: #0f93d2; color: white;">Regalía</td>
                        <td class="collapsable" style="width: 25%; background-color: #0f93d2; color: white;">Fecha del Vencimiento de referencia</td>
                        <td style="width: 25%; background-color: #0f93d2; color: white;">Referencia Exitosa</td>
                    </tr>
                </thead>
                <tbody id='tbReferidos'>
                    
                </tbody>
            </table>
        </div>
    </form>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $.ajax({
                type:'POST',
                url:"{{ route('referidos.consultar') }}",
                data:{},
                success:function(data){
                    if (data.resultado !== undefined && data.resultado) {
                        $('#p-referidos').hide();
                        $('#table-referidos').show();
                        $.each(data.Referencias, function( index, value ) {
                            $('#tbReferidos').append('<tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted"><td>'+ value.NombreReferido +'</td><td>'+ value.Regalia +'</td><td class="collapsable">'+ value.FechaVencimientoReferencia +'</td><td class="ng-star-inserted">'+ ((value.ReferenciaExitosa == true) ? 'Si' : 'No' )+'</td></tr>');
                        });
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    
                }   
            });

            @if (isset($code))
                rmss(false,"Excelente","Referencia creada, ¡Corre y notificale para ganar premios!",null,null);
            @endif
        });
    </script>
@endsection