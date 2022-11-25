<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Compras;
use App\Models\Facturas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //obteniendo usuarios para facturar
        $users =  Compras::distinct('user_id')->where('facturado','0')->pluck('user_id');

        if($users->count() == 0){
            $status = "No hay compras por facturar!";            
            return redirect()->back()->with('status',$status);   
        }

        foreach($users as $user){
            $compras = Compras::where('user_id',$user)->where('facturado','0')->get();
            $monto_total = 0;
            $impuesto_total = 0;
            foreach($compras as $compra){
                $monto_total += $compra->monto;
                $impuesto_total += $compra->impuesto;
            }
            $factura = Facturas::create([
                'user_id' => $user,
                'monto_total' => $monto_total,
                'impuesto_total' => $impuesto_total
            ]);
            $compra = Compras::where('user_id',$user)->where('facturado','0');
                $compra->update([
                    'facturado' => 1,
                    'factura_id' => $factura->id
                ]); 
        }
        $status = "Facturas generadas con exito!";            
      return redirect()->back()->with('status',$status);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facturas  $Facturas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $factura = Facturas::find($id);

        return view('factura.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facturas  $Facturas
     * @return \Illuminate\Http\Response
     */
    public function edit(Facturas $Facturas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facturas  $Facturas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facturas $Facturas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(productos $productos)
    {
        //
    }
}
