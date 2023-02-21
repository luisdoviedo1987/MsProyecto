@extends('layout.master-new')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('control/assets/css/home.css') }}" />
@endsection

@section('content')
<div class="loading" style="display: none;">Loading&#8230;</div>

<section class="container-fluid px-lg-5 py-3">
    <div class="row">
      <div class="col-md-6 col-lg-6 d-md-flex d-lg-flex align-items-center justify-content-center">
        @if(isset($affiliateCodes))
            <img src="{{ asset($affiliateCodes->responsiveImage) }}" alt="Afiliarme a MediSmart" class="img-fluid banner-registro">
        @else
            <img src="{{ asset('control/assets/img/feb2023/BannerFEB20_PopUp.png') }}" alt="Afiliarme a MediSmart" class="img-fluid banner-registro"> 
        @endif
      </div>
      <div class="col-md-6 col-lg-6 d-lg-flex justify-content-center my-4">
        <div class="card">
          <div class="card-container p-3 p-lg-5">
            <h1 class="title text-center">
              Estás a un paso de <br />
              completar tu afiliación
            </h1>
            <p class="text-center">
              Dejanos tus datos para continuar con el proceso
            </p>
            <div id="form_group_inside">
                <form id="form_afiliarse" novalidate="" method="post">

                    <div class="stepper-wrapper">
                        <div class="stepper-item completed">
                          <div class="step-counter"></div>
                          <div class="step-name">Informacion personal</div>
                        </div>
                        <div class="stepper-item completed">
                          <div class="step-counter"></div>
                          <div class="step-name">Informacion adicional</div>
                        </div>
                      </div>
                
                      <fieldset>
                        <div class="m-2">
                            <select name="tipo_id" id="tipo_id" class="form-control" required>
                                <option value="" disabled selected>Tipo de identificación</option>
                                <option value="1">Cédula Nacional</option>
                                <option value="2">Cédula Residente (DIMEX)</option>
                                <option value="3">Pasaporte</option>
                            </select>
                        </div>
                        <div class="m-2">
                            <input type="text" name="cedula" id="nueva_cedula" class="form-control" placeholder="Identificación" required>
                        </div>
                
                        <div class="m-2">
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="m-2">
                            <input type="text" name="apellido1" id="apellido1" class="form-control" placeholder="Primer apellido" required>
                        </div>
                        <div class="m-2">
                            <input type="text" name="apellido2" id="apellido2" class="form-control" placeholder="Segundo apellido" required>
                        </div>
                        <div class="m-2">
                            <input type="date" name="fechanacimiento" id="fechanacimiento" class="form-control" placeholder="Fecha de nacimiento" required>
                        </div>
                        <div class="m-2">
                            <select name="genero" id="genero" class="form-control" required>
                                <option value="" disabled selected >Genero</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Feminino</option>
                            </select>
                        </div>
                        <div class="m-2">
                           <div class="d-flex justify-content-center">
                               <div class="d">
                                   <img src="{{ asset('control/assets/img/icon-oncosmart.svg') }}" class="icon-onco" alt="Plan OncoSmart">
                               </div>
                               <div class="d-flex mx-3">
                                   <div class="d">
                                    <h6>¿Agregar OncoSmart?</h6>
                                    <h6>Desde $2.26 c/u</h6>
                                   </div>
                                <div class="d mx-3">
                                    <input type="checkbox" name="oncosmart" id="oncosmart" class="form-contro" placeholder="OncoSmart">
                                </div>
                               </div>
                           </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button class="btn btn-primary next" id="next" >Siguiente</button>
                        </div>
                      </fieldset>
                      <fieldset>
                          <div class="m-2">
                              <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono celular" required>
                          </div>
                          <div class="m-2">
                               <input type="text" name="email" id="email" class="form-control" placeholder="Correo electronico" required>
                          </div>
                          <div class="m-2">
                              <select name="provincia" id="provincia" class="form-control provincias" required>
                                    <option value = "" disabled selected>Provincia</option>
                              </select>
                          </div>
                            <div class="m-2">
                                <select name="canton" id="canton" class="form-control cantones" required>
                                        <option value = "" disabled selected>Cantón</option>
                                </select>
                            </div>
                            <div class="m-2">
                                <select name="distrito" id="distrito" class="form-control distritos" required>
                                        <option value = "" disabled selected>Distrito</option>
                                </select>
                            </div>
                           
                                <div class="m-2 d-flex justify-content-center my-3">
                                    <button class="btn btn-secondary previous mx-2" type="button">Atras</button>
                                    <button class="btn btn-primary mx-2" type="button" id="btn_continuar">Finalizar</button>
                                  </div>
                            
                      </fieldset>
                    
                </form>                
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="container card_plan {{ ($plan == 'mensual' ? 'bg_green' : ($plan == 'semestral' ? 'bg_purple' : 'bg_orange')) }}  py-5 my-5 px-3">
    <div class="row ">
        @if ($plan == 'mensual')
            <div class="col-lg-6 text-center">
                <div class="content">
                <h4 class="white">Plan mensual <br>desde </h4>
                <h2 class="white">$13.56*</h2>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="content">
                <h4 class="white">Beneficiario <br>adicionales por</h4>
                <h2 class="white">$6.78* al mes c/u </h2>
                </div>
            </div>
        @elseif ($plan == 'semestral')
            <div class="col-lg-6 text-center">
                <div class="content">
                <h4 class="white">Plan semestral <br>desde </h4>
                <h2 class="white">$81.36*</h2>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="content">
                <h4 class="white">Beneficiario <br>adicionales por</h4>
                <h2 class="white">$40.68* al mes c/u </h2>
                </div>
            </div>
        @elseif ($plan == 'anual')
            <div class="col-lg-6 text-center">
                <div class="content">
                <h4 class="white">Plan anual <br>desde </h4>
                <h2 class="white">$162.72*</h2>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="content">
                <h4 class="white">Beneficiario <br>adicionales por</h4>
                <h2 class="white">$81.36* al mes c/u </h2>
                </div>
            </div>
        @endif
    </div>
    <div class="row mt-4">
      <div class="col-12 text-center">
        <small class="white ">* 10% de descuento se aplica únicamente para afiliaciones <br>
          web y se aplica al final de la transacción.</small>
      </div>
    </div>
  </section>
