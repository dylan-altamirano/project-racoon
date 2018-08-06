<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Storage;
use Illuminate\Support\Facades\Input;
use App\Material;

class MaterialController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $materiales = Material::orderBy('nombre','desc')->get();    

        return view('materiales.index',['materiales'=>$materiales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materiales.create');
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
            'descripcion' => 'required|min:10',
            'precio' => 'required',
            'color' => 'required',
            'activo' => 'required',
            'datafile' => 'required|image|nullable|max:1999'
        ]);

      
        // llamada del metodo de carga de la imagen al servidor   
       // $imageNameToStore = uploadImage('datafile','public/imagenes');
       if($request->hasFile('datafile')){

            //get filename with the extension
            $filenameWithExt = $request->file('datafile')->getClientOriginalName();

            //Getting just the file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('datafile')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // upload the image
            $path = $request->file('datafile')->storeAs('public/imagenes',$fileNameToStore);


        }else{
            $fileNameToStore = 'default.jpg';
        }


        //Creacion del objeto
        $material = new Material([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio_unitario' => $request->input('precio'),
            'color' => $request->input('color'),
            'activo' => (!$request->has('activo')?0:1),
            'imagen' => $fileNameToStore
        ]);

        $material->save();
        
        return redirect()->route('materiales.index')->with('info','El material '.$request->input('nombre').' has sido creado con éxito.');
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

        $material = Material::find($id);

        return view('materiales.edit',['material'=>$material]);
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
        $this->validate($request, [
            'nombre' => 'required|min:5',
            'descripcion' => 'required|min:10',
            'precio' => 'required',
            'color' => 'required',
            'activo' => 'required',
            'datafile' => 'image|nullable|max:1999'
        ]);

        $material = Material::find($request->input('id'));    

         if($request->hasFile('datafile')){

            //get filename with the extension
            $filenameWithExt = $request->file('datafile')->getClientOriginalName();

            //Getting just the file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('datafile')->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // upload the image
            $path = $request->file('datafile')->storeAs('public/imagenes',$fileNameToStore);


        }else{
            $fileNameToStore = $material->imagen;
        }

        $material->nombre = $request->input('nombre');
        $material->descripcion = $request->input('descripcion');
        $material->precio_unitario = $request->input('precio');
        $material->color = $request->input('color');
        $material->activo = (!$request->has('activo')?0:1);
        $material->imagen = $fileNameToStore;

        $material->save();

        return redirect()->route('materiales.index')->with('info','El material '.$request->input('nombre').' has sido actualizado con éxito.');

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
