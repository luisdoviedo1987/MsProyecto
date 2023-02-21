<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}"/>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-55800306-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-55800306-1');
        </script>

        <title>Medismart | Autogestion</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('control/images/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('control/images/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('control/images/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('control/images/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('control/images/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('control/images/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('control/images/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('control/images/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('control/images/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ URL::asset('control/images/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('control/images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('control/images/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('control/images/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ URL::asset('control/images/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ URL::asset('control/images/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#0c3648">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ URL::asset('control/css/msstylesprod.css') }}?20220718-2">

        @yield('css')

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   
        <style>
        label{
            font-size: 16px
        }
        .nav-link{
            display: block;
            width: 100%;
            padding: .25rem 1.5rem!important;
            clear: both;
            font-weight: 400!important;
            font-size: 14px!important;
            color: #606060!important;
            text-align: inherit;
            white-space: nowrap;
            background: 0 0;
            border: 0;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .dropdown-item {
            display: block;
            margin-left: 15px;
            width: 100%;
            padding: .25rem 1.5rem!important;
            clear: both;
            font-weight: 400!important;
            font-size: 14px!important;
            color: #606060!important;
            text-align: inherit;
            white-space: nowrap;
            background: 0 0;
            border: 0;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        @media only screen and (max-width: 1200px) {
            #nav-menu-master {
                display: none;
            }
        }
        </style>
    </head>
    <body>
        <!-- Start header -->
        <div class="w-100 p-0 m-0 mscolor site-content-contain">
            <div class="container">
            <div id="et-info">
                <div class="row">
                    
                      
                        <div class="col-xs-12 col-sm-6 mstextwhite">
                            <i class="fa fas fa-phone" aria-hidden="true"></i>
                            <span>&nbsp;
                                <a href="tel:+50625285400" style="color: #fff !important;text-decoration: none;font-weight: 500;">2528-5400</a> | <a href="tel:+50622114444" style="color: #fff !important;text-decoration: none;font-weight: 500;"> 2211-4444</a>
                                &nbsp; &nbsp; 
                            </span>
                            </div> 
                            <div class="col-xs-12 col-sm-6 mstextwhite ">

                            <a href="mailto:info@medismart.net" style="color: #fff !important;text-decoration: none;font-weight: 500;">
                                <i class="fa fas fa-envelope" aria-hidden="true"></i>&nbsp;
                                <span>info@medismart.net</span>
                            </a>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

     <!--    <div class="w-100 p-0 m-0 site-content-contain" style="border-bottom: 1px solid #73d8d0!important;box-shadow: 0 0 7px rgba(0,0,0,.1)!important; -moz-box-shadow: 0 0 7px rgba(0,0,0,.1)!important; -webkit-box-shadow: 0 0 7px rgba(0,0,0,.1)!important;"> -->

            <div class="w-100 p-0 m-0 site-content-contain" style="">
            <div class="container mt3 d-lg-none d-xl-none">
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <div class="row p-0 mt-1">
                            <div class="col-sm-12">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <img alt="MediSmart"  onclick="irperfil()" class="custom-logo justify-content-center" style="max-width: 40% !important" src="{{ asset('control/images/cropped-logomedismart-11-300x131-2.png') }}">
                                    @if ((isset($data->getData()->afiliado) && !$data->getData()->afiliado) || (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual'))
                                    @else
                                        <a href="{{ route('carrito') }}" class="cart position-relative d-inline-flex mt-3 cart-margin-vertically" style="color: #ed2980 !important; vertical-align: middle;" aria-label="View your shopping cart">
                                            <i class="fas fa fa-shopping-cart fa-lg"></i>
                                            <span class="cart-basket d-flex align-items-center justify-content-center cart-basket-count">
                                                {{ Cart::count() }}
                                            </span>
                                        </a>
                                    @endif
                                    <button class="navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarColor03">
                                        <ul class="navbar-nav">
                                            <li class="nav-item {{url()->current() == route('perfil') ? 'active' : ''}}"> <a class="nav-link"  href="{{ route('perfil') }}">PERFIL </a> </li>
                                            <li class="nav-item"><a class="nav-link {{url()->current() == route('servicios') ? 'active' : ''}}"  href="{{ route('servicios') }}"> AGREGAR SERVICIOS </a></li>
                                            <li class="nav-item"><a class="nav-link" onclick="ircitas();"> AGENDAR CITA </a></li>
                                            <li class="nav-item"><a class="nav-link" onclick="irvalidacion();"> VALIDACIÓN DE CITA </a></li>
                                            <li class="nav-item"><a class="nav-link" onclick="irprecios();"> VER PRECIOS Y SERVICIOS </a></li>

                                             
                                          
                                            <!-- <li class="nav-item dropdown">
                                                <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  REFERINOS  </a>
                                                <ul class="dropdown-menu"  style="padding:0px">
                                                    <li><a class="dropdown-item" href="{{ route('referidos') }}"> GANÁ</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('consulta.referidos') }}"> REFERENCIAS </a></li>
                                                    <li><a class="dropdown-item" href="{{ route('consulta.regalias') }}"> REGALIAS </a></li>
                                                </ul>
                                            </li> -->

                                            <li class="nav-item dropdown">
                                                <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown">  BENEFICIOS ADICIONALES  </a>
                                                <ul class="dropdown-menu"  style="padding:0px">
                                                    <li><a class="dropdown-item"  onclick="irFarmaciaOnline();"> FARMACIA ONLINE</a></li>
                                                    <li><a class="dropdown-item"  onclick="irClubSmart();"> CLUB SMART </a></li>
                                                    <li><a class="dropdown-item"  onclick="irOrientacionMedica();"> ORIENTACIÓN MÉDICA TELEFÓNICA </a></li>
                                                    <li><a class="dropdown-item"  onclick="irMedicoDomicilio();"> MÉDICO A DOMICILIO </a></li>

                                                </ul>
                                            </li>

                                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}""> CERRAR SESION </a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-3 d-none d-lg-block">
                <div class="row">
                    <div class="col-sm-3">
                        <a onclick="irperfil()" style="cursor: pointer" ><img alt="MediSmart" class="custom-logo" style="max-width: 50%;" src="{{ asset('control/images/cropped-logomedismart-11-300x131-2.png') }}"></a>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="row p-0 m-0">
                            <div class="col-sm-8 offset-sm-1">
                                <div class="d-none d-lg-block" style="border: 2px solid #73d8d0;border-radius: 50px;">
                                    <form action="/buscador-de-precios/" class="searchform" style="text-align:center" id="searchform" method="get" novalidate="" role="search">
                                        <div>
                                        <input style="border-bottom: none !important; color: #a682bf; font-size:13px; font-weight:500" type="submit" value="Buscador de precios y servicios médicos">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row p-0 mt-1">
                            <div class="col-sm-12">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarColor03">
                                        <ul class="navbar-nav">
                                            @if ((isset($data->getData()->afiliado) && !$data->getData()->afiliado) || (isset($data->getData()->frecuenciaPago) && $data->getData()->frecuenciaPago == 'Mensual'))
                                            @else
                                                <li class="nav-item px-3 text-uppercase mb-0 position-relative d-lg-flex mt-2">
                                                    <div id="cart" class="d-none"></div>
                                                    <a href="{{ route('carrito') }}" class="cart position-relative d-inline-flex" aria-label="View your shopping cart">
                                                        <i class="fas fa fa-shopping-cart fa-lg"></i>
                                                        <span class="cart-basket d-flex align-items-center justify-content-center cart-basket-count">
                                                            {{ Cart::count() }}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 mstextwhite">
                        <a class="gform_logout_button button justify-content-center" style="cursor: pointer; pointer-events: auto; text-align:center!important; font-size:15px" href="{{ route('logout') }}">CERRAR SESION</a>
                    </div>
                    <div class="col-sm-1 mstextwhite"></div>
                </div>
            </div>
        </div>
        <!-- Finish header -->

        <div class="container d-none d-sm-block">
            <div class="col-md-12 m-0 p-0">
                <img alt="" src="https://medismart.net/control/images/banner-web2.gif" style="max-width:100%">
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-4 navbar-column" id="nav-menu-master">
                    <app-autogestion-navbar _nghost-gej-c5="">
                        <div class="autogestion">
                            <div class="col-12 menu_autogestion">
                                <div aria-orientation="vertical" class="row nav nav-pills" id="v-pills-tab" role="tablist">
                                    {{-- <input id="menu_afiliado" type="checkbox" class="ng-untouched ng-pristine ng-valid" {{ (url()->current() == route('perfil') || url()->current() == route('misbenes') || url()->current() == route('tarjetas') || url()->current() == route('carnet')) ? 'checked' : ''}}/>
                                    <label class="col-12 nav-link" for="menu_afiliado" style="color: #0d3648 !important;background-color: #fff !important;">
                                        <span class="icon iconAfiliado"></span> MI CUENTA 
                                        <i class="fas fa-sort-down"></i>
                                    </label> --}}
                                    <label class="col-12 nav-link ng-star-inserted" onclick="irperfil();" style="color: #0d3648 !important;background-color: #fff !important;" for="menu_agendar_citas">
                                        <span class="icon iconAgregados" ></span> PERFIL
                                    </label>
                                    {{-- <a aria-controls="v-pills-gestion_informacion"
                                        aria-selected="true"
                                        class="menu_afiliado col-12 nav-link {{url()->current() == route('perfil') ? 'active' : ''}}" 
                                        id="v-pills-gestion_informacion-tab" 
                                        routerlink="/perfil"
                                        routerlinkactive="active"
                                        href="{{ route('perfil') }}"
                                    >
                                        <span class="icon iconPerfil"></span> PERFIL
                                    </a> --}}
                                    {{-- @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                                    @else
                                        <!---->
                                        <a aria-controls="v-pills-gestion_informacion"
                                            aria-selected="true"
                                            class="menu_afiliado col-12 nav-link ng-star-inserted {{url()->current() == route('misbenes') ? 'active' : ''}}" 
                                            id="v-pills-gestion_informacion-tab" 
                                            routerlink="/misbenes"
                                            routerlinkactive="active"
                                            href="{{ route('misbenes') }}"
                                        >
                                            <span class="icon iconBene"></span> MIS BENEFICIARIOS
                                        </a>
                                        <!---->
                                        <a aria-controls="v-pills-informacion_pagos"
                                            aria-selected="true"
                                            class="menu_afiliado col-12 nav-link ng-star-inserted {{url()->current() == route('tarjetas') ? 'active' : ''}}" 
                                            id="v-pills-informacion_pagos-tab" 
                                            routerlink="/tarjetas"
                                            routerlinkactive="active"
                                            href="{{ route('tarjetas') }}"
                                        >
                                            <span class="icon iconPagos"></span> INFORMACIÓN PAGOS
                                        </a>
                                    @endif --}}
                                    {{-- @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                                    @else
                                        <a aria-controls="v-pills-carnets"
                                            aria-selected="true"
                                            class="menu_afiliado col-12 nav-link {{url()->current() == route('carnet') ? 'active' : ''}}" 
                                            href="{{ route('carnet') }}"
                                            id="v-pills-carnets-tab" 
                                            routerlinkactive="active"
                                        >
                                            <span class="icon iconCarnet"></span> CARNETS
                                        </a>
                                    @endif --}}
                                    {{-- @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                                    @else
                                        <!---->
                                        <input id="menu_agregados" type="checkbox" class="ng-untouched ng-pristine ng-valid ng-star-inserted" {{ (url()->current() == route('oncosmart') || url()->current() == route('beneficiario') || url()->current() == route('mascotas')) ? 'checked' : ''}} />
                                        <!---->
                                        <label class="col-12 nav-link ng-star-inserted" style="color: #0d3648 !important;background-color: #fff !important;" for="menu_agregados">
                                             <span class="icon fas fa-user-plus" style="margin-left:10px" ></span> AGREGAR SERVICIOS <i class="fas fa-sort-down"></i>
                                        </label>
                                        <!---->
                                        <a aria-controls="v-pills-messages"
                                            aria-selected="false"
                                            class="menu_agregados col-12 nav-link ng-star-inserted {{url()->current() == route('oncosmart') ? 'active' : ''}}"  
                                            routerlink="/oncosmart"
                                            routerlinkactive="active"
                                            href="{{ route('oncosmart') }}"
                                        >
                                            <span class="icon iconAgregados"></span> ONCOSMART
                                        </a>
                                        <!---->
                                        <a aria-controls="v-pills-profile"
                                            aria-selected="false"
                                            class="menu_agregados col-12 nav-link ng-star-inserted {{url()->current() == route('beneficiario') ? 'active' : ''}}"  
                                            routerlink="/beneficiario"
                                            routerlinkactive="active"
                                            href="{{ route('beneficiario') }}"
                                        >
                                            <span class="icon iconBene"></span> BENEFICIARIOS
                                        </a>
                                        <!---->
                                        <a aria-controls="v-pills-messages"
                                            aria-selected="false"
                                            class="menu_agregados col-12 nav-link ng-star-inserted {{url()->current() == route('mascotas') ? 'active' : ''}}"  
                                            routerlink="/mascotas"
                                            routerlinkactive="active"
                                            href="{{ route('mascotas') }}"
                                        >
                                            <span class="icon iconMascotas"></span> MASCOTAS
                                        </a>
                                    @endif --}}
                                    @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                                    @else
                                        <label class="col-12 nav-link ng-star-inserted" onclick="irservicios();" style="color: #0d3648 !important;background-color: #fff !important;" for="menu_agendar_citas">
                                            <span class="icon iconAgregados" ></span> AGREGAR SERVICIOS
                                        </label>
                                    @endif

                                    <label class="col-12 nav-link ng-star-inserted" onclick="ircitas();" style="color: #0d3648 !important;background-color: #fff !important;" for="menu_agendar_citas">
                                        <span class="icon fas fa-calendar-check" ></span> AGENDAR CITAS
                                    </label>

                                    <label class="col-12 nav-link ng-star-inserted" onclick="irvalidacion();" style="color: #0d3648 !important;background-color: #fff !important;" for="menu_agendar_citas">
                                        <span class="icon fas fa-hospital-o" ></span> VALIDACIÓN DE CITA
                                    </label>
                                    <!---->

                                    <label class="col-12 nav-link ng-star-inserted" onclick="irprecios();" style="color: #0d3648 !important;background-color: #fff !important;" for="menu_precios_servicios">
                                        <span class="icon fas fa-hand-holding-usd"></span> VER PRECIOS Y SERVICIOS
                                    </label>
                                    <!---->

                                    @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                                    @else
                                        <!---->
                                        <!-- <input id="menu_referidos" type="checkbox" class="ng-untouched ng-pristine ng-valid ng-star-inserted" {{ (url()->current() == route('referidos') || url()->current() == route('consulta.referidos') || url()->current() == route('consulta.regalias') ) ? 'checked' : ''}} />
                                        <label class="col-12 nav-link ng-star-inserted" style="color: #73d8d0 !important;background-color: #fff !important;" for="menu_referidos">
                                            <span class="icon iconReferidos"></span> REFERINOS <i class="fas fa-sort-down"></i>
                                        </label>
                                        <a class="menu_referidos col-12 nav-link ng-star-inserted {{url()->current() == route('referidos') ? 'active' : ''}}"   
                                            href="{{ route('referidos') }}">
                                            <span class="icon iconRefiere"></span> GANÁ
                                        </a>
                                        <a class="menu_referidos col-12 nav-link {{url()->current() == route('consulta.referidos') ? 'active' : ''}}"    
                                            href="{{ route('consulta.referidos') }}">
                                            <span class="icon iconConsulR"></span> REFERENCIAS
                                        </a>
                                        <a class="menu_referidos col-12 nav-link {{url()->current() == route('consulta.regalias') ? 'active' : ''}}"   
                                            href="{{ route('consulta.regalias') }}">
                                            <span class="icon iconConsulRe"></span> REGALIAS
                                        </a> -->
                                        <!---->
                                        
                                    @endif


                                        <!-- <input id="menu_ayuda" type="checkbox" class="ng-star-inserted" />
                                        
                                        <label class="col-12 nav-link ng-star-inserted" for="menu_ayuda" style="display: none;">AYUDA <i class="fas fa-sort-down"></i></label>
                                        <a aria-controls="v-pills-contactenos" aria-selected="true" class="menu_ayuda col-12 nav-link" data-toggle="pill" href="#v-pills-contactenos" id="v-pills-contactenos-tab" role="tab">CONTACTENOS</a>
                                        <a aria-controls="v-pills-informacion_uso" aria-selected="true" class="menu_ayuda col-12 nav-link" data-toggle="pill" href="#v-pills-informacion_uso" id="v-pills-informacion_uso-tab" role="tab">
                                            INFORMACION USO
                                        </a>
                                        <a aria-controls="v-pills-gestion_inconformidades"
                                            aria-selected="true"
                                            class="menu_ayuda col-12 nav-link" 
                                            href="#v-pills-gestion_inconformidades"
                                            id="v-pills-gestion_inconformidades-tab" 
                                        >
                                            GESTION INCONFORMIDADES
                                        </a> -->
                                        <!---->
                                        <!-- <input id="menu_ayuda" type="checkbox" class="ng-star-inserted" />
                                        <label class="col-12 nav-link ng-star-inserted" for="menu_ayuda" style="display: none;">AYUDA <i class="fas fa-sort-down"></i></label>
                                        <a aria-controls="v-pills-contactenos" aria-selected="true" class="menu_ayuda col-12 nav-link" data-toggle="pill" href="#v-pills-contactenos" id="v-pills-contactenos-tab" role="tab">CONTACTENOS</a>
                                        <a aria-controls="v-pills-informacion_uso" aria-selected="true" class="menu_ayuda col-12 nav-link" data-toggle="pill" href="#v-pills-informacion_uso" id="v-pills-informacion_uso-tab" role="tab">
                                            INFORMACION USO
                                        </a>
                                        <a aria-controls="v-pills-gestion_inconformidades"
                                            aria-selected="true"
                                            class="menu_ayuda col-12 nav-link" 
                                            href="#v-pills-gestion_inconformidades"
                                            id="v-pills-gestion_inconformidades-tab" 
                                        >
                                            GESTION INCONFORMIDADES
                                        </a> -->


                                      <!---->
                                        <input id="menu_ayuda" type="checkbox" class="ng-untouched ng-pristine ng-valid ng-star-inserted" {{ (url()->current() == route('beneficios')) ? 'checked' : ''}} />
                                        <!---->
                                        <label class="col-12 nav-link ng-star-inserted" style="color: #0d3648 !important;background-color: #fff !important;" for="menu_ayuda">
                                             <span class="icon fas fa-laugh-beam" style="margin-left:10px" ></span> BENEFICIOS ADICIONALES <i class="fas fa-sort-down"></i>
                                        </label>
                                        <!---->
                                        <a aria-controls="v-pills-messages"
                                            aria-selected="false"
                                            class="menu_ayuda col-12 nav-link ng-star-inserted"  
                                            onclick="irFarmaciaOnline();"
                                           
                                        >
                                            <span class="icon fas fa-pills"></span> FARMACIA ONLINE
                                        </a>
                                        <!---->
                                        <a aria-controls="v-pills-profile"
                                            aria-selected="false"
                                            class="menu_ayuda col-12 nav-link ng-star-inserted" 
                                            onclick="irClubSmart();"
                                        >
                                            <span class="icon fas fa-umbrella-beach"></span> CLUB SMART
                                        </a>
                                        <!---->
                                        <a aria-controls="v-pills-messages"
                                            aria-selected="false"
                                            class="menu_ayuda col-12 nav-link ng-star-inserted"
                                            onclick="irOrientacionMedica();"

                                        >
                                            <span class="icon fas fa-user-md"></span> ORIENTACIÓN MÉDICA TELEFÓNICA
                                        </a>
                                         <!---->
                                         <a aria-controls="v-pills-messages"
                                            aria-selected="false"
                                            class="menu_ayuda col-12 nav-link ng-star-inserted" 
                                            onclick="irMedicoDomicilio();"
                                        >
                                            <span class="icon fas fa-briefcase-medical"></span> MÉDICO A DOMICILIO
                                        </a>





                                </div>
                            </div>
                        </div>
                    </app-autogestion-navbar>
                </div>


                <div class="col-xs-12 col-lg-8" id="content-master">
                    @yield('content')
                </div>

            </div>
        </div>

        <div class="modal fade bd-loading-modal-lg" id="modal_loading" data-backdrop="static" data-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="width: 48px">
                    <span class="fa fa-spinner fa-spin fa-3x"></span>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="success_modal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE876;</i>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 id="success_modal_title">Excelente!</h4>
                        <p id="success_modal_subtitle">Your account has been created successfully.</p>
                        <div class="row" id="success_modal_body_buttons" style="display:none">
                            <div class="col-sm-12">
                                <div class="col-sm-6 offset-sm-6">
                                    <a class="gform_next_button button" id="success_modal_body_btn_carrito" >Ir al carrito &gt;&gt;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="error_modal" class="modal fade">
            <div class="modal-dialog modal-error">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 id="error_modal_title">Ooops!</h4>
                        <p id="error_modal_subtitle">Something went wrong. File was not uploaded.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirm-delete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="confirm-delete-title">Eliminar</h4>
                    </div>
                    <div class="modal-body">
                        <label id="confirm-delete-body">¿Estás seguro de eliminar el registro?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="gform_next_button button mr-3 btn-delete" data-dismiss="modal">Sí</button>
                        <a class="btn btn-danger" style="color:#fff" data-dismiss="modal">No </a>
                    </div>
                </div>
            </div>
        </div>

        <footer id="colophon" class="footer" style="margin-top:150px !important;">
            <div id="foo" class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 mt-5">
                            <div class="widget_text fwidget et_pb_widget widget_custom_html">
                                <h4 class="title">Contáctanos:</h4>
                                <div class="textwidget custom-html-widget">
                                    <h5 class="sub-footer">Servicio al cliente:</h5>
                                        <a class="telefonos" href="tel:+50625285400">+506 2528-5400</a>
                                    <br />
                                    <br />
                                    <h5 class="sub-footer">Ventas:</h5>
                                        <a class="telefonos" href="tel:+50622114444">+506 2211-4444</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mt-5">
                            <div class="widget_text fwidget et_pb_widget widget_custom_html">
                                <h4 class="title">Síguenos:</h4>
                                <div class="textwidget custom-html-widget">
                                    <div class="logos-sociales">
                                        <a href="https://www.facebook.com/medismartcr/" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/medismart-facebook.png') }}" alt="Facebook"></a>
                                        <a href="https://twitter.com/planmedismart" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/medismart-twitter.png') }}" alt="Twitter"></a>
                                        <a href="https://www.instagram.com/medismart.cr/" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/medismart-instagram.png') }}" alt="Instagram"></a>
                                    </div>
                                    <div class="logos-sociales">
                                        <a href="https://www.youtube.com/channel/UClZEq_9e6-SYKmCOcO7fDVg/videos" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/medismart-youtube.png') }}" alt="YouTube"></a>
                                        <a href="https://open.spotify.com/user/jgel3qhuudmtyiqm1rjs33brm?si=6mK2Y5rzQfi2HlIWSnZEjw" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/medismart-spotify.png') }}" alt="Spotify"></a>
                                        <a href="https://www.linkedin.com/company/medismart-cr/" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/medismart-linke.png') }}" alt="LinkedIn"></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mt-5">
                            <div class="fwidget et_pb_widget widget_nav_menu">
                                <h4 class="title">Nuestros planes:</h4>
                                <div class="menu-nuestros-planes-container">
                                    <ul class="menu">
                                        <li class="menu-item"><a href="https://medismart.net/plan-medismart/">Plan MediSmart</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/plan-empresarial/">Plan Empresarial</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/plan-oncosmart/">Plan OncoSmart</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/plan-maternidad/">Plan Maternidad</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/plan-mascotas/">Plan Mascotas</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mt-5">
                            <div class="fwidget et_pb_widget widget_nav_menu">
                                <h4 class="title">De interés:</h4>
                                <div class="menu-de-interes-container">
                                    <ul id="menu-de-interes" class="menu">
                                        <li class="menu-item"><a href="https://medismart.net/como-autogestionarme/">¿Como Autogestionarme?</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/acceso-medicos/">Acceso a Médicos</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/preguntas-frecuentes/">F.A.Q.</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/politica-privacidad/">Política de Privacidad</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/descarga-archivos/">Textos Legales</a></li>
                                        <li class="menu-item"><a href="https://medismart.net/contacto/">Contacto</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <br>
                        <div class="col-6 col-sm-4 col-md-1 mt-3 mb-5 p-4">
                            <img src="https://medismart.net/control/images/red-medica.png" style="max-width:150%">
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="https://medismart.net/control/images/hosp-metropolitani-amiguetti.png" style="max-width:70%;margin-left:50px">
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="https://medismart.net/wp-content/uploads/2021/01/dentnew3.png" style="max-width:70%;margin-left:40px">
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="https://medismart.net/control/images/Paez.png" style="max-width:70%;margin-left:40px">
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="https://medismart.net/control/images/BoticaNew2.png" style="max-width:50%;margin-left:40px">
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="https://medismart.net/control/images/logo-footer-hm.png" style="max-width:70%;margin-left:5px">
                        </div>
                        <div class="col-6 col-sm-4 col-md-1 mt-3 mb-5 p-4">
                            <img src="https://medismart.net/control/images/cnc-clinica.png" style="max-width:190%;margin-left:-15px">
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script src="{{ asset('control/js/msmt.js')}}"></script>

        <script>
            function irperfil(){
                window.location.href = "{{ route('perfil') }}";
            }
            function irvalidacion(){
                window.location.href = "{{ route('validacion') }}";
            }
            
            function irservicios(){
                window.location.href = "{{route('servicios')}}";
            }
            function ircitas(){
                window.open('https://directorio.medismart.net/', "_blank");
            }
            function irprecios(){
                window.open('https://medismart.net/buscador-de-precios/', "_blank");
            }
            function irFarmaciaOnline(){
                window.open('https://medismart.net/farmacia-en-linea/', "_blank");
            }
            function irClubSmart(){
                window.open('https://medismart.net/club-medismart/', "_blank");
            }
            function irOrientacionMedica(){
                window.open('https://medismart.net/orientacion-telefonica/', "_blank");
            }
            function irMedicoDomicilio(){
                window.open('https://medismart.net/medico-a-domicilio/', "_blank");
            }
        </script>
        @yield('js')
    </body>
</html>
