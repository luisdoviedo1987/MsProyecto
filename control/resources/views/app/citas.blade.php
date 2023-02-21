@extends('app.layout.master')

@section('content')
<div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <form class="ng-tns-c7-1 ng-untouched ng-pristine ng-valid" id="gform_1" novalidate="">
        <div class="gform_body">
            <div class="gform_page" id="gform_page_1_1">
                <h2 class="ng-tns-c7-1">Generación de citas</h2>
                <p class="ng-tns-c7-1">Buscá la especialidad de tu preferencia en el lugar más cercano. A través de esta sección, podrás crear nuevas citas en las fechas disponibles:</p>
                <div class="gform_page_field">
                    <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ng-tns-c7-1" data-lang="es" data-site="medismart" id="huli-searchbox" style="position: relative; height: 207px; width: 100%;">
                                    <iframe
                                        allowtransparency="true"
                                        frameborder="0"
                                        src="https://search.hulilabs.com/es/plugins/search/medismart?#https%3A%2F%2Fmedismart.net"
                                        style="border: none; width: 100%; position: absolute; top: 0px; left: 0px; z-index: 999; height: 207px;"
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('js')
<script id="huli-js" src="https://search.hulilabs.com/js/plugins/loader.js"></script>
@endsection