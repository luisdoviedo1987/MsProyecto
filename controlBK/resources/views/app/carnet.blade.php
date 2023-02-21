@extends('app.layout.master')

@section('content')

<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <form id="gform_1" novalidate="" class="ng-untouched ng-pristine ng-valid">
        <div class="gform_body">
            <div class="gform_page" id="gform_page_1_1">
                <h2 _ngcontent-xum-c17="">Carnet virtual del titular</h2>
                <p _ngcontent-xum-c17="">Tu carnet virtual es la forma de identificar que sos afiliado al servicio MediSmart. Tomá una captura de pantalla de la siguiente imagen para guardar tu carnet:</p>
                <app-carnet >
                    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="carnetModal" role="dialog" tabindex="-1">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content bd-0 bg-transparent rounded overflow-hidden">
                                <div class="modal-body p-0">
                                    <div class="card" id="badge-content">
                                        <div class="card-img-top view view-first" style="background-color: #789656;">
                                            <div _ngcontent-xum-c18="">
                                                <button aria-label="Close" class="close" data-dismiss="modal" style="margin-right: 8px; margin-top: 8px; right: 0; top: 0;" type="button">x</button>
                                            </div>
                                            <br />
                                            <div class="row" style="margin: 0; width: 100%;">
                                                <div class="col-sm-12" style="text-align: center;">
                                                    <div class="text-white fontbold" style="font-size: 26px;">Carnet Virtual</div>
                                                    <div class="col-sm-6 offset-sm-3" style="margin-top: 10px; margin-bottom: 10px;">
                                                        <qrcode id="qrcode" title="1">
                                                            
                                                        </qrcode>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div style="text-align: center;"><img alt="" class="" id="medismart-logo-badge" src="https://medismart.net/control/assets/images/logo01.png" style="width: 80%;" /></div>
                                        </div>
                                        <div class="card-body" style="background-color: #003749; padding: 0;">
                                            <div class="card-title text-white fontbold ml-4 mt-3" id="name-badge" style="font-size: 18px;"></div>
                                            <!----><!---->
                                            <div class="card-text text-white fontlight ng-star-inserted ml-4" id="type-badge" style="margin-top: -13px; font-size: 12px;">Beneficiario</div>
                                            <div class="card-title text-white fontnormal ml-4" id="cli-badge">1</div>
                                            <div class="card-text text-white fontlight" id="status-badge" style="margin-top: -13px; font-size: 12px;"></div>
                                            <div class="card-text" style="margin-top: 20px;">
                                                <div style="text-align: center;">
                                                    <div class="card-text text-white fontlight">
                                                        www.medismart.net<br />
                                                        <div hidden="" id="btn-save-badge-div">
                                                            <button
                                                                _ngcontent-xum-c18=""
                                                                class="btn btn-wd btn-warning ladda-button m-t-10 text-white"
                                                                data-spinner-color="#FFF"
                                                                data-style="zoom-in"
                                                                id="btn-save-badge"
                                                                style="margin-top: -5px;"
                                                                type="button"
                                                            >
                                                                <span class="ladda-label">Guardar</span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
                                                                <div class="ladda-progress" style="width: 140px;"></div>
                                                            </button>
                                                            <br />
                                                        </div>
                                                        <span class="fontlight" id="id-ios-banner" style="margin-top: -5px; font-size: 12px;"> Por favor tome una captura de pantalla y guárdela en su dispositivo </span>
                                                    </div>
                                                    <div style="text-align: center;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </app-carnet>
                <div class="gform_page_fields">
                    <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 col-xs-12">
                                @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                                    <a class="gform_next_button button" id="titular" style="cursor: pointer; text-align: center; font-size: 15px !important;" nombre="{{ $data->getData()->nombre }}" ben="{{ $data->getData()->NumeroBeneficiaro }}">
                                        <div id="qrtitularimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate($data->getData()->NumeroBeneficiaro); !!}</div>
                                        Ver mí carnet virtual
                                    </a>
                                @else
                                    <a class="gform_next_button button" id="titular" style="cursor: pointer; text-align: center; font-size: 15px !important;" nombre="{{$data->getData()->nombre}}" ben="{{$data->getData()->cli}}">
                                        <div id="qrtitularimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate($data->getData()->cli); !!}</div>
                                        Ver mí carnet virtual
                                    </a>
                                @endif
                                    
                            </div>
                        </div>
                        @if (isset($data->getData()->afiliado) && !$data->getData()->afiliado)
                        @else
                            <div class="row">
                                <div class="col-12" style="padding: 0; margin: 0;">
                                    <table class="table" style="font-size: 18px; margin: 0; background-color: #fff" width="595">
                                        <tbody _ngcontent-xum-c17="">
                                            <tr _ngcontent-xum-c17="">
                                                <td style="width: 30% !important; background-color: #0f93d2; color: white; word-break: keep-all !important;">Ver carnets</td>
                                                <td style="width: 40% !important; background-color: #0f93d2; color: white; word-break: keep-all !important;">Nombre</td>
                                                <td style="width: 30% !important; background-color: #0f93d2; color: white; word-break: keep-all !important;">Estado</td>
                                            </tr>
                                            @foreach ($data->getData()->beneficiarios as $beneficiario)
                                                @if (isset($beneficiario->NumeroBeneficiaro) && $beneficiario->NumeroBeneficiaro != '')
                                                    @if ($beneficiario->estadoBeneficiario == "Activo")
                                                        <!---->
                                                        <tr style="border-bottom: 1px solid #ed2980;" class="ng-star-inserted">
                                                            <!---->
                                                            <td class="fixed-side ng-star-inserted" style="width: 30% !important; border-top: none;">
                                                                <!---->
                                                                <a class="col-12 col-md-4 abrirmodal" nombre="{{$beneficiario->nombre}}" ben="{{$beneficiario->NumeroBeneficiaro}}">
                                                                    <div id="qrbeneimage" style="display:none">{!! QrCode::size(152)->margin(0)->generate($beneficiario->NumeroBeneficiaro); !!}</div>
                                                                    <span class="iconTable iconCarnet" style="color: black; margin: 0;"></span>
                                                                </a>
                                                            </td>
                                                            <!---->
                                                            <td style="width: 40% !important; border-top: none; word-break: keep-all !important;" class="ng-star-inserted">{{$beneficiario->nombre}}</td>
                                                            <!---->
                                                            <td style="width: 30% !important; border-top: none; word-break: keep-all !important;" class="ng-star-inserted">{{$beneficiario->estadoBeneficiario}}</td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('js')
<script>
    $( document ).ready(function() {
        $(".abrirmodal").on('click', function() {
            $('#qrcode').html($(this).children('#qrbeneimage').html());
            $('#name-badge').html($(this).attr('nombre'));
            $('#cli-badge').html($(this).attr('ben'));
            $('#carnetModal').modal('show');
        });

        $("#titular").on('click', function() {
            $('#qrcode').html($(this).children('#qrtitularimage').html());
            $('#name-badge').html($(this).attr('nombre'));
            $('#cli-badge').html($(this).attr('ben'));
            $('#carnetModal').modal('show');
        });
    });
</script>
@endsection