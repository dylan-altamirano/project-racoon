<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Storage;
use Illuminate\Support\Facades\Input;
use App\Cupon;

class CuponController extends Controller
{
    public function index()
    {
        $cupones = Cupon::orderBy('nombre','desc')->get();    
        return view('cupones.index',['cupones'=>$cupones]);
    }
    public function create()
    {
        return view('cupones.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|min:5',
            'descripcion' => 'required|min:10',
            'cant_ecomonedas' => 'required',
            'activo' => 'required',
        ]);
       
        //Creacion del objeto
        $cupon = new Cupon([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'cant_ecomonedas' => $request->input('cant_ecomonedas'),
            'activo' => (!$request->has('activo')?0:1)
        ]);

        $cupon->save();
        
        return redirect()->route('cupones.index')->with('info','El cupon '.$request->input('nombre').' has sido creado con éxito.');
    }
    public function edit($id)
    {
        $cupones = Cupon::find($id);
        return view('cupones.edit',['cupones'=>$cupones]);
    }

    public function update(Request $request)
    {
        //Validacion
        $cupon = new Cupon([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'cant_ecomonedas' => $request->input('cant_ecomonedas'),
            'activo' => (!$request->has('activo')?0:1)
        ]);
        $cupon = Cupon::find($request->input('id'));  
    

        $cupon->nombre = $request->input('nombre');
        $cupon->descripcion = $request->input('descripcion');
        $cupon->cant_ecomonedas = $request->input('cant_ecomonedas');
        
        $cupon->activo = (!$request->has('activo')?0:1);
       

        $cupon->save();

        return redirect()->route('cupones.index')->with('info','El cupon '.$request->input('nombre').' has sido actualizado con éxito.');

    }

}
