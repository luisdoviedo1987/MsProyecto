<form action="" method="get">

    <div class="stepper-wrapper">
        <div class="stepper-item completed">
          <div class="step-counter"></div>
          <div class="step-name">Informacion personal</div>
        </div>
        <div class="stepper-item completed">
          <div class="step-counter"></div>
          <div class="step-name">Informacion adicional</div>
        </div>
      </div>

      <fieldset>
        <div class="m-2">
            <select name="tipoIdentificacion" id="tipoIdentificacion" class="form-control" >
                <option value="" disabled selected>Tipo de identificación</option>
                <option value="nacional">Nacional</option>
                <option value="extranjero">Extranjero</option>
            </select>
        </div>
        <div class="m-2">
            <input type="text" name="identificacion" id="identificacion" class="form-control" placeholder="Identificación">
        </div>

        <div class="m-2">
            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
        </div>
        <div class="m-2">
            <input type="text" name="apellido" id="primerApellido" class="form-control" placeholder="Primer apellido">
        </div>
        <div class="m-2">
            <input type="text" name="apellido" id="segundoApellido" class="form-control" placeholder="Segundo apellido">
        </div>
        <div class="m-2">
            <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control" placeholder="Fecha de nacimiento">
        </div>
        <div class="m-2">
            <select name="tipoIdentificacion" id="tipoIdentificacion" class="form-control" >
                <option value="" disabled selected >Genero</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Feminino</option>
            </select>
        </div>
        <div class="m-2">
           <div class="d-flex justify-content-center">
               <div class="d">
                   <img src="assets/img/icon-oncosmart.svg" class="icon-onco" alt="Plan OncoSmart">
               </div>
               <div class="d-flex mx-3">
                   <div class="d">
                    <h6>¿Agregar OncoSmart?</h6>
                    <h6>Desde $2.26 c/u</h6>
                   </div>
                <div class="d mx-3">
                    <input type="checkbox" name="oncosmart" id="oncosmart" class="form-contro" placeholder="OncoSmart">
                </div>
               </div>
           </div>
        </div>
        <div class="mt-4 text-center">
            <button class="btn btn-primary next" id="next" >Siguiente</button>
        </div>
      </fieldset>
      <fieldset>
          <div class="m-2">
              <input type="text" name="telefonoCelular" id="telefonoCelular" class="form-control" placeholder="Telefono celular">
          </div>
          <div class="m-2">
               <input type="text" name="correoElectronico" id="correoElectronico" class="form-control" placeholder="Correo electronico">
          </div>
          <div class="m-2">
              <select name="provincia" id="provincia" class="form-control">
                    <option value = "" disabled selected>Provincia</option>
              </select>
          </div>
            <div class="m-2">
                <select name="canton" id="canton" class="form-control">
                        <option value = "" disabled selected>Cantón</option>
                </select>
            </div>
            <div class="m-2">
                <select name="distrito" id="distrito" class="form-control">
                        <option value = "" disabled selected>Distrito</option>
                </select>
            </div>
           
                <div class="m-2 d-flex justify-content-center my-3">
                    <button class="btn btn-secondary previous mx-2" type="button">Atras</button>
                    <a class="btn btn-primary mx-2" href="plan-inteligente.php" type="button">Finalizar</a>
                  </div>
            
      </fieldset>
    
</form>

