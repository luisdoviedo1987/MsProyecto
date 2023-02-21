
<!--The acutal content of the sidebar-->
<div class="sidebar text-gris" id="sidebar">
  <div class="container-liner">
    <div class="card">
        <div class="card-header bg-white mt-5 border-0">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <div class="">
                        <h5>
                            <b>
                            Resumen de pedido
                            </b> 
                        </h5>
                    </div>
                    <div class="">
                        <p>3 beneficiarios agregados</p>    
                    </div>
                </div>
                <a class="btn" onclick="toggleSidebar()">
                    <i class="far fa-times-circle fa-2x text-secondary"></i>
                </a>
            </div>
            <div class="text-gris-d mt-4" style="border-bottom: 1px solid;"></div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless text-gris">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">
                                <div class="d-block d-sm-block d-md-none">
                                    <i class="far fa-arrow-alt-circle-right fa-2x"></i>
                                </div>
                            </th>
                        <th scope="col"></th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Sub total</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <th scope="row">
                                <img src="assets/img/icon.svg" alt="Beneficiarios adicionales" class="icon_planes">
                            </th>
                            <td class="text-start pb-4">
                                <h5>Mensual titular</h5>
                                Erick Pérez Rayo
                            </td>
                            <td>1</td>
                            <td>$12</td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <img src="assets/img/icon.svg" alt="Beneficiarios adicionales" class="icon_planes">
                            </th>
                            <td class="text-start pb-4">
                                <h5>Beneficiarios adicional</h5>
                                Marcela Rodríguez <br>
                                Verny Umaña<br>
                                Maxi Ovares
                            </td>
                            <td>1</td>
                            <td>$36</td>
                        </tr>
                        <tr>
                            <th scope="row">
                              <img src="assets/img/icon.svg" alt="Beneficiarios adicionales" class="icon_planes">
                            </th>
                            <td class="text-start pb-4">
                                <h5>Plan OncoSmart</h5>
                                Marcela Rodríguez
                            </td>
                            <td>1</td>
                            <td>$2</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="search-wrapper cf d-flex justify-content-around align-items-center">
                                    <input type="text" class="text-gris" value="Med012345" required style="box-shadow: none">
                                    <button type="submit">Aplicar</button>
                                </div>
                            </td>
                            <th>Descuento</th>
                            <td>$8</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center bg-white border-0">
            <table class="table table-borderless text-gris">
                <tfoot class="text-end">
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td class="border-bottom">Subtotal</td> 
                                <td class="border-bottom">$42.00</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td class="border-bottom">IVA </td>
                                <td class="border-bottom">$2.00</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td class="border-bottom">Total</td>
                                <td class="border-bottom">$44.00</td>
                            </tr>
                </tfoot>
            </table>
          <a type="button" class="btn btn-primary btn-block px-10" href="informacion-pago.php" >Proceder a pagar</a>
        </div>
    </div>
  </div>
</div>