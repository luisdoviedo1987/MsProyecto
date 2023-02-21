<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//models
use App\Productos;

class ProductosController extends Controller
{
    function getAgregarBeneficiario() {
        return Productos::where('isActive', 1)
                         ->where('codigo', 'ADDBENE')
                         ->first();
    }

    function getAgregarOncosmartBeneficiario() {
        return Productos::where('isActive', 1)
                         ->where('codigo', 'ADDONCOBEN')
                         ->first();
    }

    function getAgregarOncosmartAfiliado() {
        return Productos::where('isActive', 1)
                         ->where('codigo', 'ADDONCOAFIL')
                         ->first();
    }

    function getAgregarMascota() {
        return Productos::where('isActive', 1)
                         ->where('codigo', 'ADDPET')
                         ->first();
    }

    function getAgregarPlan() {
        return Productos::where('isActive', 1)
                         ->where('codigo', 'ADDPLAN')
                         ->first();
    }

    function getByCode($code) {
        return Productos::where('isActive', 1)
                         ->where('codigo', $code)
                         ->first();
    }
    
}
