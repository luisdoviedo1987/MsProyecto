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
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,900,700italic,700,600italic,600,400italic);

#days {
        font-family: 'Titillium Web', cursive;
        text-align: center;
        font-size: 20px;
        color: #00acac;
}
#hours {
        font-family: 'Titillium Web', cursive;
        text-align: center;
        font-size: 20px;
        color: #49b6d6;
}
#minutes {
        font-family: 'Titillium Web', cursive;
        text-align: center;
        font-size: 20px;
        color: #f07c22;
}
#seconds {
        font-family: 'Titillium Web', cursive;
        text-align: center;
        font-size: 18px;
        color: #db4844;   
}
</style>

@endsection

@section('content')


<div id="accordion" class="mt-4">
    <div style="margin-bottom: 5px !important;">
        <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button id="generar-codigo"class="btn collapsed" data-toggle="collapse" data-target="#validacion" aria-expanded="false" aria-controls="validacion" >
                <h2 >Generar Código</h2>
            </button>
        </h5>
        </div>

        <div id="validacion" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div  class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
                    <div  class="gform_anchor" id="gf_1" tabindex="-1"></div>
                    <form  id="form_afiliado" class="ng-untouched ng-valid ng-dirty">
                        {{ csrf_field() }}
                        <div  class="gform_body">
                            <div  class="gform_page" id="gform_page_1_1">
                                    <p>Entrega el siguiente código para completar la validación de tu cita</p>
                                    <input type="hidden" name="cli" id="cli" value="{{ $data->getData()->cli }}">

                                
                                <div class="modal-body">
                                 <div id="info-modal-codigo"></div>

                                        <div class="widget widget-stats bg-green">
                                            <div class="stats-info">
                                                 <center>  
                                                    <h2 style="text-align: center;">Código Temporal</h2>
                                                    <div style="font-size: 50px" id="codTemp">00000</div>
                                                 </center>  
                                            </div>
                                        </div>

                                 <center>
                                    <p class="lead">
                                        Tiempo restante para vencimiento de código.
                                    </p>
                                         <span> </span>
                                         <div class="row">
                                            <!-- <div class="col-md-3">
                                                 <div id="days">0<br><span>Días</span></div>
                                            </div>      
                                            <div class="col-md-3">
                                                  <div id="hours">00<br><span>Horas</span></div>
                                            </div> -->
                                            <div class="col-md-6">
                                                  <div id="minutes">00<br><span>Minutos</span></div>
                                            </div> 
                                            <div class="col-md-6">
                                                  <div id="seconds">00<br><span>Segundos</span></div>
                                            </div>  
                                        </div>
                                </center>
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
        </div>
    </div>
</div>
@endsection

@section('js')

<script>
    var  expireDate = "29 April 2020 9:56:00 GMT+01:00";
    $( document ).ready(function() {

        $( "#datepicker" ).datepicker({
            dateFormat: 'yyyy-MM-dd'
        });

        window.addEventListener("load", function () {
            setInterval(function () {
                makeTimer(expireDate.replace(/ /g,"T"));
            }, 1000)
        });

        // setInterval(function () {
        //     makeTimer(expireDate);
        // }, 1000);

        $("#generar-codigo").on('click', function() {
            var request = {
                cli: $("#cli").val()
            };
            $('.bd-loading-modal-lg').modal('show');

                $.ajax({
                    type:'POST',
                    url:'{{ route('validacion.crear') }}',
                    data: request,
                    success:function(data){
                        if(data.status == "SUCCESS"){
                            expireDate = data.expTime;
                            $("#codTemp").html(data.code);
                            rmss(false,"Excelente","Código generado correctamente",null,null);
                        }else{
                            rmse('Error', data.msg);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        $('.bd-loading-modal-lg').modal('hide');
                        if (XMLHttpRequest.status == 403) {
                            rmse('Error', XMLHttpRequest.responseJSON.msg);
                        }else{
                            rmse('Error', 'Ocurrió un error, intente mas tarde');
                        }
                    }   
                });
        });
    });
    function makeTimer(pExpireDate) {
        var endTime = new Date(pExpireDate);
        endTime = Date.parse(endTime) / 1000;

        var now = new Date();
        now = Date.parse(now) / 1000;

        var timeLeft = endTime - now;

        if (timeLeft > 0) {
            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - days * 86400) / 3600);
            var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
            var seconds = Math.floor(
            timeLeft - days * 86400 - hours * 3600 - minutes * 60
            );

            if (hours < "10") {
            hours = "0" + hours;
            }
            if (minutes < "10") {
            minutes = "0" + minutes;
            }
            if (seconds < "10") {
            seconds = "0" + seconds;
            }
        } else {
            var days = 0;
            var hours = "00";
            var minutes = "00";
            var seconds = "00";
        }

        $("#days").html(days + "<br><span>Días</span>");
        $("#hours").html(hours + "<br><span>Horas</span>");
        $("#minutes").html(minutes + "<br><span>Minutos</span>");
        $("#seconds").html(seconds + "<br><span>Segundos</span>");
    }   
</script>

@endsection