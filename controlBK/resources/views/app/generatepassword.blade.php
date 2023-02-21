@extends('layout.master')

@section('content')
<div class="container">
    <div class="row" id="home-section-seven">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
                        <div class="gform_anchor" id="gf_1" tabindex="-1"></div>
                        <form class="ng-tns-c0-0 ng-untouched ng-pristine ng-invalid" id="fgeneratepassword" novalidate="">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$data}}" name="data" />
                            <div class="gform_body">
                                <div class="gform_page" id="gform_page_1_1">
                                    <h2 class="ng-tns-c0-0" style="text-align: center;">Este es el último paso</h2>
                                    <h3 class="ng-tns-c0-0" style="text-align: center; font-size: 20px; color: #ed2980;">Cree su contraseña</h3>
                                    <div class="gform_page_fields">
                                        <ul class="gform_fields top_label form_sublabel_below description_below">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <li class="ng-tns-c0-0">
                                                        <div class="ginput_container ginput_container_text">
                                                            <input class="medium"
                                                                aria-invalid="false"
                                                                aria-required="true"
                                                                id="password"
                                                                minlength="6"
                                                                name="password"
                                                                placeholder="Contraseña"
                                                                required=""
                                                                type="password"
                                                            />
                                                            <!---->
                                                        </div>
                                                    </li>
                                                    <li class="ng-tns-c0-0">
                                                        <div class="ginput_container ginput_container_text">
                                                            <input class="medium"
                                                                aria-invalid="false"
                                                                id="repeat_password"
                                                                minlength="6"
                                                                name="repeat_password"
                                                                placeholder="Repita su contraseña"
                                                                required=""
                                                                type="password"
                                                            />
                                                            <!---->
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="gform_page_footer">
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-6"><a class="gform_next_button button mt-3" id="continuar" style="cursor: not-allowed;text-align:center">CONTINUAR &gt;&gt;</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Event snippet for Compra completada Web MS conversion page -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-55800306-1"></script>
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-814769386/VNZ1CJznzrQBEOrJwYQD',
      'transaction_id': ''
  });
</script>
<script>
    $(document).ready(function(){
        $('#continuar').on('click', function(){
            var form = $( "#fgeneratepassword" );
            form.validate({
                errorClass: 'ng-invalid',
            });
            var formData = $('#fgeneratepassword').serialize();
            if (form.valid()) {
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('generate.password.post') }}",
                    data:formData,
                    success:function(data){
                        window.location.replace('{{route("index", ["code"=>"c1"])}}');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        if (XMLHttpRequest.status == 403) {
                            rmse('Error', XMLHttpRequest.responseJSON.message);
                        }else{
                            rmse('Error', 'Ocurrió un error, intente mas tarde');
                        }
                    }   
                });
            }
        });
    });
</script>
@endsection


