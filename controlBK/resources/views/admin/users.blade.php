@extends('admin.layout.master')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
     #loader {
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        margin-left:200px;
        margin-top:30px;
    } 
    </style>
@endsection

@section('content')
<div  class="gf_browser_gecko gform_wrapper" id="gform_wrapper_1">
    <div  class="gform_anchor" id="gf_1" tabindex="-1"></div>
    <div  class="gform_body">
        <div  class="gform_page" id="gform_page_1_1">
            <h2 >Usuarios</h2>
            <p>En esta sección podrá modificar los usuarios afiliados y beneficiarios de medismart.</p>
            <div class="row">
                <div class="col-sm-3 mstextwhite">
                    <button class="gform_logout_button button justify-content-center nuevo_usuario" style="cursor: pointer; pointer-events: auto; text-align:center!important; font-size:15px">Agregar usuario</button>
                </div>
            </div>
            <br />
            <div class="gform_page_fields table_users_loading">
                Cargando los datos ...
            </div>
            <div class="gform_page_fields table_users" style="display:none">
                <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                    <div class="row">
                        <div class="table-responsive">
                            <!-- Table -->
                            <table id="dynamic-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Cédula</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Correo electrónico</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                            <tbody>
                                
                            </tbody>
                            </table>

                            <!-- End Table -->
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade user_modal" tabindex="-1" role="dialog" aria-labelledby="user_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Actualizar usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form_user" class="ng-untouched ng-pristine ng-valid ng-star-inserted">
                            {{ csrf_field() }}
                            <input type="hidden" name="cedula" id="cedula">
                            <div class="gform_body">
                                <div class="gform_page" id="gform_page_1_1">
                                    <div class="gform_page_fields">
                                        <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <li>
                                                        <div class="ginput_container ginput_container_text">
                                                            <input aria-invalid="false" aria-required="true" class="medium" id="cli" name="cli" placeholder="Cli" required="" type="text" value="" />
                                                            <span class="icon iconPencil"></span>
                                                            <!---->
                                                        </div>
                                                    </li>
                                                </div>
                                                <div class="col-sm-12">
                                                    <li>
                                                        <div class="ginput_container ginput_container_text">
                                                            <input aria-invalid="false" aria-required="true" class="medium" id="newid" name="newid" placeholder="Cédula" required="" type="text" value="" />
                                                            <span class="icon iconPencil"></span>
                                                            <!---->
                                                        </div>
                                                    </li>
                                                </div>
                                                <div class="col-sm-12">
                                                    <li>
                                                        <div class="ginput_container ginput_container_text">
                                                            <input aria-invalid="false" aria-required="true" class="medium" id="name" name="name" placeholder="Nombre" required="" type="text" value="" />
                                                            <span class="icon iconPencil"></span>
                                                            <!---->
                                                        </div>
                                                    </li>
                                                </div>
                                                <div class="col-sm-12">
                                                    <li>
                                                        <div class="ginput_container ginput_container_text">
                                                            <input aria-invalid="false" aria-required="true" class="medium" id="phone" name="phone" placeholder="Teléfono" required="" type="text" value="" />
                                                            <span class="icon iconPencil"></span>
                                                            <!---->
                                                        </div>
                                                    </li>
                                                </div>
                                                <div class="col-sm-12">
                                                    <li>
                                                        <div class="ginput_container ginput_container_text">
                                                            <input aria-invalid="false" aria-required="true" class="medium" id="email" name="email" placeholder="Correo electrónico" required="" type="text" value="" />
                                                            <span class="icon iconPencil"></span>
                                                            <!---->
                                                        </div>
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="gform_page_footer">
                                        <div  class="row">
                                            <div  class="col-sm-5">
                                                <a class="gform_next_button button confirm-delete-show-md" style="cursor: pointer; text-align: center; pointer-events: auto;">ELIMINAR</a>
                                            </div>
                                            <div  class="col-sm-5 offset-sm-2">
                                                <a class="gform_next_button button" id="btn_editar_usuario" style="cursor: pointer; text-align: center; pointer-events: auto;">EDITAR &gt;&gt;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="confirm-resend-email" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="confirm-delete-title">Enviar correo</h4>
            </div>
            <div class="modal-body">
                <label id="confirm-delete-body">¿Estás seguro de enviar el correo al usuario?</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="gform_next_button button mr-3 btn-resent" data-dismiss="modal">Sí</button>
                <a class="btn btn-danger" style="color:#fff" data-dismiss="modal">No </a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="new-user" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="confirm-delete-title">Agregar nuevo usuario</h4>
            </div>
            <div class="modal-body">
                <label id="confirm-delete-body">Buscar usuario por cedula:</label>
                <div class="row">
                    <div class="col-sm-8">
                        <li>
                            <div class="ginput_container ginput_container_text">
                                <input aria-invalid="false" aria-required="true" class="medium" id="idnewuser" name="idnewuser" placeholder="Cedula" required="" type="text" value="" />
                            </div>
                        </li>
                    </div>
                    <div  class="col-sm-4">
                        <a class="gform_next_button button btnidnewuser" style="cursor: pointer; text-align: center; pointer-events: auto;">Buscar &gt;&gt;</a>
                    </div>
                </div>
                
                <div class="row infonewuser" style="display: none; margin-top:10px">
                    <div class="col-sm-3">
                        <strong>CLI:</strong>
                    </div>
                    <div class="col-sm-9" id="newusercli"></div>
                    <div class="col-sm-9" id="isBen"></div>
                    <div class="col-sm-9" id="numBen"></div>
                </div>
                <div class="row infonewuser" style="display: none">
                    <div  class="col-sm-3">
                        <strong>Estado:</strong>
                    </div>
                    <div class="col-sm-9" id="newuserstate"></div>
                </div>
                <div class="row infonewuser" style="display: none">
                    <div class="col-sm-3">
                        <strong>Nombre:</strong>
                    </div>
                    <div class="col-sm-9" id="newusername"></div>
                </div>
                <div class="row infonewuser" style="display: none">
                    <div  class="col-sm-3">
                        <strong>Correo:</strong>
                    </div>
                    <div class="col-sm-9" id="newuseremail"></div>
                </div>
                <div class="row infonewuser" style="display: none">
                    <div  class="col-sm-3">
                        <strong>Teléfono:</strong>
                    </div>
                    <div class="col-sm-9" id="newuserphone"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="gform_next_button button mr-3 addnewuser" data-dismiss="modal">Agregar</button>
                <a class="btn btn-danger" style="color:#fff" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script>
        var cedulaUsuario = '';
        $( document ).ready(function() {
            var table = null;

            jQuery(function($) {
                table = $('#dynamic-table').DataTable({
                            dom: "<'row'<'col-sm-6'l><'col-sm-6 pull-right'f>r>t<'row'<'col-sm-6'i><'col-sm-6 pull-right'p>> <'row'<'col-sm-6'>> B",
                            buttons: [],
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                            },
                            "initComplete": function(settings, json) {
                                $('.table_users').show();
                                $('.table_users_loading').hide();
                            },
                            processing: true,
                            serverSide: true,
                            ajax: "{{ route('admin.users.information') }}",
                            columns: [
                                {data: 'cli', name: 'cli'},
                                {data: 'cedula', name: 'cedula'},
                                {data: 'nombre', name: 'nombre'},
                                {data: 'telefono', name: 'telefono'},
                                {data: 'correo', name: 'correo'},
                                {data: 'editar', name: 'editar', orderable: true, searchable: true},
                                {data: 'contrasena', name: 'contrasena', orderable: true, searchable: true},
                            ]
                        });
            });

            $('.edit-user').click(function() {
                $('.user_modal').modal('show');
                cedulaUsuario = $(this).attr("cedula");
                $('#cedula').val($(this).attr("cedula"));
                $('#newid').val($(this).attr("cedula"));
                $('#cli').val($(this).attr("cli"));
                $('#name').val($(this).attr("nombre"));
                $('#phone').val($(this).attr("telefono"));
                $('#email').val($(this).attr("email"));
            });

            $('#btn_editar_usuario').on('click', function(){
                var form = $( "#form_user" );
                form.validate({
                    errorClass: 'ng-invalid',
                });

                //get data
                var formData = $('#form_user').serialize();

                if (form.valid()) {
                    $('.bd-loading-modal-lg').modal('show');
                    $.ajax({
                        type:'POST',
                        url:"{{ route('admin.users') }}",
                        data:formData,
                        success:function(data){
                            rmss(false,"Actualizado","El usuario se actualizó correctamente",null,null);
                            setTimeout(function(){location.reload()}, 3000);
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

            $('.confirm-delete-show-md').on('click',function(){
                tr = $(this).closest('tr');
                $('#confirm-delete').modal('show');
            });

            $('.btn-delete').click(function(e){
                e.preventDefault();
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('admin.users.delete') }}",
                    data: { 'cedula': cedulaUsuario },
                    success:function(data){
                        $('.user_modal').modal('toggle');
                        rmss(false,"Eliminado","Se eliminó el usuario correctamente");
                        setTimeout(function(){location.reload()}, 3000);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        if (XMLHttpRequest.status == 403) {
                            rmse('Error', XMLHttpRequest.responseJSON.message);
                        }else{
                            rmse('Error', 'Ocurrió un error, intente mas tarde');
                        }
                    }   
                });
            });


            $('.re-sent-email').on('click',function(){
                user = JSON.parse($(this).attr("user"));
                $('#confirm-resend-email').modal('show');
            });

            $('.btn-resent').click(function(e){
                e.preventDefault();
                $('.bd-loading-modal-lg').modal('show');
                $.ajax({
                    type:'POST',
                    url:"{{ route('admin.users.email') }}",
                    data: { 'cedula': cedulaUsuario },
                    success:function(data){
                        rmss(false,"Enviado","Se envió el correo correctamente");
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        if (XMLHttpRequest.status == 403) {
                            rmse('Error', XMLHttpRequest.responseJSON.message);
                        }else{
                            rmse('Error', 'Ocurrió un error, intente mas tarde');
                        }
                    }   
                });
            });

            $('.nuevo_usuario').on('click', function(){
                $('#new-user').modal('show');
                $('.infonewuser').hide()
                $(".addnewuser").prop("disabled",true);
            });
            
            $('.btnidnewuser').on('click', function(){
                var idNewUser = $('#idnewuser').val();
                $(".addnewuser").prop("disabled",true);
                $.ajax({
                    type:'POST',
                    url:"{{ route('admin.users.search') }}",
                    data: { 'cedula': idNewUser },
                    success:function(data){
                        var user = $.parseJSON($.parseJSON(data));
                        if (user.accountResults.length > 0) {
                            $('.infonewuser').show()
                            $('#newusercli').html(user.accountResults[0].numeroCliente);
                            $('#isBen').html('0');
                            $('#newuserstate').html(user.accountResults[0].estado);
                            $('#newusername').html(user.accountResults[0].nombre);
                            $('#newuseremail').html(user.accountResults[0].correo);
                            $('#newuserphone').html(user.accountResults[0].telefono);
                            $(".addnewuser").prop("disabled",false);
                        }else if (user.benResults.length > 0) {
                            $('.infonewuser').show()
                            $('#newusercli').html(user.benResults[0].numeroCliente);
                            $('#isBen').html('1');
                            $('#numBen').html(user.benResults[0].numeroBen);
                            $('#newuserstate').html(user.benResults[0].estado);
                            $('#newusername').html(user.benResults[0].nombre);
                            $('#newuseremail').html(user.benResults[0].correoBen);
                            $('#newuserphone').html(user.benResults[0].telefonoBen);
                            $(".addnewuser").prop("disabled",false);
                        }else{
                            rmse('Error', 'No existe ningún usuario con esa información');
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        if (XMLHttpRequest.status == 403) {
                            rmse('Error', XMLHttpRequest.responseJSON.message);
                        }else{
                            rmse('Error', 'Ocurrió un error, intente mas tarde');
                        }
                    }   
                });
            });

            $('.addnewuser').on('click', function(){
                var clinewclient = $('#newusercli').html();
                if ($('#isBen').html() == 0) {
                    $.ajax({
                        type:'POST',
                        url:"{{ route('admin.users.agregar') }}",
                        data: { 'cli': clinewclient },
                        success:function(data){
                            rmss(false,"Agregado","Se agregó el usuario con la contraseña: " + data);
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            if (XMLHttpRequest.status == 403) {
                                rmse('Error', XMLHttpRequest.responseJSON.message);
                            }else{
                                rmse('Error', 'Ocurrió un error, intente mas tarde');
                            }
                        }   
                    });
                }else{
                    var numBen = $('#numBen').html();
                    $.ajax({
                        type:'POST',
                        url:"{{ route('admin.users.agregar') }}",
                        data: { 'cli': clinewclient, 'numBen': numBen },
                        success:function(data){
                            rmss(false,"Agregado","Se agregó el usuario con la contraseña: " + data);
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
            })
        });

        function editarUsuario(cedula, cli, nombre, telefono, email){
            $('.user_modal').modal('show');
            cedulaUsuario = cedula;
            $('#cedula').val(cedula);
            $('#newid').val(cedula);
            $('#cli').val(cli);
            $('#name').val(nombre);
            $('#phone').val(telefono);
            $('#email').val(email);
        }

        function resentemail(cedula){
            cedulaUsuario = cedula;
            $('#confirm-resend-email').modal('show');
        }
    </script>
@endsection