@endsection

@section('js')
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
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
            rmse("Error","El número de teléfono no tiene el formato correcto. Debe ser de 8 dígitos sin guiones y ser un teléfono válido.");
            return false;
        }

        if (telefono.charAt(0) != 8 && telefono.charAt(0) != 7 && telefono.charAt(0) != 2 && telefono.charAt(0) != 6 && telefono.charAt(0) != 5) {
            rmse("Error","El número de teléfono debe de ser un teléfono válido.");
            return false;
        }

        return true;
    }

    $( document ).ready(function() {
        $(".provincias").on('change', function(event, canton, distrito) {
            $('#distrito').html('');
            $('#distrito').append('<option disabled="" hidden="" selected="selected" value="">DISTRITO</option>');

            $('#canton').html('');
            $('#canton').append('<option disabled="" hidden="" selected="selected" value="">CANTON</option>');
            var url = "{{ route('api.cantones', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (canton !== undefined && (value.CODIGOCANTON_C == canton || value.NAME == canton) ) {
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                        $('#canton').trigger('change', distrito);
                    }else{
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            });
        });

        $(".cantones").on('change', function(event, distrito) {
            $('#distrito').html('');
            if ($(this).children("option:selected").val() != 0) {
                $('#distrito').prop('disabled', false);
            }

            $('#distrito').append('<option disabled="" hidden="" selected="selected" value="">DISTRITO</option>');
            var url = "{{ route('api.distritos', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (distrito !== undefined && (value.CODIGODISTRITO_C == distrito || value.NAME == distrito) ) {
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                    }else{
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            }); 
        });

        $.get("{{ route('api.provincias') }}", function(data, status){
            $.each(data, function( index, value ) {
                $('#provincia').append('<option value="'+value.CODIGOPROVINCIA+'" name="' + value.NAME + '">'+value.NAME+'</option>'); 
            });
        });
        

        $('#btn_continuar').on('click', function(){
            if (validateId($('#nueva_cedula').val())){
                if(moment().diff($("#fechanacimiento").val(), 'years')  >= 18 ){
                    var form = $( "#form_afiliarse" );
                    form.validate({
                        errorClass: 'ng-invalid',
                    });
                    var formData = $('#form_afiliarse').serialize();
                    if (form.valid() && validarTelefonoID($('#nueva_cedula').val(),$('#tipo_id').val(),$('#telefono').val())) {
                        $('.loading').show();
                        $.ajax({
                            type:'POST',
                            url:"{{ route('afiliarse.post') }}",
                            data: formData,
                            success:function(data){
                                $('.loading').hide();
                                window.location.replace(data);
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                if (XMLHttpRequest.status == 403) {
                                    $('.loading').hide();
                                    swal({
                                        title: "Lo sentimos",
                                        text: XMLHttpRequest.responseJSON.message,
                                        icon: "error",
                                        button: "Entendido",
                                    });
                                }else{
                                    $('.loading').hide();
                                    swal({
                                        title: "Lo sentimos",
                                        text: 'Ocurrió un error, intente mas tarde',
                                        icon: "error",
                                        button: "Entendido",
                                    });
                                }
                            }   
                        });
                    }else{
                        swal({
                            title: "Información requerida",
                            text: 'Por favor completa toda la información que se solicita',
                            icon: "warning",
                            button: "Entendido",
                        });
                        $(".previous").click();
                        $('.loading').hide();
                    }
                }else{
                    $('.loading').hide();
                    $(".previous").click();
                    swal({
                        title: "Lo sentimos",
                        text: "Debes ser mayor de edad para ser titular de un plan Medismart.",
                        icon: "error",
                        button: "Entendido",
                    });
                }
            }else{
                $('.loading').hide();
            }
        });

        function validateId(id) {
            var re = '^[a-zA-Z0-9]*$';
            if (id.match(re) == null) {
                swal({
                    title: "Lo sentimos",
                    text: "El número de identificación solamente puede contener letras y números.",
                    icon: "error",
                    button: "Entendido",
                });
                $(".previous").click();
                return false;
            }

            if($("#tipo_id").val()=="1"){
                if(id.length != 9){
                    swal({
                        title: "Lo sentimos",
                        text: "El número de identificación nacional solamente puede tener 9 digitos.",
                        icon: "error",
                        button: "Entendido",
                    });
                    $(".previous").click();
                    return false;
                }  
            }

            if($("#tipo_id").val()=="2"){
                if(id.length > 12){
                    swal({
                        title: "Lo sentimos",
                        text: "El número de identificación extranjero es de maximo 12 digitos.",
                        icon: "error",
                        button: "Entendido",
                    });
                    $(".previous").click();
                    return false;
                }  
            }


            return true;
        }

        $("#tipo_id").bind("change",function(){
            $("#nueva_cedula").val("");
            $('#nueva_cedula').trigger("keyup");
            
            switch($("#tipo_id").val()){
                case "1":
                    $("#nueva_cedula").prop('maxLength', 9);
                break;
                case "2":
                    $("#nueva_cedula").prop('maxLength', 12);
                break;
                case "2":
                    $("#nueva_cedula").prop('maxLength', 20);
                break;
            }
        });


        //buscar por cedula
        $('#nueva_cedula').keyup(function () {

                $.ajax({
                    type:'POST',
                    url:"{{ route('buscar.cedula') }}",
                    data:{'cedula':$(this).val()},
                    success:function(data){
                        var d = JSON.parse(data);
                        $.each(d.records, function( index, value ) {
                            if(value.found == "yes") {
                                $('#nombre').val(value.nombre);
                                $('#apellido1').val(value.apellido1);
                                $('#apellido2').val(value.apellido2);

                                //fecha nacimiento
                                $("#fechanacimiento").val(value.fechaNacimiento);

                                //genero
                                var genero = (value.genero == 'M') ? 'Masculino' : 'Femenino';
                                $("#genero option:selected").prop("selected",false);
                                $("#genero option[value=" + genero + "]").prop("selected",true);

                                //provincia canton distrito
                                $("#provincia option:selected").prop("selected",false);
                                $("#provincia option[name='" + value.provincia + "']").prop("selected",true);
                                $("#provincia").trigger('change', [value.canton, value.distrito]);
                            }else{
                                $('#nombre').val("");
                                $('#apellido1').val("");
                                $('#apellido2').val("");

                                //fecha nacimiento
                                $("#fechanacimiento").val("");

                                $("#genero option:selected").prop("selected",false);

                                $("#provincia option:selected").prop("selected",false);
                            }
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        
                    }   
                });
            
        });
    });
</script>
@endsection