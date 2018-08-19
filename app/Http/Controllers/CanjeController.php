<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Material;
use Session;
use App\Cart;
use App\User;
use App\Canje;
use App\CentroAcopio;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use PDF;
use Illuminate\Mail\Mailer;
use App\Mail\OrdenNotificacion;
use App\Mail\CanjeNotificacion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;



class CanjeController extends Controller
{

    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $centro_acopio = CentroAcopio::where('user_id', Auth::user()->id)->first();

        $canjes = Canje::where('centro_acopio_id', $centro_acopio->id)->paginate(5);

        $centros_acopio = CentroAcopio::all();

        return view('canjes.index', ['canjes' => $canjes, 'centros_acopio'=> $centros_acopio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtiene el id del usuario logueado en el sistema
        $user_id = Auth::id();

        $centro_acopio = CentroAcopio::where('user_id', $user_id)->first();

        $centro_acopio = ($centro_acopio!=null)? $centro_acopio:'No posee centro de acopio';

        //Obtiene el carro con los materiales previamente guardados
        $cart_ant = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($cart_ant);

        $cliente = null;

        return view('canjes.create', ['cliente'=>$cliente,'centro_acopio' => $centro_acopio,'productos'=>$cart->items,'cantidadTotal'=>$cart->cantidadTotal, 'precioTotal'=>$cart->precioTotal]);
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
            'fecha' => 'required',
            'emailCliente' => 'required | min:10',
            'cliente' => 'required',
            'centro_acopio_id' => 'required'
        ]);

        //Obtiene los objetos necesarios
        //Obtiene el cliente
        $cliente = User::find($request->input('cliente'));

        //Obtiene el centro de acopio
        $centro_acopio = CentroAcopio::find($request->input('centro_acopio_id'));

        //Obtiene los materiales
        //Obtiene el carro con los materiales previamente guardados
        $cart_ant = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($cart_ant);

        //Crea un arreglo con los items del carro de compras
        $materiales_items = $cart->items;

        //Sacar la colección solo de materiales
        $materiales_collection = $this->obtieneArregloMateriales($materiales_items);

        //Convertir la coleccion a un arreglo
        $materiales = $materiales_collection->all();

        $materiales_id = array_pluck($materiales, 'id');

        //Obtiene las cantidades
        //$cantidades = $this->obtieneArregloCantidades($materiales_items)->all();
        $cantidades = array_pluck($materiales_items, 'cant');

        //Crea el objeto Canje 
        $canje = new Canje([
            'fecha' => $request->input('fecha'),
            'activo' => true
        ]);

        //Asocia el centro de acopio
        $canje->centrosacopio()->associate($centro_acopio);

        //Asocia el cliente con el canje
        $canje->usuario()->associate($cliente);

        $canje->save();

        $combined_data = array_combine($materiales_id, $this->obtenerPivotData($cantidades));

        //Asocia el arreglo de materiales al canje
        $canje->materiales()->attach($combined_data === null ? [] : $combined_data);
        
        //Actualiza el balance de ecomonedas del cliente
        $cliente->balance_ecomonedas += $cart->precioTotal;
        $cliente->save();    
        
        $this->limpiarShoppingCart($request);    

        //Enviar correo

        Mail::to($cliente->email)->send(new CanjeNotificacion($canje, $cliente, $centro_acopio, $cart->items, $cart->cantidadTotal, $cart->precioTotal));

        return redirect()->route('canjes.index')->with('info','El canje has sido creado con exito. Se le ha enviado la notificación al correo electrónico.');
    }

    public function obtenerPivotData($arreglo){

        $pivotData = array(['cantidad' => $arreglo[0]]);

        for ($i=1; $i < count($arreglo) ; $i++) { 
            array_push($pivotData, ['cantidad'=> $arreglo[$i]]);
        }

        return $pivotData;
    }

    public function limpiarShoppingCart(Request $request){
        //Establecemos el carrito en cero otra vez
        $cart = new Cart(null);

        $request->session()->put('cart', $cart);
    }


    public function obtieneArregloMateriales($arreglo){

        $materiales = collect([]);

            foreach($arreglo as $item){

                $material = new Material;

                $material = $item['item'];

                $materiales->push($material);
            }

        return $materiales;
    }

    public function obtieneArregloCantidades($arreglo){
        
         $cantidades = collect([]);   

         foreach($arreglo as $cantidad){

            $cantidades->push($cantidad['cant']);
         }


         return $cantidades;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $canje = Canje::find($id);

        $centro_acopio = CentroAcopio::find($canje->centrosacopio->id);

        $cliente = User::find($canje->usuario->id);

        $admin_centro = User::find($centro_acopio->user->id);

        $materiales = $canje->materiales;

        $cantidadTotal = 0;
        $precioTotal =0;

        foreach($materiales as $material){
            $cantidadTotal+= $material->pivot->cantidad;
            $precioTotal += $material->precio_unitario;
        }

        return view('canjes.show', ['canje'=>$canje,'centro_acopio'=>$centro_acopio, 'cliente'=>$cliente,'admin_centro'=>$admin_centro,'materiales'=>$materiales,'cantidadTotal'=>$cantidadTotal,'precioTotal'=>$precioTotal]);

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

    public function agregarMaterial(Request $request, $id){

        $material = Material::find($id);

        $cart_ant = Session::has('cart')?Session::get('cart'):null;

        $cart = new Cart($cart_ant);

        $cart->agregar($material, $material->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('materiales.index');
    }

    public function reducirEnUno(Request $request, $id){

        $material = Material::find($id);

        $cart_ant = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($cart_ant);

        $cart->reducirCantidad($material, $material->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('canjes.create');

    }

    public function eliminarElemento(Request $request, $id){

        $material = Material::find($id);

        $cart_ant = Session::has('cart') ? Session::get('cart') : null;

        $cart = new Cart($cart_ant);

        $cart->eliminarItem($material, $material->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('canjes.create');
    }

}
