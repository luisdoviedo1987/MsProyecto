@extends('layout.master-new')

@section('css')
  <link rel="stylesheet" href="{{ asset('control/assets/css/plan-inteligente.css')}}" />
  <link rel="stylesheet" href="{{ asset('control/assets/css/form-first-register.css')}}" />
  <script src="https://kit.fontawesome.com/c8b72b653d.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="{{ asset('control/assets/css/informacion-pago.css')}}">
  <link rel="stylesheet" href="{{ asset('control/assets/css/card.css')}}">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')
<div class="loading" style="display: none;">Loading&#8230;</div>

<section class="container-fluid py-3 py-lg-5 bg_planes">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="title text-center">
            Informacion <br />
            <span class="black_font"> de pago</span>
          </h1>
          <p class="text-center subtitle">
            Revisá a continuación los datos de tu afiliación, previo al
            procesamiento de pago:
          </p>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-12">
          <div class="card card_planes p-4 max-450">
            <div class="row">
              <div class="col-12 col-lg-4 d-flex">
                <div class="circle m-auto">
                  <img src="{{ asset('control/assets/img/icon-user.svg')}}" alt="Referidos" class="icon_planes" />
                </div>
              </div>
              <div class="col-12 col-lg-7 offset-lg-1 text-lg-start">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Id afiliado</td>
                      <td><strong> {{$cli}}</strong> </td>
                    </tr>
                    <tr>
                      <td>Nombre</td>
                      <td><strong>{{$nombre}} </strong> </td>
                    </tr>
                    <tr>
                      <td>Cedula</td>
                      <td><strong>{{$cedula}} </strong> </td>
                    </tr>
                    <tr>
                      <td>Telefono</td>
                      <td><strong> {{$telefono}}</strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row my-5">
        <div class="card card_planes_resume p-4 max-1080">
        <h3 class="title text-center">
            Resumen <span class="black_font"> de pedido</span>
          </h3>
          <!-- tabla de resumen-->

          <div class="table-responsive">
            <table class="table">
               <thead>
                  <tr>
                     <th scope="col">Descripcion</th>
                     <th scope="col">Cantidad</th>
                     <th scope="col">Costo</th>
                     <th scope="col">IVA</th>
                     <th scope="col">Sub total</th>
                  </tr>
               </thead>
               <tbody>
                    <?php $itemNumber = 1; $addOncoBen = false; $addBene = false; $addPet = false; $totalCosto = 0; $totalIva = 0; $totalSubtotal = 0; ?>
                    @foreach ($shoppingcart as $key => $value)
                        @if ($value->id == 'ADDPLAN')

                            <tr>
                                <th scope="row">
                                    <h6>{{$plan}} titular</h6>
                                    <small>{{$nombre}}</small>
                                </th>
                                <td>1</td>
                                <td>${{ $value->price }}</td>
                                <td>${{ sprintf('%0.2f', round(($value->price * 0.13), 2)) }}</td>
                                <td>${{ sprintf('%0.2f', round((($value->price * 0.13) + $value->price), 2)) }}
                                    {{-- <i class="fas fa-trash-alt mx-3"></i> --}}
                                </td>
                            </tr>

                            <?php $itemNumber++; $totalCosto += $value->price; $totalIva += $value->price * 0.13; $totalSubtotal += ($value->price * 0.13) + $value->price; ?>
                        @endif

                        @if ($value->id == 'ADDBENE' && !$addBene)

                            <tr>
                                <th scope="row">
                                    <h6>Beneficiarios adicionales</h6>
                                </th>
                                <td>{{ $totalBene }}</td>
                                <td>${{ $value->price * $totalBene }}</td>
                                <td>${{ sprintf('%0.2f', round( (($value->price * $totalBene) * 0.13), 2)) }}</td>
                                <td>${{ sprintf('%0.2f', round( (($value->price * $totalBene) * 0.13) + ($value->price * $totalBene), 2) ) }}
                                    {{-- <i class="fas fa-trash-alt mx-3"></i> --}}
                                </td>
                            </tr>
                            <?php $itemNumber++; $addBene = true; $totalCosto += $value->price * $totalBene; $totalIva += ($value->price * $totalBene) * 0.13; $totalSubtotal += (($value->price * $totalBene) * 0.13) + ($value->price * $totalBene); ?>
                        @endif

                        @if ($value->id == 'ADDPET' && !$addPet)

                            <tr>
                                <th scope="row">
                                    <h6>Mascotas adicionales</h6>
                                </th>
                                <td>{{ $totalPet }}</td>
                                <td>${{ $value->price * $totalPet }}</td>
                                <td>${{ sprintf('%0.2f', round( (($value->price * $totalPet) * 0.13), 2) ) }}</td>
                                <td>${{ sprintf('%0.2f', round( (($value->price * $totalPet) * 0.13) + ($value->price * $totalPet), 2) ) }}
                                    {{-- <i class="fas fa-trash-alt mx-3"></i> --}}
                                </td>
                            </tr>
                            <?php $itemNumber++; $addPet = true; $totalCosto += $value->price * $totalPet; $totalIva += ($value->price * $totalPet) * 0.13; $totalSubtotal += (($value->price * $totalPet) * 0.13) + ($value->price * $totalPet); ?>
                        @endif

                        @if ($value->id == 'ADDONCOAFIL' && !$addPet)

                            <tr>
                                <th scope="row">
                                    <h6>Plan oncosmart Afiliado</h6>
                                    <small>{{$nombre}}</small>
                                </th>
                                <td>1</td>
                                <td>${{ $value->price * $value->qty }}</td>
                                <td>${{ sprintf('%0.2f', round( (($value->price * $value->qty) * 0.13), 2) ) }}</td>
                                <td>${{ sprintf('%0.2f', round( (($value->price * $value->qty) * 0.13) + ($value->price * $value->qty), 2) ) }}
                                    {{-- <i class="fas fa-trash-alt mx-3"></i> --}}
                                </td>
                            </tr>
                            <?php $itemNumber++; $totalCosto += $value->price * $value->qty; $totalIva += ($value->price * $value->qty) * 0.13; $totalSubtotal += (($value->price * $value->qty) * 0.13) + ($value->price * $value->qty); ?>
                        @endif

                        @if ($value->id == 'ADDONCOBEN' && !$addPet)

                            <tr>
                                <th scope="row">
                                    <h6>Plan oncosmart Beneficiarios</h6>
                                </th>
                                <td>{{ $totalOncoBene }}</td>
                                <td>${{ $value->price * $totalOncoBene }}</td>
                                <td>${{ sprintf('%0.2f', round( (($value->price * $totalOncoBene) * 0.13), 2) ) }}</td>
                                <td>${{ sprintf('%0.2f', round( (($value->price * $totalOncoBene) * 0.13) + ($value->price * $totalOncoBene), 2) ) }}
                                    {{-- <i class="fas fa-trash-alt mx-3"></i> --}}
                                </td>
                            </tr>
                            <?php $itemNumber++; $addOncoBen = true; $totalCosto += $value->price * $totalOncoBene; $totalIva += ($value->price * $totalOncoBene) * 0.13; $totalSubtotal += (($value->price * $totalOncoBene) * 0.13) + ($value->price * $totalOncoBene); ?>
                        @endif
                    @endforeach

                    @if ($porcentajeDescuento != '0' )
                        <tr>
                            <th scope="row">
                            </th>
                            <td></td>
                            <td></td>
                            <td> Descuento <br> aplicado</td>
                            <td> {{$porcentajeDescuento}}% </td>
                        </tr> 
                    @endif
                  <tr>
                     <th scope="row">
                     </th>
                     <td></td>
                     <td></td>
                     <td> Sub total</td>
                     <td> ${{$totalCosto}}</td>
                  </tr>
                  <tr>
                     <th scope="row">
                     </th>
                     <td></td>
                     <td></td>
                     <td> IVA</td>
                     <td> ${{$totalIva}}</td>
                  </tr>
                  <tr>
                     <th scope="row">
                     </th>
                     <td></td>
                     <td></td>
                     <td>Total</td>
                     <td id="montoTotal">${{ $totalOp }}</td>
                  </tr>
               </tbody>
            </table>

            <center> * El monto total a pagar por tú plan es de <b>${{$totalOp}}</b>, según la frecuencia de pago seleccionada <b>{{$plan}}</b>.<br>
              * El monto que se te cobrara esta primera vez es de <b>${{$prorrateo}}</b>.
            </center>
         </div>
          <input type="hidden" name="montoTotal" id="montoTotalvalue" value="{{$totalOp}}">
        </div>
      </div>
      <div class="pt-5">
        <form action="" id="formCard">
          <div class="row">
            <div class="col-lg-6">
              <div class='card-wrapper'></div>
            </div>
            <div class="col-lg-6">
              <h2>Datos de la tarjeta</h2>
                {{ csrf_field() }}
                <input type="hidden" value="{{$cli}}" name="cli" />
                <input type="hidden" value="0" name="retry" id="retry" />

                <fieldset>
                  <div class="form-floating">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Juan Perez" required>
                    <label for="name">Nombre del titular</label>
                  </div>

                  <select class="form-control" name="type" id="type" required>
                    <option value="" hidden>Seleccione un tipo de tarjeta</option>
                    <option value="Visa">Visa</option>
                    <option value="Mastercard">Mastercard</option>
                    <option value="Amex">American Express</option>
                    <option value="Discover">Discover</option>
                  </select>
                  <div class="form-floating">
                    <input type="text" name="number" id="number" class="form-control" placeholder="Número de tarjeta" required>
                    <label for="number">Número de tarjeta</label>
                  </div>

                  <div class="d-block d-lg-flex justify-content-between">
                    <div class="form-floating">
                      <input type="text" name="expiry" id="expiry" class="form-control" placeholder="Fecha de expiración" required>
                      <label for="expiry">Fecha de expiración</label>
                    </div>
                    <div class="form-floating">
                      <input type="text" name="cvc" id="cvc" class="form-control" placeholder="Código de seguridad" required>
                      <label for="cvc">Código de seguridad</label>
                    </div>
                  </div>
                </fieldset>
            </div>
          </div>

          <br />
          <br />

          <div class="row d-flex justify-content-center">
            <div class="card bg_light_blue card_planes p-4 max-800">
              <div class="row">
                <h2 class="white text-center">Verifica tu <br> <span class="black_font"> número de teléfono </span> </h2>
                <div class="d-block d-lg-flex justify-content-center">
                    <input type="hidden" value="{{$idValidacion}}" name="validacion" id="validacion">
                    <input type="hidden" value="{{$body}}" name="body" id="body">
                    <div class="form-floating sms_div">
                        <input type="text" name="codigosms" id="codigosms" class="form-control white input_sms" placeholder="Código de seguridad">
                        <label for="codigosms" class="d-none">Código de seguridad</label>
                    </div>
                    <div class="my-3 text-center">
                        <button class="btn btn-sms mx-3" id="reenviar">Reenviar SMS</button>
                    </div>
                </div>
                <p class="white text-center max-450">Hemos enviado un código de verificación a
                  tu número de teléfono celular {{$telefono}}</p>
              </div>
    
            </div>
          </div>
    
          <div class="row d-flex justify-content-center">
              <div class="col-sm-7 d-flex justify-content-center"><div style="margin-top:10px;" class="g-recaptcha" data-sitekey="6LcBrCMaAAAAAEMRA56V2FyaJiDw6v-rEkaM1Nef"></div></div>
          </div>
    
          <div class="row d-flex justify-content-center">
            <label class="text-center">
              <input type="checkbox" class="checkbox" id="tyc" />
              <span class="checkmark"></span>
              <span class="text-checkbox">
                He leído y acepto <a href="#">los términos y condiciones</a> y el
                <a href="#"> contrato</a> de servicios MediSmart
              </span>
            </label>
            <div class="m-2">
              <div class="d-flex justify-content-center my-3">
                <a class="btn btn-primary mx-2" href="#" id="pagar" type="button">Pagar</a>
              </div>
            </div>
          </div>

        </form>
      </div>
    </div>
  </section>
