@extends('layout.master-new')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}" />
@endsection

@section('content')

<section class="container-fluid p-0">
    @if(isset($affiliateCodes))
        <img src="{{ asset($affiliateCodes->imagePath) }}" alt="Afiliarme a MediSmart" class="img-fluid d-none d-md-block">
        <img src="{{ asset($affiliateCodes->responsiveImage) }}" alt="Afiliarme a MediSmart" class="img-fluid d-block d-md-none">
    @else
        <img src="{{ asset('control/assets/img/feb2023/BannerFEB20_Web-1920x700.png') }}" alt="Afiliarme a MediSmart" class="img-fluid d-none d-md-block">
        <img src="{{ asset('control/assets/img/feb2023/BannerFEB20_PopUp.png') }}" alt="Afiliarme a MediSmart" class="img-fluid d-block d-md-none"> 
    @endif
</section>
<section class="container">
    <div class="my-5">
        <h1 class="title text-center max-450">
            Elegí como beneficiarte del
            <strong class="light-blue">Plan Inteligente</strong>
        </h1>

        <div class="row">
            <div class="col-lg-4 my-8">
                <!-- <img src="https://medismart.net/control/assets/img/mayo2022/Desc_Boton_01.png" style="float: right;margin-top: -50px;/* margin-bottom: 50px; */"> -->
                <div class="bg_green card_plan_main p-3">
                    <h2 class="text-center white">
                        Plan <br><strong> Mensual</strong>
                    </h2>
                    <p class="white text-center">Desde: <span class="price">$13.56*</span></p>
                    <div class="d-flex">
                        <div class="col d-flex justify-content-center ">
                            <p class="text-start white">Beneficiarios <br> adicionales por</p>
                        </div>
                        <div class="col d-flex justify-content-center ">
                            <p class="text-start white">$6.78 al mes c/u</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <small class="white text-center max-450">* 10% de descuento se aplica únicamente para afiliaciones
                            web y se aplica al final de la transacción.</small>
                    </div>
                    <div class="my-4 d-flex justify-content-center">
                        <a id="btn_mensual" class="btn-afiliarme-card light-blue" href="{{ isset($affiliateCodes) ? route('afiliarse', ['plan'=>'mensual', 'code'=> $affiliateCodes->pageCode ]) : route('afiliarse', ['plan'=>'mensual'])}}">Afiliarme</a>

                    </div>
                    <div class="circle p-1">
                        <img src="{{ asset('control/assets/img/plan-circle-mensual.png') }}" alt="Plan Mensual" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-8">
                <!-- <img src="https://medismart.net/control/assets/img/mayo2022/Desc_Boton_02.png" style="float: right;margin-top: -50px;/* margin-bottom: 50px; */"> -->
                <div class="bg_purple card_plan_main p-3">
                    <h2 class="text-center white">
                        Plan <br><strong> Semestral</strong>
                    </h2>
                    <p class="white text-center">Desde: <span class="price">$81.36*</span></p>
                    <div class="d-flex">
                        <div class="col d-flex justify-content-center ">
                            <p class="text-start white">Beneficiarios <br> adicionales por</p>
                        </div>
                        <div class="col d-flex justify-content-center ">
                            <p class="text-start white">$40.68 al semestre c/u</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <small class="white text-center max-450">* 10% de descuento se aplica únicamente para afiliaciones
                            web y se aplica al final de la transacción.</small>
                    </div>
                    <div class="my-4 d-flex justify-content-center">
                        <a  id="btn_semestral" class="btn-afiliarme-card purple" href="{{ isset($affiliateCodes) ? route('afiliarse', ['plan'=>'semestral', 'code'=> $affiliateCodes->pageCode ]) : route('afiliarse', ['plan'=>'semestral'])}}">Afiliarme</a>

                    </div>
                    <div class="circle p-1">
                        <img src="{{ asset('control/assets/img/plan-circle-semestral.png') }}" alt="Plan Semestral" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 my-8">
                <!-- <img src="https://medismart.net/control/assets/img/mayo2022/Desc_Boton_03.png" style="float: right;margin-top: -50px;/* margin-bottom: 50px; */"> -->
                <div class="bg_orange card_plan_main p-3">
                    <h2 class="text-center white">
                        Plan <br><strong> Anual</strong>
                    </h2>
                    <p class="white text-center">Desde: <span class="price">$162.72*</span></p>
                    <div class="d-flex">
                        <div class="col d-flex justify-content-center ">
                            <p class="text-start white">Beneficiarios <br> adicionales por</p>
                        </div>
                        <div class="col d-flex justify-content-center ">
                            <p class="text-start white">$81.36 al año c/u</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <small class="white text-center max-450">* 10% de descuento se aplica únicamente para afiliaciones
                            web y se aplica al final de la transacción.</small>
                    </div>
                    <div class="my-4 d-flex justify-content-center">
                        <a  id="btn_anual" class="btn-afiliarme-card orange" href="{{ isset($affiliateCodes) ? route('afiliarse', ['plan'=>'anual', 'code'=> $affiliateCodes->pageCode ]) : route('afiliarse', ['plan'=>'anual'])}}">Afiliarme</a>

                    </div>
                    <div class="circle p-1">
                        <img src="{{ asset('control/assets/img/plan-circle-anual.png') }}" alt="Plan Anual" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
  fbq('track', 'InitiateCheckout');
</script>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script src="{{ asset('control/assets/js/utils.js') }}"></script>
@endsection