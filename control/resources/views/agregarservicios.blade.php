@extends('layout.master-new')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('control/assets/css/plan-inteligente.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('control/assets/css/sidebar.css') }}">
@endsection

@section('content')
<div class="loading" style="display: none;">Loading&#8230;</div>

<?php 
  $totalCountBene = 1;  
  $totalCountPet = 1;
  $frecPago = "PLAN MENSUAL";
  foreach ($shoppingcart as $key => $value) {
      if ($value->name == "Plan"){
          switch ($value->id){
              case "mensual": $frecPago = "PLAN MENSUAL"; break;
              case "semestral": $frecPago = "PLAN SEMESTRAL"; break;
              case "anual": $frecPago = "PLAN ANUAL"; break;
          }
      }
  }
?>

<section class="container-fluid py-3 py-lg-5 bg_planes">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1 class="title text-center">
            Tu plan <br />
            <span class="black_font"> inteligente</span>
          </h1>
          <p class="text-center subtitle max-800">
            Agrega a tus beneficiarios al plan general o al plan OncoSmart por
            un monto adicional.
            Además, conseguí beneficios para tu mascota con el plan mascotas.
          </p>
        </div>
      </div>
      <div class="row my-3">
        <div class="col-md-6 col-lg-6 my-3">
          <div class="card py-4 card_planes max-450 px-2">
            <div class="circle m-auto">
              <img src="{{ asset('control/assets/img/icon-beneficiarios-adicionales.svg') }}" alt="Beneficiarios adicionales" class="icon_planes" />
            </div>
            <h3 class="title_planes text-center py-2">
              Beneficiarios <br />
              <span class="black_font"> adicionales</span>
            </h3>
            <button class="btn-planes-price">Desde $6.78 c/u</button>
            <p class="text-center py-3">
              Afiliá un amigo o familiar para que tenga las mismas
              condiciones que vos ¡A un mejor precio!
            </p>
            <button class="btn btn-cta" type="button" data-bs-toggle="modal" data-bs-target="#modalBeneficiarios">
              Añadir <i class="fas fa-plus-circle mx-2"></i>
            </button>
            <p class="text-center pt-2 cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalListaBeneficiarios">Lista de beneficiarios</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 my-3">
          <div class="card py-4 card_planes max-450 px-2"">
            <div class=" circle m-auto">
            <img src="{{ asset('control/assets/img/icon-mascotas.svg') }}" alt="Beneficiarios adicionales" class="icon_planes" />
          </div>
          <h3 class="title_planes text-center py-2">
            Agregar <br />
            <span class="black_font"> mascotas</span>
          </h3>
          <button class="btn-planes-price">Desde $2.26 c/u</button>
          <p class="text-center py-3">
            Conseguí hasta un 80% de beneficio en citas, <br />
            vacunas y ¡mucho más!
          </p>
          <button class="btn btn-cta" type="button" data-bs-toggle="modal" data-bs-target="#modalMascotas">
            Añadir <i class="fas fa-plus-circle mx-2"></i>
          </button>
          <p class="text-center pt-2 cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalListaMascotas">Lista de mascotas</p>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-12">
        <div class="card card_planes p-4 max-800 px-2"">
            <div class=" row">
          <div class="col-12 col-lg-4 col-md-4 d-flex">
            <div class="circle m-auto">
              <img src="{{ asset('control/assets/img/icon-referidos.svg') }}" alt="Referidos" class="icon_planes" />
            </div>
          </div>
          <div class="col-12  col-lg-7 col-md-7 col-offset-md-1 offset-lg-1 text-lg-start text-center">
            <h3 class="title_planes py-2">Referidos</h3>
            <p class="">
              ¡Si tenés un código de referido colocalo aquí y ganá!
            </p>
            <button class="btn btn-cta" data-bs-toggle="modal" data-bs-target="#modalReferidos">
              Añadir <i class="fas fa-plus-circle mx-2"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="row my-5">
      <div class="m-2">
        <div class="d-flex justify-content-center my-3">
          <a class="btn btn-secondary mx-2" href="/" type="button">Volver</a>
          <a class="btn btn-primary mx-2" onclick="showSideBar()" type="button">Siguiente</a>
        </div>
      </div>
    </div>
    </div>

</section>

<!--modals-->

  <!--Modals -->
  <section class="modals">

    <!-- Modal beneficiarios -->
    <div class="modal fade" id="modalBeneficiarios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollabl">
        <div class="modal-content card card_planes">
          <div class="modal-header">
            <div class="m-auto title_circle_Card">
              <div class="circle m-auto">
                <img src="{{ asset('control/assets/img/icon-beneficiarios-adicionales.svg') }}" alt="Beneficiarios adicionales" class="icon_planes" />
              </div>
              <div class="text-center">
                <h3 class="title_planes text-center py-2">
                  Agregar <br />
                  <span class="black_font"> Beneficiarios</span>
                </h3>
                <button class="btn-planes-price">Desde $6.78 c/u</button>
                <div class="stepper-wrapper my-3 stepBeneficiarios">
                  <div class="stepper-item completed">
                    <div class="step-counter"></div>
                    <small class="step-name">Cantidad beneficiarios</small>
                  </div>
                  <div class="stepper-item completed">
                    <div class="step-counter"></div>
                    <small class="step-name">Beneficiario 1</small>
                  </div>
                </div>
              </div>


            </div>
          </div>
          <div class="modal-body">
            <form method="get" class="form_planes form_planes_mascotas" id="beneficiarios">
                <fieldset class="fieldset_main">
                  <input type="number" class="form-control cantidadFormControl" id="cantidadBeneficiarios" min="1" max="10" placeholder="¿Cuántos beneficiarios desea agregar?" />
                  <div class="my-3 text-center">
                    <button type="button" class="btn btn-secondary btn_close_clean" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary next" id="nextBeneficiarioCantidad" >Siguiente</button>
                  </div>
                </fieldset>
                <!-- los demas fieldset se generan dinamicos -->
              </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Mascotas -->
    <div class="modal fade" id="modalMascotas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollabl">
        <div class="modal-content card card_planes">
          <div class="modal-header">
            <div class="m-auto title_circle_Card">
              <div class="circle m-auto">
                <img src="{{ asset('control/assets/img/icon-mascotas.svg')}}" alt="Agregar mascotas" class="icon_planes" />
              </div>
              <div class="text-center">
                <h3 class="title_planes text-center py-2">
                  Agregar <br />
                  <span class="black_font"> Mascotas</span>
                </h3>
                <button class="btn-planes-price">Desde $2.26 c/u</button>
                <div class="stepper-wrapper my-3 stepMascotas">
                  <div class="stepper-item completed">
                    <div class="step-counter"></div>
                    <small class="step-name">Cantidad de mascotas</small>
                  </div>
                  <div class="stepper-item completed">
                    <div class="step-counter"></div>
                    <small class="step-name">Mascota 1</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <form method="get" class="form_mascotas form_planes_mascotas" id="mascotas">
                <fieldset>
                  <input type="number" class="form-control cantidadFormControl" id="cantidadMascotas" min="1" max="10" placeholder="¿Cuántas mascotas desea agregar?" />
                  <div class="my-3 text-center">
                    <button type="button" class="btn btn-secondary btn_close_clean" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary next" id="nextMascotasCantidad">Siguiente</button>
                  </div>
                </fieldset>
                <!-- los demas fieldset se generan dinamicos -->
              </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Referidos -->
    <div class="modal fade" id="modalReferidos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollabl">
        <div class="modal-content card card_planes">
          <div class="modal-header">
            <div class="m-auto title_circle_Card">
              <div class="circle m-auto">
                <img src="{{ asset('control/assets/img/icon-referidos.svg') }}" alt="Agregar Referidos" class="icon_planes" />
              </div>
              <div class="text-center">
                <h3 class="title_planes text-center py-2">
                  Agregar <br />
                  <span class="black_font"> Codigo de referidos</span>
                </h3>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <form method="get" class="form_referidos">
              <fieldset>
                <input type="text" class="form-control" id="referido" placeholder="Código de referidos" />
                <div class="my-3 text-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Guardar</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    {{-- SABER SI EXISTEN BENEFICIARIOS --}}
    <?php $cntBeneficiarios = 0; ?>
    <!-- Modal lista de beneficiarios -->
    <div class="modal fade" id="modalListaBeneficiarios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollabl max-800">
        <div class="modal-content card card_planes ">
          <div class="modal-header">
            <div class="m-auto title_circle_Card">
              <div class="circle m-auto">
                <img src="{{ asset('control/assets/img/icon-beneficiarios-adicionales.svg') }}" alt="Lista de beneficiarios" class="icon_planes" />
              </div>
              <div class="text-center">
                <h3 class="title_planes text-center py-2">
                  Lista de <br />
                  <span class="black_font">Beneficiarios</span>
                </h3>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cédula</th>
                            <th scope="col">Plan OncoSmart</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyBeneficiarios">
                        @foreach ($shoppingcart as $key => $value)
                            @if ($value->id == 'ADDBENE')
                                <?php $cntBeneficiarios++; ?>
                                <tr id="{{ $value->options->cedula }}">
                                    <td class="text-center">{{ $value->options->nombre }}</td>
                                    <td class="text-center">{{ $value->options->cedula }}</td>
                                    <td class="text-center"><input type="checkbox" {{ isset($value->options->oncosmart) ? 'checked' : '' }} class="form-contro" /></td>
                                    <td class="text-center"><i class="fas fa-trash-alt mx-3 eliminarBeneficiario" cedula="{{ $value->options->cedula }}"></i></td>
                                </tr>
                                <?php $totalCountBene++;  ?>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="m-auto text-center">

              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $cntMascotas = 0; ?>
    <!-- Modal lista de mascotas -->
    <div class="modal fade" id="modalListaMascotas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollabl max-800">
        <div class="modal-content card card_planes">
          <div class="modal-header">
            <div class="m-auto title_circle_Card">
              <div class="circle m-auto">
                <img src="{{ asset('control/assets/img/icon-mascotas.svg') }}" alt="Lista de mascotas" class="icon_planes" />
              </div>
              <div class="text-center">
                <h3 class="title_planes text-center py-2">
                  Lista de <br />
                  <span class="black_font">Mascotas</span>
                </h3>
              </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Especie</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyMascotas">
                        @foreach ($shoppingcart as $key => $value)
                            @if ($value->id == 'ADDPET')
                                <?php $cntMascotas++; ?>
                                <!---->
                                <tr>
                                    <td class="text-center">{{$value->options->nombre}}</td>
                                    <td class="text-center">{{$value->options->raza}}</td>
                                    <td class="text-center">{{$value->options->edad}}</td>
                                    <td class="text-center"><i class="fas fa-trash-alt mx-3 eliminarmascota" nombre="{{$value->options->nombre}}"></i></td>
                                </tr>

                                <?php $totalCountPet++; ?>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="m-auto text-center">

              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>


  <!-- End Sections -->
  </section>



<!--The acutal content of the sidebar-->
<div class="sidebar text-gris" id="sidebar">
  <div class="container-liner">
    <div class="card">
        <div class="card-header bg-white mt-5 border-0">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <div class="">
                        <h5>
                            <b>
                            Resumen de pedido
                            </b> 
                        </h5>
                    </div>
                    <div class="cntBeneShow" style="{{ $cntBeneficiarios == 0 ? 'display: none' : '' }}">
                        <p><strong class="cntBeneficiarios">{{ $cntBeneficiarios }}</strong> beneficiarios agregados</p>
                    </div>
                    <div id="cntMasShow" {{ $cntMascotas == 0 ? 'style="display: none"' : '' }}>
                        <p><strong id="cntMascotas">{{ $cntMascotas }}</strong> mascotas agregadas</p>    
                    </div>
                </div>
                <a class="btn" onclick="toggleSidebar()">
                    <i class="far fa-times-circle fa-2x text-secondary"></i>
                </a>
            </div>
            <div class="text-gris-d mt-4" style="border-bottom: 1px solid;"></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless text-gris">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">
                                <div class="d-block d-sm-block d-md-none">
                                    <i class="far fa-arrow-alt-circle-right fa-2x"></i>
                                </div>
                            </th>
                        <th scope="col"></th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Sub total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <th scope="row">
                                <img src="{{ asset('control/assets/img/icon.svg') }}" alt="Titular" class="icon_planes">
                            </th>
                            <td class="text-start pb-4">
                                <h5>{{ucwords(strtolower($plan))}} titular</h5>
                                {{$datos->options->nombre . ' ' . $datos->options->apellido1 . ' ' . $datos->options->apellido2}}
                            </td>
                            <td>1</td>
                            <td>${{$datos->price}}</td>
                        </tr>
                        <tr class="cntBeneShow" style="{{ $cntBeneficiarios == 0 ? 'display: none' : '' }}">
                            <th scope="row">
                                <img src="{{ asset('control/assets/img/icon.svg') }}" alt="Beneficiarios adicionales" class="icon_planes">
                            </th>
                            <td class="text-start pb-4">
                                <h5>Beneficiarios adicional</h5>
                                <div id="datosBeneficiarios">
                                    <?php $precioBeneficiario = 0; ?>
                                    @foreach ($shoppingcart as $key => $value)
                                        @if ($value->id == 'ADDBENE')
                                            {{ $value->options->nombre . ' ' . $value->options->apellido1 . ' ' . $value->options->apellido2  }}
                                            <br>
                                            <?php $precioBeneficiario = $value->price; ?>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td class="cntBeneficiarios">{{ $cntBeneficiarios }}</td>
                            <td class="precioBeneficiarios">{{ '$' . ($cntBeneficiarios * $precioBeneficiario) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">
                              <img src="{{ asset('control/assets/img/icon.svg') }}" alt="Beneficiarios adicionales" class="icon_planes">
                            </th>
                            <td class="text-start pb-4">
                                <h5>Plan OncoSmart</h5>
                                <div class="planOncoSmart">
                                    <?php 
                                        $precioOncoBene = 0;
                                        $totalCntOncoBene = 0;
                                     ?>
                                     @foreach ($shoppingcart as $value)
                                          @if ($value->id == 'ADDONCOBEN')
                                              <?php 
                                                $precioOncoBene = $value->price;
                                                $totalCntOncoBene++;
                                              ?>
                                          @elseif ($value->id == 'ADDONCOAFIL')
                                              <?php 
                                                $precioOncoBene = $value->price;
                                                $totalCntOncoBene++;
                                              ?>
                                          @endif
                                      @endforeach
                                    
                                    @foreach ($shoppingcart as $value)
                                        @if ($value->id == 'ADDONCOBEN')
                                            @foreach ($shoppingcart as $valueBen)
                                                @if ($valueBen->id == 'ADDBENE' && $valueBen->options->cedula == $value->options->cedula)
                                                    {{ $valueBen->options->nombre . ' ' . $valueBen->options->apellido1 . ' ' . $valueBen->options->apellido2  }}
                                                    <br>
                                                @endif
                                            @endforeach
                                        @elseif ($value->id == 'ADDONCOAFIL')
                                            @foreach ($shoppingcart as $valuePlan)
                                                @if ($valuePlan->id == 'ADDPLAN')
                                                    {{ $valuePlan->options->nombre . ' ' . $valuePlan->options->apellido1 . ' ' . $valuePlan->options->apellido2  }}
                                                    <br>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td class="cntPlanOncoSmart">{{$totalCntOncoBene}}</td>
                            <td class="totPlanOncoSmart">{{ '$' . ($totalCntOncoBene * $precioOncoBene) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">
                              <img src="{{ asset('control/assets/img/icon.svg') }}" alt="Beneficiarios adicionales" class="icon_planes">
                            </th>
                            <td class="text-start pb-4">
                                <h5>Mascotas</h5>
                                <div class="planMascotas">
                                    <?php 
                                        $precioMascotas = 0; 
                                        $totalCntMascotas = 0;
                                    ?>
                                    @foreach ($shoppingcart as $key => $value)
                                        @if ($value->id == 'ADDPET')
                                            {{ $value->options->nombre }}
                                            <br>
                                            <?php 
                                                $precioMascotas = $value->price; 
                                                $totalCntMascotas++; 
                                            ?>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td class="cntPlanMascotas">{{$totalCntMascotas}}</td>
                            <td class="totPlanMascotas">{{ '$' . ($totalCntMascotas * $precioMascotas) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="search-wrapper cf d-flex justify-content-around align-items-center">
                                    <input type="text" class="text-gris" value="" style="box-shadow: none" id="codigo_promocion" name="codigo_promocion">
                                    <button type="button" id="aplicar_promocion">Aplicar</button>
                                </div>
                            </td>
                            <th>Descuento</th>
                            <td id="porcentaje-descuento">$0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
              <div class="col-12" id="descuento-mensaje"></div>
            </div>
        </div>

        @php
            $subTotal = round(($totalCntOncoBene * $precioOncoBene) + ($totalCntMascotas * $precioMascotas) + ($cntBeneficiarios * $precioBeneficiario) +  $datos->price, 2);
            $impuestos = round(($subTotal * 13) / 100, 2);
            $totalPagar = round($subTotal + $impuestos, 2);
        @endphp

        <div class="card-footer text-center bg-white border-0">
            <table class="table table-borderless text-gris">
                <tfoot class="text-end">
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td class="border-bottom">Subtotal</td> 
                                <td class="border-bottom subTotalPagar">${{ $subTotal }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td class="border-bottom">IVA </td>
                                <td class="border-bottom impuestosPagar">$ {{ $impuestos }}</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td class="border-bottom">Total</td>
                                <td class="border-bottom totalPagar">${{ $totalPagar }}</td>
                            </tr>
                </tfoot>
            </table>

          <label class="text-center">
            <input type="checkbox" class="checkbox" id="tyc" />
            <span class="checkmark"></span>
            <span class="text-checkbox">
              He leído y acepto <a href="https://medismart.net/wp-content/uploads/2021/03/TERMINOS-Y-CONDICIONES-MEDISMART-PLAN-DE-MEDICINA-PREPAGADA.pdf">los términos y condiciones</a> y el <a href="https://medismart.net/wp-content/uploads/2021/03/CONTRATO-DE-SERVICIOS-DE-MEDISMART-AFILIACION.pdf"> contrato</a> de servicios
              MediSmart
            </span>
          </label>
          <br>
          <button type="button" id="btncontinuar" class="btn btn-primary btn-block px-10">Proceder a pagar</button>
        </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script src="{{ asset('control/assets/js/sidebar.js')}}"></script>
<script src="{{ asset('control/assets/js/utils.js')}}"></script>
<script src="{{ asset('control/assets/js/cantidadBeneficiario.js')}}"></script>
<script src="{{ asset('control/assets/js/cantidadMascota.js')}}"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    var cantidadBeneficiarios = 0;
    var precioOncoBene = "{{$precioOncoBene}}";
    var planPrecio = "{{$datos->price}}";
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


    function btn_new_ben(){
        if (cantidadBeneficiarios > 1) {
            for (var i = 1; i <= cantidadBeneficiarios; i++) {
                var cedula1 = $('#cedula_'+i).val();
                for (var j = i+1; j <= cantidadBeneficiarios; j++) {
                    if (cedula1 == $('#cedula_'+j).val()) {
                      swal({
                          title: "Lo sentimos",
                          text: 'Las cédulas de los beneficiarios se repiten, por favor corrija la información antes de continuar.',
                          icon: "error",
                          button: "Entendido",
                      });
                      return;
                    }
                }
            }
        }

        for (var i = 1; i <= cantidadBeneficiarios; i++) {
            var form = $( "#beneficiarios" );
            var cedulaBen = $('#cedula_'+i).val();
            var nombreBen = $('#nombre_'+i).val();

            form.validate({
                errorClass: 'ng-invalid',
            });
            
            if (form.valid() && validarTelefonoID($('#cedula_'+i).val(), $('#tipo_id_'+i).val(), $('#telefono_'+i).val())) {
                //create the form data
                fd = new FormData();
                fd.append( 'tipo_id', $('#tipo_id_'+i).val());
                fd.append( 'cedula', $('#cedula_'+i).val());
                fd.append( 'nombre', $('#nombre_'+i).val());
                fd.append( 'apellido1', $('#apellido1_'+i).val());
                fd.append( 'apellido2', $('#apellido2_'+i).val());
                fd.append( 'fechanacimiento', $('#fechanacimiento_'+i).val());
                fd.append( 'genero', $('#genero_'+i).val());
                fd.append( 'telefono', $('#telefono_'+i).val());
                fd.append( 'parentesco', $('#parentesco_'+i).val());
                fd.append( 'provincia', $('#provincia_'+i).val());
                fd.append( 'canton', $('#canton_'+i).val());
                fd.append( 'distrito', $('#distrito_'+i).val());
                fd.append( 'email', $('#email_'+i).val());
                if ($('#oncosmart_'+i).is(':checked')){
                    fd.append( 'oncosmart', $('#oncosmart_'+i).is(':checked'));
                }
                fd.append( 'cntBen', i);

                $.ajax({
                    async: false,
                    type:'POST',
                    url:"{{ route('agregar.beneficiario') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $('.cntBeneShow').show();
                        $('.cntBeneficiarios').html(parseFloat($('.cntBeneficiarios').html()) + 1);

                        $('.precioBeneficiarios').html('$' + parseFloat($('.cntBeneficiarios').html()) * data.precio);
                        $('#datosBeneficiarios').append(`
                            ${data.data.nombre} ${data.data.apellido1} ${data.data.apellido2}<br>
                        `);
                        $('#tbodyBeneficiarios').append(`<tr id="{{ $value->options->cedula }}">
                            <td class="text-center">${data.data.nombre}</td>
                            <td class="text-center">${data.data.cedula}</td>
                            <td class="text-center"><input type="checkbox" ${data.data.oncosmart == 1 ? 'Si' : 'No'} class="form-contro" /></td>
                            <td class="text-center"><i class="fas fa-trash-alt mx-3 eliminarBeneficiario" cedula="${data.data.cedula}"></i></td>
                        </tr>
                        `);

                        //con oncosmart
                        if (data.data.oncosmart){
                            $('.cntPlanOncoSmart').html(parseFloat($('.cntPlanOncoSmart').html()) + 1);
                            $('.totPlanOncoSmart').html('$' + (parseFloat($('.totPlanOncoSmart').html().replace('$', '' )) + data.precioOnco).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, ''));
                        }

                        if (data.data.cntBen == cantidadBeneficiarios){
                            $('.modal').modal('hide') // closes all active pop ups.
                            $('.modal-backdrop').remove() // removes the grey overlay.
                            document.getElementById("beneficiarios").reset();
                            showSideBar();
                        }

                        precioOncoBene = data.precioOnco;
                        var totPlanOncoSmart = ( parseFloat($('.totPlanOncoSmart').html().replace('$', '' )) ).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var totBeneficiarios = ( parseFloat($('.precioBeneficiarios').html().replace('$', '' )) ).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var totMascotas = (parseFloat($('.totPlanMascotas').html().replace('$', '' ))).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var subTotal = (parseFloat(totBeneficiarios) + parseFloat(totPlanOncoSmart) + parseFloat(totMascotas) + parseFloat(planPrecio)).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var impuestos = ((subTotal * 13) / 100 ).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var totalPagar = (parseFloat(subTotal) + parseFloat(impuestos)).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');

                        $('.subTotalPagar').html("$" + subTotal);
                        $('.impuestosPagar').html("$" + impuestos);
                        $('.totalPagar').html("$" + totalPagar);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                      if (XMLHttpRequest.status == 403) {
                          swal({
                              title: "Lo sentimos",
                              text: XMLHttpRequest.responseJSON.message,
                              icon: "error",
                              button: "Entendido",
                          });
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
            }
        }
    }

    var cantidadMascotas = 0;
    function btn_new_mas() {
        for (var i = 1; i <= cantidadMascotas; i++) {
            var form = $( "#mascotas" );
            form.validate({
                errorClass: 'ng-invalid',
            });
           
            if (form.valid()) {
                //create the form data
                fd = new FormData();
                fd.append( 'especie', $('#especie_'+i).val());
                fd.append( 'raza', $('#raza_'+i).val());
                fd.append( 'nombre', $('#nombreMascota_'+i).val());
                fd.append( 'edad', $('#edad_'+i).val());
                fd.append( 'color', $('#color_'+i).val());
                fd.append( 'genero', $('#sexo_'+i).val());
                fd.append( 'cntMas', i);

                $.ajax({
                    async: false,
                    type:'POST',
                    url:"{{ route('agregar.mascota') }}",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success:function(data){
                        $('#cntMasShow').show();
                        $('#cntMascotas').html(parseFloat($('#cntMascotas').html()) + 1);

                        $('.planMascotas').append(`
                            ${data.data.nombre} <br>
                        `);

                        $('#tbodyMascotas').append(`
                        <tr>
                            <td class="text-center">${data.data.nombre}</td>
                            <td class="text-center">${data.data.raza}</td>
                            <td class="text-center">${data.data.edad}</td>
                            <td class="text-center"><i class="fas fa-trash-alt mx-3 eliminarmascota" nombre="${data.data.nombre}"></i></td>
                        </tr>
                        `);

                        $('.cntPlanMascotas').html(parseFloat($('.cntPlanMascotas').html()) + 1);
                        $('.totPlanMascotas').html('$' + (parseFloat($('.totPlanMascotas').html().replace('$', '' )) + data.precio).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, ''));

                        if (data.data.cntMas == cantidadMascotas){
                            $('.modal').modal('hide') // closes all active pop ups.
                            $('.modal-backdrop').remove() // removes the grey overlay.
                            document.getElementById("mascotas").reset();
                            showSideBar();
                        }

                        var totPlanOncoSmart = ( parseFloat($('.totPlanOncoSmart').html().replace('$', '' )) ).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var totBeneficiarios = ( parseFloat($('.precioBeneficiarios').html().replace('$', '' )) ).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var totMascotas = (parseFloat($('.totPlanMascotas').html().replace('$', '' ))).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var subTotal = (parseFloat(totBeneficiarios) + parseFloat(totPlanOncoSmart) + parseFloat(totMascotas) + parseFloat(planPrecio)).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var impuestos = ((subTotal * 13) / 100 ).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');
                        var totalPagar = (parseFloat(subTotal) + parseFloat(impuestos)).toFixed(2).replace(/(\.0*|(?<=(\..*))0*)$/, '');

                        $('.subTotalPagar').html("$" + subTotal);
                        $('.impuestosPagar').html("$" + impuestos);
                        $('.totalPagar').html("$" + totalPagar);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                      swal({
                          title: "Lo sentimos",
                          text: 'Ocurrió un error, intente mas tarde',
                          icon: "error",
                          button: "Entendido",
                      });
                    }   
                });
            }
        }
    }

    function showSideBar(){
        $("#sidebar").toggleClass("move-to-left");
        $("#sidebar-tab").toggleClass("move-to-left");
        $("main").toggleClass("move-to-left-partly");
        $(".arrow").toggleClass("active");
    }
    
    $( document ).ready(function() {

        $('#showconfirmmodal').on('click', function(){
            if ($('#flexCheckDefault').is(":checked")){
                var promocion = $('#codigo_promocion').val();
                var referido = $('#referido').val();

                if (referido == ""){
                    referido = 0;
                }
                if (promocion == ""){
                    promocion = 0;
                }

                var url = '{{ route("agregarservicios", ["modal"=>"1"]) }}'+'/'+referido+'/'+promocion
                window.location.replace(url);

            }else{
                alert("Por favor acepta los términos y condiciones para continuar")
            }
        });

        @if ($showmodal)
            $('#confirm_modal').modal('show');
        @endif

        $(document.body).on('change', '.provincias', function(event, canton, distrito) {
            var provincia_id = $(this).attr('id').split("_");
            var i = provincia_id[1];
            $('#distrito_'+i).html('');
            $('#distrito_'+i).append('<option disabled="" hidden="" selected="selected" value="">DISTRITO</option>');
            $('#distrito_'+i).prop('disabled', 'disabled');

            $('#canton_'+i).html('');
            $('#canton_'+i).append('<option disabled="" hidden="" selected="selected" value="">CANTON</option>');

            var url = "{{ route('api.cantones', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (canton !== undefined && (value.CODIGOCANTON_C == canton || value.NAME == canton) ) {
                        $('#canton_'+i).append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                        $('#canton_'+i).trigger('change', distrito);
                    }else{
                        $('#canton_'+i).append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            });
        });

        $(document.body).on('change', '.cantones', function(event, distrito) {
            var canton_id = $(this).attr('id').split("_");
            var i = canton_id[1];
            $('#distrito_'+i).html('');
            if ($(this).children("option:selected").val() != 0) {
                $('#distrito_'+i).prop('disabled', false);
            }

            $('#distrito_'+i).append('<option disabled="" hidden="" selected="selected" value="">DISTRITO</option>');
            
            var url = "{{ route('api.distritos', ['distelec' => 999]) }}";
            url = url.replace("999", $(this).children("option:selected").val());
            $.get(url, function(data, status){
                $.each(data, function( index, value ) {
                    if (distrito !== undefined && (value.CODIGODISTRITO_C == distrito || value.NAME == distrito) ) {
                        $('#distrito_'+i).append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                    }else{
                        $('#distrito_'+i).append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            }); 
        });

        $('#nextBeneficiarioCantidad').on('click', function(){
            $.get("{{ route('api.provincias') }}", function(data, status){
                $('.provincias').append('<option value="" disabled="" selected="">Provincia</option>');
                $.each(data, function( index, value ) {
                    for (var i = 1; i <= cantidadBeneficiarios; i++) {
                        $('#provincia_'+i).append('<option value="'+value.CODIGOPROVINCIA+'" name="' + value.NAME + '">'+value.NAME+'</option>'); 
                    }
                });
            });
        });

        $('#aplicar_promocion').on('click', function(){
          var frecPago = '{{ $frecPago }}';
          var promocion = $('#codigo_promocion').val();
          $.ajax({
                type:'POST',
                url:"{{ route('consultar-promocion') }}",
                data: { 'promocion': promocion, 'frecPago':frecPago },
                success:function(data){
                  $.each(data, function(i, data){
                      if(data.exist && data.valid && data.descuento > 0){
                        $('#porcentaje-descuento').html(data.descuento + '%');
                        $('#descuento-mensaje').html('');
                      }else{
                        $('#porcentaje-descuento').html('');
                        $('#descuento-mensaje').html(data.msg);
                      }
                  });
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  swal({
                      title: "Lo sentimos",
                      text: 'Ocurrió un error, intente mas tarde',
                      icon: "error",
                      button: "Entendido",
                  });
                }   
            });
        });

        $('.oncosmartafiliado').change(function() {
            var agregar = 0;
            if (this.checked){
                agregar = 1;
            }

            cedula = $(this).attr('cedula');
            $.ajax({
                type:'POST',
                url:"{{ route('agregar.oncosmart.afiliado') }}",
                data: { 'cedula':cedula, 'agregar': agregar },
                success:function(data){
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  swal({
                      title: "Lo sentimos",
                      text: 'Ocurrió un error, intente mas tarde',
                      icon: "error",
                      button: "Entendido",
                  });
                }   
            });
        });

        $('.oncosmart').change(function() {
            var agregar = 0;
            if (this.checked){
                agregar = 1;
            }

            cedula = $(this).attr('cedula');
            $.ajax({
                type:'POST',
                url:"{{ route('agregar.oncosmart') }}",
                data: { 'cedula':cedula, 'agregar': agregar },
                success:function(data){
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  swal({
                      title: "Lo sentimos",
                      text: 'Ocurrió un error, intente mas tarde',
                      icon: "error",
                      button: "Entendido",
                  });
                }   
            });      
        });

        $('#btncontinuar').on('click', function(){            
            if ($('#tyc').is(':checked')){
                var promocion = $('#codigo_promocion').val();
                var referido = $('#referido').val();
                $('.loading').show();
                $.ajax({
                    type:'POST',
                    url:"{{ route('agregarservicios.post') }}",
                    data: { 'promocion':promocion, 'referido': referido },
                    success:function(data){
                        $('.loading').hide();
                        window.location.replace(data.url);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        $('.loading').hide();
                        if (XMLHttpRequest.status == 403) {
                          swal({
                              title: "Lo sentimos",
                              text: XMLHttpRequest.responseJSON.message,
                              icon: "error",
                              button: "Entendido",
                          });
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
            }else {
              $('.loading').hide();
              swal({
                  title: "Lo sentimos",
                  text: 'Debes aceptar los términos y codiciones y el contrato de servicios.',
                  icon: "error",
                  button: "Entendido",
              });
            }
        });

        //buscar por cedula
        $('#cedula').keyup(function () {
            if ($(this).val().length > 5) {

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
                                $("#fechanacimiento").datepicker("setDate", value.fechaNacimiento);

                                //genero
                                var genero = (value.genero == 'M') ? 'Masculino' : 'Femenino';
                                $("#genero option:selected").prop("selected",false);
                                $("#genero option[value=" + genero + "]").prop("selected",true);

                                //provincia canton distrito
                                $("#provincia option:selected").prop("selected",false);
                                $("#provincia option[name='" + value.provincia + "']").prop("selected",true);
                                $("#provincia").trigger('change', [value.canton, value.distrito]);
                            }
                        });
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        
                    }   
                });
            }
        });
        
    });

    $(document).on('click',".eliminarmascota", function(){
        nombre = $(this).attr('nombre');
        $.ajax({
            type:'POST',
            url:"{{ route('eliminar.mascota') }}",
            data: { 'nombre':nombre },
            success:function(data){
                window.location.replace('{{route('agregarservicios')}}');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                
            } 
        });
    });

    $(document).on('click', '.eliminarBeneficiario', function(){
        cedula = $(this).attr('cedula');
        $.ajax({
            type:'POST',
            url:"{{ route('eliminar.beneficiario') }}",
            data: { 'cedula':cedula },
            success:function(data){
                window.location.replace('{{route('agregarservicios')}}');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                
            } 
        });
    });
</script>
@endsection