$(document).ready(function () {

  //desabilita temporal el boton de next
$("#nextMascotasCantidad").prop("disabled", true);
  
    //captura la cantidad de beneficiarios para agregar steps dinamicamente
    $("#cantidadMascotas").change(function (e) {
      
      e.preventDefault();
      $("#nextMascotasCantidad").prop("disabled", false);
      let cantidad = $(this).val();
      let stepDiv = $(".stepMascotas");
  
      stepDiv.empty();
      stepDiv.append(`
      <div class="stepper-item completed">
           <div class="step-counter"></div>
             <small class="step-name">Cantidad de mascotas</small>
           </div>
           <div class="stepper-item completed">
              <div class="step-counter"></div>
              <small class="step-name">Mascota 1</small>
    </div>`);
  
      cantidad = parseInt(cantidad);
      if (cantidad >= 1) {
        cantidadMascotas = cantidad;
        for (let ct = 1; ct < cantidad; ct++) {
          let insideDiv = ` <div class="stepper-item completed">
      <div class="step-counter"></div>
      <small class="step-name">Mascota ${ct + 1}</small>
    </div>`;
          stepDiv.append(insideDiv);
        }
      }
      //esta funcion es para generar los fieldsets dinamicamente
      generateFieldSet(cantidad);
    });


    /* template string de la estructura de un fieldset individual, se le asigna un id
    y hay una validacion al final para detectar el utlimo y asi cambiar el texto del boton y cambiar la clase */

  let htmlFieldset = (id, cantidad) => `<fieldset id='fieldset_${id}' class="fieldset_dinamic">
  <!-- campos del formulario--->
  
  <div class="m-2">
      <select name="especie_${id}" id="especie_${id}" class="form-control" required="">
          <option value="" disabled selected>Especie</option>
          <option value="gato">Gato</option>
          <option value="perro">Perro</option>
      </select>
  </div>
  <div class="m-2">
      <input type="text" name="nombreMascota_${id}" id="nombreMascota_${id}" class="form-control" placeholder="Nombre" required="">
  </div>
  
  <div class="m-2">
      <input type="text" name="color_${id}" id="color_${id}" class="form-control" placeholder="Color" required="">
  </div>
  <div class="m-2">
      <input type="text" name="raza_${id}" id="raza_${id}" class="form-control" placeholder="Raza" required="">
  </div>
  <div class="m-2">
      <input type="text" name="edad_${id}" id="edad_${id}" class="form-control" placeholder="Edad" required="">
  </div>
  <div class="m-2">
      <select name="sexo_${id}" id="sexo_${id}" class="form-control" required="">
          <option value="" disabled selected >Sexo</option>
          <option value="F">Hembra</option>
          <option value="M">Macho</option>
      </select>
  </div>

  </div>
  <div class="mt-4 text-center">
      <button class="btn btn-secondary previous  previus_formulario mx-2">Atras</button>
      <button class="btn btn-primary ${cantidad == id ? "btnFinal" : "next next_formulario" } " ${ cantidad == id ? " onclick='btn_new_mas()'" : ""} > ${ cantidad == id ? "Finalizar" : "Siguiente"} </button>
  </div>
  </fieldset>`;


  //funcion para generar los fieldsets dinamicamente y agregarlos al formulario
  function generateFieldSet(cantidad) {
    $('.fieldset_dinamic').remove();
    let formMascotas = $(".form_mascotas");

    $(".form_mascotas").not(":first").empty();
      //formMascotas.append(htmlFieldset(1));

      for (let ct = 0; ct < cantidad; ct++) {
        const myFragment = document
          .createRange()
          .createContextualFragment(htmlFieldset(ct + 1, cantidad));

        //formDiv.appendChild(myFragment)
        formMascotas.append(myFragment);
      }
    
  }

  
});