@endsection

@section('js')
<script src="{{ asset('control/assets/js/utils.js')}}"></script>
<script src="{{ asset('control/assets/js/card.js')}}"></script>
<script src="{{ asset('control/assets/js/placeHolderCard.js')}}"></script>

<script>
    $(document).ready(function(){
        fbq('track', 'InitiateCheckout');

        $('#reenviar').on('click', function(){
            variable = {
                        "idvalidacion" : $("#validacion").val()
                        };

            // $('#modal_loading').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('reenviar.sms') }}",
                    data: variable,
                    success:function(data){
                        $("#validacion").val(data.idSms);
                        $("#body").val(data.body);

                        $('#modal_loading').modal('hide');

                        rmss(false,'Éxito', 'Operación realizada, el código de verificación fue reenviado correctamente!'); 
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        $('#modal_loading').modal('hide');

                    }   
                });
        });


        $('#pagar').on('click', function(){
            var form = $( "#formCard" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#formCard').serialize();
            if (form.valid()) {
              if ($('#expiry').val().length == 9){
                $('.loading').show();

                if($("#retry").val()== 3){
                  swal({
                      title: "Lo sentimos",
                      text: 'Lo sentimos tu transacción no puede ser procesada!',
                      icon: "error",
                      button: "Entendido",
                  });
                    setTimeout(function() {
                            window.location.replace("https://medismart.net/control/");
                        }, 3000);
                    return;
                }

                // $('#modal_loading').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('afiliar.tarjeta') }}",
                    data: formData,
                    success:function(data){
                        $('.loading').hide();

                        rmss(false,'Éxito', 'Operación realizada, en breve se enviará tu factura al correo'); 
                        setTimeout(function() {
                            window.location.replace(data.url);
                        }, 3000);

                        fbq('track', 'Purchase', {
                            value: $("#montoTotalvalue").val().replace("$", ""),
                            currency: 'USD',
                            content_ids: 'Compra realizada',
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        $('.loading').hide();
                        
                        grecaptcha.reset();
                        if (XMLHttpRequest.status == 403) {
                          swal({
                              title: "Lo sentimos",
                              text: XMLHttpRequest.responseJSON.message,
                              icon: "error",
                              button: "Entendido",
                          });
                            counter = parseInt($("#retry").val()) + 1;
                            $("#retry").val(counter);
                        }else{
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
                      title: "Lo sentimos",
                      text: 'El formato de fecha de la tarjeta es incorrecto!',
                      icon: "error",
                      button: "Entendido",
                  });
              }
            }
        });
    });
</script>
@endsection