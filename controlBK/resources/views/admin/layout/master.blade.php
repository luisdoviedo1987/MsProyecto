<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}"/>

        <title>MedismartApp</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" href="https://medismart.net/wp-content/uploads/2019/10/cropped-cropped-icono-medismart-192x192-32x32.png" sizes="32x32" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ URL::asset('control/css/msstyles.css') }}?20220718">

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        @yield('css')
    </head>
    <body>
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
                            <a href="mailto:afiliarme@medismart.net" style="color: #fff !important;text-decoration: none;font-weight: 500;">
                                <i class="fas fa-envelope" aria-hidden="true"></i>&nbsp;
                                <span>afiliarme@medismart.net</span>
                            </a>
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
                                    <img alt="MediSmart" class="custom-logo justify-content-center" style="max-width: 40% !important" src="{{ asset('control/images/cropped-logomedismart-11-300x131-2.png') }}">
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-3 d-none d-lg-block">
                <div class="row">
                    <div class="col-sm-3">
                        <img alt="MediSmart" class="custom-logo" style="max-width: 50%;margin-top:10px" src="{{ asset('control/images/cropped-logomedismart-11-300x131-2.png') }}">
                    </div>
                    <div class="col-sm-6 ">
                        <div class="row p-0 m-0">
                            <div class="col-sm-8 offset-sm-1">
                                <div class="d-none d-lg-block" style="border: 2px solid #73d8d0;border-radius: 50px;">
                                    <form action="/buscador-de-precios/" class="searchform" style="text-align:center" id="searchform" method="get" novalidate="" role="search">
                                        <div>
                                            <input type="submit" value="Buscador de precios y servicios médicos" style="border-bottom: none !important; color: #e83e8c;">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row p-0 mt-1">
                            <div class="col-sm-12">
                                
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
                <div class="col-3 col-sm-4 navbar-column">
                    <app-autogestion-navbar _nghost-gej-c5="">
                        <div class="autogestion">
                            <div class="col-12 menu_autogestion">
                                <div aria-orientation="vertical" class="row nav nav-pills" id="v-pills-tab" role="tablist">
                                    @if (Auth::user()->full_acceso == 1) 
                                        <input id="menu_afiliado" type="checkbox" class="ng-untouched ng-pristine ng-valid" {{ (url()->current() == route('admin.welcome.email') || url()->current() == route('admin.refer.email') || url()->current() == route('admin.updatepass.email')) ? 'checked' : ''}}/>
                                        <label class="col-12 nav-link" for="menu_afiliado" style="color: #73d8d0 !important;background-color: #fff !important;">
                                            <span class="icon iconAfiliado"></span> CORREOS
                                            <i class="fas fa-sort-down"></i>
                                        </label>
                                        <a aria-controls="v-pills-gestion_informacion"
                                            aria-selected="true"
                                            class="menu_afiliado col-12 nav-link {{url()->current() == route('admin.welcome.email') ? 'active' : ''}}" 
                                            id="v-pills-gestion_informacion-tab" 
                                            routerlink="/afiliado"
                                            routerlinkactive="active"
                                            href="{{ route('admin.welcome.email') }}"
                                        >
                                            <span class="icon iconPerfil"></span> BIENVENIDA
                                        </a>
                                        <!---->
                                        <a aria-controls="v-pills-gestion_informacion"
                                            aria-selected="true"
                                            class="menu_afiliado col-12 nav-link ng-star-inserted {{url()->current() == route('admin.refer.email') ? 'active' : ''}}" 
                                            id="v-pills-gestion_informacion-tab" 
                                            routerlink="/misbenes"
                                            routerlinkactive="active"
                                            href="{{ route('admin.refer.email') }}"
                                        >
                                            <span class="icon iconBene"></span> NUEVO REFERIDO
                                        </a>
                                        <!---->
                                        <a aria-controls="v-pills-informacion_pagos"
                                            aria-selected="true"
                                            class="menu_afiliado col-12 nav-link ng-star-inserted {{url()->current() == route('admin.updatepass.email') ? 'active' : ''}}" 
                                            id="v-pills-informacion_pagos-tab" 
                                            routerlink="/tarjetas"
                                            routerlinkactive="active"
                                            href="{{ route('admin.updatepass.email') }}"
                                        >
                                            <span class="icon iconPagos"></span> CAMBIO CONTRASENA
                                        </a>
                                        <input id="menu_afiliado" type="checkbox" class="ng-untouched ng-pristine ng-valid" {{ url()->current() == route('admin.sms.text') ? 'checked' : ''}}/>
                                        <label class="col-12 nav-link" for="menu_afiliado" style="color: #73d8d0 !important;background-color: #fff !important;">
                                            <span class="icon iconAfiliado"></span> MENSAJES DE TEXTOS
                                            <i class="fas fa-sort-down"></i>
                                        </label>
                                        <a aria-controls="v-pills-gestion_informacion"
                                            aria-selected="true"
                                            class="menu_afiliado col-12 nav-link {{url()->current() == route('admin.sms.text') ? 'active' : ''}}" 
                                            id="v-pills-gestion_informacion-tab" 
                                            routerlink="/afiliado"
                                            routerlinkactive="active"
                                            href="{{ route('admin.sms.text') }}"
                                        >
                                            <span class="icon iconPerfil"></span> REFERIDO
                                        </a>
                                    @endif


                                    <input id="menu_afiliado" type="checkbox" class="ng-untouched ng-pristine ng-valid" {{ url()->current() == route('admin.users') ? 'checked' : ''}}/>
                                    <label class="col-12 nav-link" for="menu_afiliado" style="color: #73d8d0 !important;background-color: #fff !important;">
                                        <span class="icon iconAfiliado"></span> USUARIOS
                                        <i class="fas fa-sort-down"></i>
                                    </label>
                                    <a aria-controls="v-pills-gestion_informacion"
                                        aria-selected="true"
                                        class="menu_afiliado col-12 nav-link {{url()->current() == route('admin.users') ? 'active' : ''}}" 
                                        id="v-pills-gestion_informacion-tab" 
                                        routerlink="/afiliado"
                                        routerlinkactive="active"
                                        href="{{ route('admin.users') }}"
                                    >
                                        <span class="icon iconPerfil"></span> MANEJO DE USUARIOS
                                    </a>
                                </div>
                            </div>
                        </div>
                    </app-autogestion-navbar>
                </div>


                <div class="col-9 col-sm-8">
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
                        <br />
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="{{ asset('control/images/red-medica.png') }}" style="max-width:70%" />
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="{{ asset('control/images/hosp-metropolitani-amiguetti.png') }}" style="max-width:70%" />
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="https://medismart.net/wp-content/uploads/2021/01/dentnew3.png" style="max-width:70%" />
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="{{ asset('control/images/Paez.png') }}" style="max-width:70%" />
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="{{ asset('control/images/La-Botica-Blanco.png') }}" style="max-width:70%" />
                        </div>
                        <div class="col-6 col-sm-4 col-md-2 mt-3 mb-5 p-4">
                            <img src="{{ asset('control/images/hosp-metropolitani-amiguetti.png') }}" style="max-width:70%" />
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
        @yield('js')
    </body>
</html>
