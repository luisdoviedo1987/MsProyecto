@extends('admin.layout.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div  class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div  class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <div  class="gform_body">
        <div  class="gform_page" id="gform_page_1_1">
            <h2 >Correos</h2>
            <p>En esta sección podrá modificar el correo de nuevo referido.</p>
            <p>Utilice el siguiente glosario para la construcción del correo de referido.</p>
            <ul>
                <li>{link} = Link para el cambio de contraseña</li>
            </ul>
            <div class="gform_page_fields">
                <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                    <div class="row">
                        <form method="post" action="{{route('admin.updatepass.email')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" id="subject" name="subject" style="width:100%" placeholder="Asunto" value="{!! $template->subject !!}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="summernote" name="description">{!! $template->content !!}</textarea>
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection