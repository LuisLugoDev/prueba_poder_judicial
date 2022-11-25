<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Models\Producto;

Route::get('/', function () {
    $productos = Producto::get();
    return view('home',compact('productos'));
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])
    ->name('register.store');

Route::get('/login', [SessionsController::class, 'create'])
    ->middleware('guest')
    ->name('login.index');

Route::post('/login', [SessionsController::class, 'store'])
    ->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('login.destroy');


Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth.admin')
    ->name('admin.index');

Route::post('/registrarCompra', [ComprasController::class, 'store'])
->name('registrarCompra.store');
    
Route::post('/generarFactura', [FacturasController::class, 'create'])
    ->name('generarFactura.create');
    
Route::resource('/facturas', FacturasController::class)->middleware('auth.admin');

Route::resource('/productos', ProductoController::class)->middleware('auth.admin');

// Route::get('/productos-create', [ProductosController::class, 'create'])
//     ->name('productos.create');

// Route::get('/productos-edit', [ProductosController::class, 'edit'])
//     ->name('productos.edit');
    
// Route::get('/productos-index', [ProductosController::class, 'index'])
//     ->name('productos.index');
    
// Route::put('/productos-update', [ProductosController::class, 'update'])
//     ->name('productos.update');
    