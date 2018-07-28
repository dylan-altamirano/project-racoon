<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Storage;
use Illuminate\Support\Facades\Input;
use App\Material;

class MaterialController extends Controller
{
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
     * Este método se encarga de cargar la imagen al 
     * servidor y, de proveer el nombre de la imagen a guardar
     * en la base de datos.
     * 
     * @param string $container
     * @param string $path
     * @return string $fileNameToStore
     */
    private function uploadImage($container, $path){

        if($request->hasFile($container)){

            //get filename with the extension
            $filenameWithExt = $request->file($container)->getClientOriginalName();

            //Getting just the file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file($container)->getClientOriginalExtension();

            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // upload the image
            $path = $request->file($container)->storeAs($path,$fileNameToStore);


        }else{
            $fileNameToStore = 'default.jpg';
        }

        return $fileNameToStore;

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
