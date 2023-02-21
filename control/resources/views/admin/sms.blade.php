@extends('admin.layout.master')

@section('content')
<div  class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div  class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <div  class="gform_body">
        <div  class="gform_page" id="gform_page_1_1">
            <h2 >SMS</h2>
            <p>En esta sección podrá modificar el mensaje de texto.</p>
            <p>Utilice el siguiente glosario para la construcción del mensaje de texto de referido.</p>
            <ul>
                <li>{nombreReferido} = Nombre del referido</li>
                <li>{nombreReferente} = Nombre del referente</li>
                <li>{apellidoReferente} = Apellido del referente</li>
                <li>{codigo} = Código de referido</li>
            </ul>
            <div class="gform_page_fields">
                <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                    <div class="row">
                        <form method="post" class="col-12" action="{{route('admin.sms.text')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="form-group col-12">
                                    <textarea class="summernote col-12" name="description">{!! $template->content !!}</textarea>
                                </div>
                            </div>
                            <div  class="gform_page_footer">
                                <div  class="row">
                                    <div  class="col-sm-5 offset-sm-7">
                                    <input type="submit" class="gform_next_button button submit" style="cursor: pointer; text-align: center; pointer-events: auto;" value="GUARDAR &gt;&gt;" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection