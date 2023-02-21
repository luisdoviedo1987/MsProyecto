@extends('layout.master')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4" id="gform_1">  
            <div id="gform_page_1_1">
                <h2 style="text-align:center; color: #0098d6" >GENERACIÓN DE CONTRASEÑA</h2>
                <p style="color:#6c757d; text-align:center">Si sos afiliado, pero no tenés cuenta para acceder a la Autogestión MediSmart, estás en el lugar indicado:</p>
                <div class="col-md-12 mt-12"></div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-6 p-1" style="line-height: 27px;">
                    <!---->
                        <a href="{{ route('soytitular') }}" class="gform_previous_button justify-content-center" style="cursor: pointer; text-align:center!important;">SOY TITULAR</a>
                    <!---->
                    </div>
                    <div class="col-12 col-sm-6 p-1" style="line-height: 27px;">
                    <!---->
                        <a href="{{ route('soybeneficiario')}}" class="gform_next_button button justify-content-center" style="cursor: pointer; pointer-events: auto; text-align:center!important;">BENEFICIARIO</a>
                    <!---->
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</div>

@endsection