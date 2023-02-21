$(document).ready(function () {

  //desabilita temporal el boton de next
    $("#nextBeneficiarioCantidad").prop("disabled", true);

    //captura la cantidad de beneficiarios para agregar steps dinamicamente
    $("#cantidadBeneficiarios").change(function (e) {
      
      e.preventDefault();
      let cantidad = $(this).val();
      let stepDiv = $(".stepBeneficiarios");
  
      stepDiv.empty();
      stepDiv.append(`
      <div class="stepper-item completed">
          <div class="step-counter"></div>
            <small class="step-name">Cantidad beneficiarios</small>
           </div>
           <div class="stepper-item completed">
            <div class="step-counter"></div>
            <small class="step-name">Beneficiario 1</small>
    </div>`);
  
    cantidad = parseInt(cantidad);
      if (cantidad >= 1) {
        cantidadBeneficiarios = cantidad;
      $("#nextBeneficiarioCantidad").prop("disabled", false);
        for (let ct = 1; ct < cantidad; ct++) {
          let insideDiv = `<div class="stepper-item completed">
      <div class="step-counter"></div>
      <small class="step-name">Beneficiario ${ct + 1}</small>
    </div>`;
          stepDiv.append(insideDiv);
        }
        
        generateFieldSet(cantidad);
        console.log('generate')
      }else{
        Swal.fire({
            icon: 'error',
            title: 'Ingrese un valor válido',
            showConfirmButton: false,
          })
          //desabilita temporal el boton de next
        $("#nextBeneficiarioCantidad").prop("disabled", true);
      }
   //esta funcion es para generar los fieldsets dinamicamente
    });
  
  
        /* template string de la estructura de un fieldset individual, se le asigna un id
    y hay una validacion al final para detectar el utlimo y asi cambiar el texto del boton y cambiar la clase */

    let oncoicon = "https://medismart.net/control/assets/img/icon-oncosmart.svg";
    let htmlFieldset = (id, cantidad) => `<fieldset id='fieldset_${id}' class="fieldset_dinamic">
  <!-- campos del formulario--->
  
  <div class="m-2">
      <select name="tipo_id_${id}" id="tipo_id_${id}" class="form-control" required="">
            <option value="" disabled selected>Tipo de identificación</option>
            <option value="1">Cédula Nacional</option>
            <option value="2">Cédula Residente (DIMEX)</option>
            <option value="3">Pasaporte</option>
      </select>
  </div>
  <div class="m-2">
      <input type="text" name="cedula_${id}" id="cedula_${id}" class="form-control" placeholder="Identificación" required="">
  </div>
  
  <div class="m-2">
      <input type="text" name="nombre_${id}" id="nombre_${id}" class="form-control" placeholder="Nombre" required="">
  </div>
  <div class="m-2">
      <input type="text" name="apellido1_${id}" id="apellido1_${id}" class="form-control" placeholder="Primer apellido" required="">
  </div>
  <div class="m-2">
      <input type="text" name="apellido2_${id}" id="apellido2_${id}" class="form-control" placeholder="Segundo apellido" required="">
  </div>
  <div class="m-2">
      <input type="date" name="fechanacimiento_${id}" id="fechanacimiento_${id}" class="form-control" placeholder="Fecha de nacimiento" required="">
  </div>
  <div class="m-2">
      <select name="genero_${id}" id="genero_${id}" class="form-control" required="">
          <option value="" disabled selected >Genero</option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Feminino</option>
      </select>
  </div>
  <div class="m-2">
      <input type="text" name="telefono_${id}" id="telefono_${id}" class="form-control" placeholder="Telefono celular" required="">
  </div>
  <div class="m-2">
       <input type="text" name="email_${id}" id="email_${id}" class="form-control" placeholder="Correo electronico" required="">
  </div>
  <div class="m-2">
      <select name="parentesco_${id}" id="parentesco_${id}" class="form-control" required="">
            <option value = "" disabled selected>Parentesco</option>
            <option disabled="" hidden="" selected="selected" value="">Parentesco</option>
            <option value="Conyugue">Conyugue</option>
            <option value="Cunado(a)">Cuñado(a)</option>
            <option value="Esposo(a)">Esposo(a)</option>
            <option value="Hijo(a)">Hijo(a)</option>
            <option value="Padre">Padre</option>
            <option value="Madre">Madre</option>
            <option value="Hermano(a)">Hermano(a)</option>
            <option value="Abuelo(a)">Abuelo(a)</option>
            <option value="Tio(a)">Tio(a)</option>
            <option value="Nieto(a)">Nieto(a)</option>
            <option value="Sobrino(a)">Sobrino(a)</option>
            <option value="Pareja">Pareja</option>
            <option value="Primo(a)">Primo(a)</option>
            <option value="Amigo(a)">Amigo(a)</option>
            <option value="Suegro(a)">Suegro(a)</option>
            <option value="Novio(a)">Novio(a)</option>
            <option value="Yerno">Yerno</option>
            <option value="Nuera">Nuera</option>
            <option value="Otra Relacion">Otra Relacion</option>
      </select>
  </div>
  <div class="m-2">
      <select name="provincia_${id}" id="provincia_${id}" class="form-control provincias" required="">
      </select>
  </div>
    <div class="m-2">
        <select name="canton_${id}" id="canton_${id}" class="form-control cantones" required="">
                <option value = "" disabled selected>Cantón</option>
        </select>
    </div>
    <div class="m-2">
        <select name="distrito_${id}" id="distrito_${id}" class="form-control distritos" required="">
                <option value = "" disabled selected>Distrito</option>
        </select>
    </div>
    <div class="m-2">
     <div class="d-flex justify-content-center">
         <div class="d">
             <img src="${oncoicon}" class="icon-onco" alt="Plan OncoSmart">
         </div>
         <div class="d-flex mx-3">
             <div class="d">
              <h6>¿Agregar OncoSmart?</h6>
              <h6>Desde $2.26 c/u</h6>
             </div>
          <div class="d mx-3">
              <input type="checkbox" name="oncosmart_${id}" id="oncosmart_${id}" class="form-contro" placeholder="OncoSmart">
          </div>
         </div>
     </div>
  </div>
  <div class="mt-4 text-center">
      <button class="btn btn-secondary previus_formulario mx-2">Atras</button>
      <button class="btn btn-primary ${cantidad == id ? "" : "next next_formulario" } "  ${ cantidad == id ? " onclick='btn_new_ben()'" : ""}  > ${ cantidad == id ? "Finalizar" : "Siguiente"} </button>
  </div>
  </fieldset>`;
  
  //funcion para generar los fieldsets dinamicamente y agregarlos al formulario
  function generateFieldSet(cantidad) {
        $('.fieldset_dinamic').remove();

      let formDiv = $(".form_planes");
  
      $(".form_planes").not(":first").empty();
      //formDiv.append(htmlFieldset(1));
  
        for (let ct = 0; ct < cantidad; ct++) {
          console.log('id',ct + 1,'canti',cantidad);
          const myFragment = document
            .createRange()
            .createContextualFragment(htmlFieldset(ct + 1, cantidad));
          formDiv.append(myFragment);
        }
      
    }



});