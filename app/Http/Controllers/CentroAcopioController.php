<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CentroAcopio;
use Auth;

class CentroAcopioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $centros = CentroAcopio::orderBy('nombre','desc')->get();    

        return view('centros.index',['centros'=>$centros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('centros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|min:5',
            'direccion_exacta' => 'required|min:10',
            'provincia' => 'required',
            
            'activo' => 'required',
        ]);
        

        //Creacion del objeto
        $centros = new CentroAcopio([
            'nombre' => $request->input('nombre'),
            'direccion_exacta' => $request->input('direccion_exacta'),
            'provincia' => $request->input('provincia'),
            
            'activo' => (!$request->has('activo')?0:1)
        ]);

        $user=Auth::user();
        $centros->user()->associate($user);

        $centros->save();
        
        return redirect()->route('centros.index')->with('info','El centro de acopio '.$request->input('nombre').' has sido creado con éxito.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $centros = CentroAcopio::find($id);

        return view('centros.edit',['centros'=>$centros]);
    }

    public function habilitar($id)
    {

        $centros = CentroAcopio::find($id);

        return view('centros.habilitar',['centros'=>$centros]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Validacion
        $centros = new CentroAcopio([
            'nombre' => $request->input('nombre'),
            'direccion_exacta' => $request->input('direccion'),
            'provincia' => $request->input('provincia'),
            
            'activo' => (!$request->has('activo')?0:1)
        ]);
        $centros = CentroAcopio::find($request->input('id'));  
        
        $user=Auth::user();
        $centros->user()->associate($user);

        $centros->nombre = $request->input('nombre');
        $centros->direccion_exacta = $request->input('direccion_exacta');
        $centros->provincia = $request->input('provincia');
        
        $centros->activo = (!$request->has('activo')?0:1);
       

        $centros->save();

        return redirect()->route('centros.index')->with('info','El centro de acopio '.$request->input('nombre').' has sido actualizado con éxito.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}