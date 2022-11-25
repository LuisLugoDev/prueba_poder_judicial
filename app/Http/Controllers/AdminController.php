<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Compras;
use App\Models\User;
use App\Models\Facturas;
use Illuminate\Http\Request;

class AdminController extends Controller {
    
    public function index() {
        $facturas = Facturas::get();
        $productos = Producto::get();

        return view('admin/index',compact('facturas','productos'));
    }
}
