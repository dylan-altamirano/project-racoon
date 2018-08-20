<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CentroAcopio;
use Auth;
use App\User;
use App\Rol;
use Gate;
use Illuminate\Support\Facades\Storage;
use App\Charts\Graficos;
use DB;
use Validator;
use Response;
use App\http\Requests;

class CentroAcopioController extends Controller
{

    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centros = CentroAcopio::orderBy('nombre','desc')->paginate(6);    
        $user=Auth::user();
        $roles = Rol::all();
        return view('centros.index',['centros'=>$centros,'user'=>$user,'roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $roles = Rol::all();
        return view('centros.create',['users'=>$users,'roles'=>$roles]);
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
            'user_id' => $request->input('role'),
            'activo' => (!$request->has('activo')?0:1)
        ]);

        
        $centros->user()->associate($request->input('role'));

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
        $users = User::all();
        $roles = Rol::all();
        $centros = CentroAcopio::find($id);

        return view('centros.edit',['centros'=>$centros,'users'=>$users,'roles'=>$roles]);
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

        $this->validate($request, [
            'nombre' => 'required|min:5',
            'direccion_exacta' => 'required|min:10',
            'provincia' => 'required',
            'activo' => 'required',
        ]);

        //Validacion
        $centros = new CentroAcopio([
            'nombre' => $request->input('nombre'),
            'direccion_exacta' => $request->input('direccion'),
            'provincia' => $request->input('provincia'),
            'user_id' => $request->input('role'),
            'activo' => (!$request->has('activo')?0:1)
        ]);
        $centros = CentroAcopio::find($request->input('id'));  
        
        $centros->user()->associate($request->input('role'));


        $centros->nombre = $request->input('nombre');
        $centros->direccion_exacta = $request->input('direccion_exacta');
        $centros->provincia = $request->input('provincia');
        
        $centros->activo = (!$request->has('activo')?0:1);
       

        $centros->save();

        return redirect()->route('centros.index')->with('info','El centro de acopio '.$request->input('nombre').' has sido actualizado con éxito.');

    }

    public function activarCentro(CentroAcopio $centro, Request $request){

        $this->validate($request, [
            'nombre' => 'required|min:5',
        ]);


        $centro->activo = (!$request->has('activo') ? 0 : 1);

        $centro->save();

        return redirect()->route('centros.index')->with('info', 'El centro de acopio ' . $request->input('nombre') . ' has sido actualizado con éxito.');

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

    public function getFiltroGrafico()
    {

        return view('centros.reporte');
    }

       //Reporte Gráfico de total de ecomonedas por centro de acopio
    public function grafico(Request $request)
    {

        $this->validate($request, [
            'fecha_ini' => 'required',
            'fecha_fin' => 'required'
        ]);

        $chart = new Graficos();

        $titulo = 'Cantidad total de ecomonedas';
        $materiales = DB::table('materiales')->join('canje_detalle', 'materiales.id', '=', 'canje_detalle.material_id')->join('canjes', 'canje_detalle.canje_id', '=', 'canjes.id')->join('centro_acopios', 'canjes.centro_acopio_id', '=', 'centro_acopios.id')->select(DB::raw("sum(materiales.precio_unitario) as Total"), DB::raw("centro_acopios.nombre as Centro"))->whereBetween('fecha', [$request->input('fecha_ini'), $request->input('fecha_fin')])->groupby(DB::raw("centro_acopios.nombre"))->get();

        $chart->labels($materiales->pluck('Centro'));

        $dataset = $chart->dataset($titulo, 'bar', $materiales->pluck('Total'));

        $dataset->backgroundColor(['#a9cce3', ' #a9dfbf', '#fad7a0', '#c39bd3', '#f9e79f', '#a3e4d7', '#fadbd8', '#e59866']);
        $dataset->color(['#2980b9', '#52be80', '#f0b27a', '#7d3c98', '#f4d03f', '#48c9b0', '#f1948a', '#d35400']);


        return view('centros.grafico', ['chart' => $chart]);

    }
}
