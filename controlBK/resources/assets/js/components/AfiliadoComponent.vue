<template>
    <form  id="form_afiliado" class="ng-untouched ng-valid ng-dirty" method="post" action="{{ route('afiliado.actualizar') }}">
        <div  class="gform_body">
            <div  class="gform_page" id="gform_page_1_1">
                <h2 >Perfil</h2>
                <p >El estado actual de tu plan es : <span  style="color: green; font-weight: bold !important;">{{ $this.data.estadoTitular }}</span>.</p>
                <p >Conocé y de ser necesario modificá en esta sección los datos personales del titular:</p>
                <div class="gform_page_fields">
                    <ul class="gform_fields top_label form_sublabel_below description_below" id="gform_fields_1">
                        <div class="row">
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-pristine ng-valid ng-touched" id="tipoid" name="tipoid" required="" disabled>
                                            <option hidden="true" value="0">Elegí tu tipo de identificación</option>
                                            <option value="1" :selected="$this.data.tipoId == 1 ? 'selected' : ''">Cédula Nacional</option>
                                            <option value="2" :selected="$this.data.tipoId == 1 ? 'selected' : ''">Cédula Residente (DIMEX)</option>
                                            <option value="3" :selected="$this.data.tipoId == 1 ? 'selected' : ''">Pasaporte</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input
                                            class="medium ng-untouched ng-pristine ng-invalid"
                                            id="cedula"
                                            name="cedula"
                                            placeholder="Número de identificación"
                                            type="text"
                                            value="{{$this.data.persona_cedula}}"
                                            disabled
                                        />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input aria-invalid="false" aria-required="true" class="medium ng-untouched ng-pristine ng-invalid" id="nombre" name="nombre" placeholder="Nombre" required="" type="text" value="{{$this.data.nombre}}" disabled />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                @if ($this.data.apellido1 != '')
                                    <li>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium ng-untouched ng-pristine ng-invalid" id="apellido1" name="apellido1" placeholder="Primer apellido" required="" type="text" value="{{$this.data.apellido1}}" disabled />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                    </li>
                                @endif
                                @if ($this.data.apellido2 != '')
                                    <li>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium ng-untouched ng-pristine ng-invalid" id="apellido2" name="apellido2" placeholder="Segundo apellido" required="" type="text" value="{{$this.data.apellido2}}" disabled />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                    </li>
                                @endif
                                <li>
                                    <div class="ginput_container ginput_container_date mt-4">
                                        <label for="fecha_nac" style="display: block !important; color: #73d8d0 !important; font-size: 16px; font-family: 'Roboto', sans-serif !important;">Fecha de Nacimiento :</label>
                                        <div class="ginput_container ginput_container_text">
                                            <input aria-invalid="false" aria-required="true" class="medium ng-untouched ng-pristine ng-invalid" id="datepicker" name="datepicker" placeholder="dd-MM-yyyy" required="" type="text" value="{{$this.data.fecha_nac}}" disabled />
                                            <span class="icon iconPencil"></span>
                                            <!---->
                                        </div>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine ng-invalid" id="genero" name="genero" required="" disabled>
                                            <option hidden="" value="">Género</option>
                                            <option value="Masculino" :selected="$this.data.genero == 'Masculino' ? 'selected' : ''" >Hombre</option>
                                            <option value="Femenino" :selected="$this.data.genero == 1 ? 'selected' : ''">Mujer</option>
                                        </select>
                                        <!---->
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_text">
                                        <input
                                            class="medium ng-untouched ng-pristine ng-invalid"
                                            id="telefono"
                                            mask="0000-0000"
                                            name="telefono"
                                            placeholder="Teléfono 1"
                                            required=""
                                            type="text"
                                            value="{{ $this.data.telefono }}"
                                        />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                            </div>
                            <div class="col-sm-6">
                                <li>
                                    <div class="ginput_container ginput_container_email">
                                        <input aria-invalid="false" aria-required="true" class="medium ng-untouched ng-pristine ng-invalid" id="email" name="email" placeholder="Email" required="" type="text" value="{{ $this.data.email }}" />
                                        <span class="icon iconPencil"></span>
                                        <!---->
                                    </div>
                                </li>
                                <div class="form-html-one mt-4" >DIRECCIÓN*</div>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine ng-valid" id="provincia" name="provincia" required="">
                                            <option hidden="selected" selected="selected" value="0">Provincia</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine" id="canton" name="canton" required="">
                                            <option hidden="selected" selected="selected" value="0">Cantón</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="ginput_container ginput_container_select">
                                        <select aria-invalid="false" aria-required="true" class="medium gfield_select ng-untouched ng-pristine" id="distrito" name="distrito" required="">
                                            <option hidden="selected" selected="selected" value="0">Distrito</option>
                                            <!---->
                                        </select>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </ul>
                </div>

                <div  class="gform_page_footer">
                    <div  class="row">
                        <div  class="col-sm-5 offset-sm-7">
                            <a class="gform_next_button button submit" style="cursor: pointer; text-align: center; pointer-events: auto;">GUARDAR &gt;&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script> 
    export default {
        props: [
            'route_post',
            'route_provincias',
            'route_cantones',
            'route_distritos',
            'data',
        ],

        data() {
            return {
                
            }
        },

        methods: {
            next(){
                this.cropper.getCroppedCanvas().toBlob((blob) => {
                    const formData = new FormData();

                    // Pass the image file name as the third parameter if necessary.
                    formData.append('croppedImage', blob);
                    
                    //start loading
                    this.loading = true;

                    //send image
                    axios.post(this.route_next_photo +"/"+ this.photo.id, formData).then(response => {
                        //start loading
                        this.loading = false;

                        console.log('response', response);
                        if (response.data.has) {
                            //put first photo
                            this.photo = response.data.photo;
                            // this.$forceUpdate();
                        }else{
                            //redirect
                            window.location.href = this.next_route;
                        }
                    }).catch(error => {
                        console.log('error', error);
                        
                        //start loading
                        this.loading = false;
                    });
                });

                // this.cropper.clear();
            },
        },

        mounted(){
            $("#provincia").on('change', function() {
                $('#distrito').html('');
                $('#distrito').append('<option value="0" selected>DISTRITO</option>');
                $('#distrito').prop('disabled', 'disabled');

                $('#canton').html('');
                $('#canton').append('<option value="0" selected>CANTON</option>');
                var url = "{{ route('api.cantones', ['distelec' => 999]) }}";
                url = url.replace("999", $(this).children("option:selected").val());
                $.get(url, function(data, status){
                    $.each(data, function( index, value ) {
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                    });
                }); 
            });

            $("#canton").on('change', function() {
                $('#distrito').html('');
                if ($(this).children("option:selected").val() != 0) {
                    $('#distrito').prop('disabled', false);
                }

                $('#distrito').append('<option value="0" selected>DISTRITO</option>');
                var url = "{{ route('api.distritos', ['distelec' => 999]) }}";
                url = url.replace("999", $(this).children("option:selected").val());
                $.get(url, function(data, status){
                    $.each(data, function( index, value ) {
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                    });
                }); 
            });

            $.get("{{ route('api.provincias') }}", function(data, status){
                $.each(data, function( index, value ) {
                    if (value.CODIGOPROVINCIA == $this.data.provincia) {
                        $('#provincia').append('<option value="'+value.CODIGOPROVINCIA+'" selected>'+value.NAME+'</option>'); 
                    }else{
                        $('#provincia').append('<option value="'+value.CODIGOPROVINCIA+'" >'+value.NAME+'</option>'); 
                    }
                });
            });

            $.get("{{ route('api.cantones', ['distelec' => $this.data.provincia]) }}", function(data, status){
                $.each(data, function( index, value ) {
                    if (value.CODIGOCANTON_C == $this.data.canton ) {
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" selected>'+value.NAME+'</option>'); 
                    }else{
                        $('#canton').append('<option value="'+value.CODIGOCANTON_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            });

            $.get("{{ route('api.distritos', ['distelec' => $this.data.canton]) }}", function(data, status){
                $.each(data, function( index, value ) {
                    if (value.CODIGODISTRITO_C == $this.data.distrito) {
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" selected>'+value.NAME+'</option>'); 
                    }else{
                        $('#distrito').append('<option value="'+value.CODIGODISTRITO_C+'" >'+value.NAME+'</option>'); 
                    }
                });
            });

            $('.submit').on('click', function(){
                $('#form_afiliado').submit();
            });
        },

        updated(){
            var image = document.getElementById('photo');
            this.cropper = new Cropper(image, {
                zoomable: false,
                aspectRatio: 6 / 4,
                dragMode: 'none',
                autoCropArea: 1,
                cropBoxResizable: false,
            });
        }
    }
</script>