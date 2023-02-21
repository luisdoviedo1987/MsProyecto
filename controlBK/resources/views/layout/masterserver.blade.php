<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P9V3V5M');</script>
        <!-- End Google Tag Manager -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}"/>

        <title>MedismartApp</title>

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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ URL::asset('control/css/msstyles.css') }}?20220718">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style>
            select {
                -webkit-appearance: none;
                -moz-appearance: none;
                background: transparent;
                background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
                background-repeat: no-repeat;
                background-position-x: 100%;
                background-position-y: 5px;
                border: 1px solid #dfdfdf;
                border-radius: 2px;
                margin-right: 2rem;
                padding: 1rem;
                padding-right: 2rem;
            }
        </style>
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P9V3V5M"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <!-- Start header -->
        <div class="w-100 p-0 m-0 mscolor site-content-contain">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 mt-2 p-0 mstextwhite mb-4">
                        <div id="et-info">
                            <i class="fas fa-phone" aria-hidden="true"></i>
                            <span>&nbsp;
                                <a href="tel:+50625285400" style="color: #fff !important;text-decoration: none;font-weight: 500;">2528-5400</a> | <a href="tel:+50622114444" style="color: #fff !important;text-decoration: none;font-weight: 500;"> 2211-4444</a>
                                &nbsp; &nbsp; 
                            </span>
                            <a href="mailto:info@medismart.net" style="color: #fff !important;text-decoration: none;font-weight: 500;">
                                <i class="fas fa-envelope" aria-hidden="true"></i>&nbsp;
                                <span>info@medismart.net</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start header -->
        <div class="w-100 p-0 m-0 site-content-contain" style="box-shadow: 0 0 7px rgba(0,0,0,.1)!important; -moz-box-shadow: 0 0 7px rgba(0,0,0,.1)!important; -webkit-box-shadow: 0 0 7px rgba(0,0,0,.1)!important;">
            <div class="container mt3 d-lg-none d-xl-none">
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <div class="row p-0 mt-1">
                            <div class="col-sm-12">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <img alt="MediSmart" class="custom-logo justify-content-center" style=" margin-top:15px;max-width: 40% !important ;" src="{{ asset('control/images/cropped-logomedismart-11-300x131-2.png') }}">
                                    <button class="navbar-toggler justify-content-end" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarColor03">
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a href="#" class=" nav-link " data-toggle="dropdown">PLANES MEDISMART</a>
                                                <div class="dropdown-menu">
                                                    <a href="https://medismart.net/que-es-medismart/" class=" dropdown-item ">Plan MediSmart</a>
                                                    <a href="https://medismart.net/convenios-empresariales/" class=" dropdown-item ">Plan Empresarial</a>
                                                    <a href="https://medismart.net/planes-adicionales-old/" class=" dropdown-item ">Planes Adicionales</a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a href="#" class=" nav-link " data-toggle="dropdown">AHORROS</a>
                                                <div class="dropdown-menu">
                                                    <a href="https://medismart.net/beneficios-medismart/" class=" dropdown-item ">Especialidades y Ahorros</a>
                                                    <a href="https://medismart.net/farmacia-virtual/" class=" dropdown-item ">Farmacia Virtual</a>
                                                    <a href="https://medismart.net/club-medismart/" class=" dropdown-item ">ClubSmart</a>
                                                    <a href="https://medismart.net/medico-a-domicilio/" class=" dropdown-item ">Médico a Domicilio</a>
                                                    <a href="https://medismart.net/urgencias/" class=" dropdown-item ">Urgencias</a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a href="https://medismart.net/red-medica/" class=" nav-link " data-toggle="dropdown">NUESTROS PROFESIONALES</a>
                                                <div class="dropdown-menu">
                                                    <a href="https://medismart.net/red-medica/" class=" dropdown-item ">Directorio Médico</a>
                                                    <a href="https://medismart.net/blog/" class=" dropdown-item ">Blog</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container d-none d-lg-block">
                <div class="row">
                    <div class="col-sm-3 mt-2">
                        <img alt="MediSmart" class="custom-logo" style="max-width: 50%" src="{{ asset('control/images/cropped-logomedismart-11-300x131-2.png') }}">
                    </div>
                    <div class="col-sm-6 mt-3">
                        <div class="row p-0 m-0">
                            <div class="col-sm-8 offset-sm-2">
                                <div class="d-none d-lg-block" style="border: 2px solid #73d8d0;border-radius: 50px;">
                                    <form action="/buscador-de-precios" class="searchform" style="text-align:center" id="searchform" method="get" novalidate="" role="search">
                                        <div>
                                            <input style="border-bottom: none !important; color: #ed2980; font-size:13px; font-weight:500" type="submit" value="Buscador de precios y servicios médicos">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row p-0">
                            <div class="col-sm-12">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarColor03">
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a href="#" class=" nav-link " data-toggle="dropdown">PLANES MEDISMART</a>
                                                <div class="dropdown-menu">
                                                    <a href="https://medismart.net/que-es-medismart/" class=" dropdown-item ">Plan MediSmart</a>
                                                    <a href="https://medismart.net/convenios-empresariales/" class=" dropdown-item ">Plan Empresarial</a>
                                                    <a href="https://medismart.net/planes-adicionales-old/" class=" dropdown-item ">Planes Adicionales</a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a href="#" class=" nav-link " data-toggle="dropdown">AHORROS</a>
                                                <div class="dropdown-menu">
                                                    <a href="https://medismart.net/beneficios-medismart/" class=" dropdown-item ">Especialidades y Ahorros</a>
                                                    <a href="https://medismart.net/farmacia-virtual/" class=" dropdown-item ">Farmacia Virtual</a>
                                                    <a href="https://medismart.net/club-medismart/" class=" dropdown-item ">ClubSmart</a>
                                                    <a href="https://medismart.net/medico-a-domicilio/" class=" dropdown-item ">Médico a Domicilio</a>
                                                    <a href="https://medismart.net/urgencias/" class=" dropdown-item ">Urgencias</a>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a href="https://medismart.net/red-medica/" class=" nav-link " data-toggle="dropdown">NUESTROS PROFESIONALES</a>
                                                <div class="dropdown-menu">
                                                    <a href="https://medismart.net/red-medica/" class=" dropdown-item ">Directorio Médico</a>
                                                    <a href="https://medismart.net/blog/" class=" dropdown-item ">Blog</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 offset-sm-1 llamanos p-1" id="top-menu">
                        <a href="tel:+5062211-4444" class="mt-3 p-0" style="color:#fff!important">AFILIATE LLAMANDO<br>
                            <span class="tel-amarillo">2211-4444</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Finish header -->

        @yield('content')

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

        <footer id="colophon" class="footer" style="margin-top:150px !important;">
            <div style="background-color: #73d8d0;" id="foo" class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 mt-5">
                            <div class="widget_text fwidget et_pb_widget widget_custom_html">
                                <h4 class="title">Contáctanos:</h4>
                                <div class="textwidget custom-html-widget">
                                    <h5 class="sub-footer">Servicio al cliente:</h5>
                                    <a class="telefonos" href="tel:+50625285400">2528-5400</a>
                                    <br />
                                    <br />
                                    <h5 class="sub-footer">Ventas:</h5>
                                    <a class="telefonos" href="tel:+50622114444">2211-4444</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mt-5">
                            <div class="widget_text fwidget et_pb_widget widget_custom_html">
                                <h4 class="title">Síguenos:</h4>
                                <div class="textwidget custom-html-widget">
                                    <div class="logos-sociales">
                                        <a href="https://www.facebook.com/medismartcr/" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/FB.png') }}" alt="Facebook"></a>
                                        <a href="https://twitter.com/planmedismart" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/TW.png') }}" alt="Twitter"></a>
                                        <a href="https://www.instagram.com/medismart.cr/" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/IG.png') }}" alt="Instagram"></a>
                                    </div>
                                    <div class="logos-sociales">
                                        <a href="https://www.youtube.com/channel/UClZEq_9e6-SYKmCOcO7fDVg/videos" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/YOUTUBE.png') }}" alt="YouTube"></a>
                                        <a href="https://open.spotify.com/user/jgel3qhuudmtyiqm1rjs33brm?si=6mK2Y5rzQfi2HlIWSnZEjw" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/SPOTIFY.png') }}" alt="Spotify"></a>
                                        <a href="https://www.linkedin.com/company/medismart-cr/" target="_blank" rel="nofollow noopener noreferrer"><img src="{{ asset('control/images/IN.png') }}" alt="LinkedIn"></a>
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

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script src="{{ asset('control/js/msmt.js')}}"></script>
        @yield('js')
    </body>
</html>

