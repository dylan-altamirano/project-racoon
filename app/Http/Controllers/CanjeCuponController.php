<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Canje;
use App\Cupon;
use Session;
use App\CartCupones;
use App\CanjeCupon;
use Mail;
use App\Mail\CuponesCanjeados;

class CanjeCuponController extends Controller
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
        
        $cliente = Auth::user();

        $canjes = Canje::where('user_id', $cliente->id)->get();

        $total_monedas_canjeadas = $this->totalEcomonedasCanjeadas();
        $total_monedas_generadas = $this->totalMonedasGeneradas();

        return view('billeteravirtual.index',['cliente'=>$cliente,'canjes'=>$canjes,'monedasCanjeadasTotal' => $total_monedas_canjeadas,'monedasGeneradasTotal'=>$total_monedas_generadas]);

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

    
        //Obtiene el carro con los materiales previamente guardados
        $cart_ant = Session::has('cart_cupones') ? Session::get('cart_cupones') : null;

        $cart = new CartCupones($cart_ant);

        $cliente = User::find($user_id);

        return view('billeteravirtual.create', ['cliente' => $cliente, 'cupones' => $cart->items, 'cantidadTotal' => $cart->cantidadTotal, 'ecomonedasTotal' => $cart->ecomonedasTotal]);

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
            'cliente_id' => 'required'
        ]);
        
        $cliente = User::find($request->input('cliente_id'));

         //Obtiene el carro con los cupones previamente guardados
        $cart_ant = Session::has('cart_cupones') ? Session::get('cart_cupones') : null;

        $cart = new CartCupones($cart_ant);

        //Crea un arreglo con los items del carro de compras
        $cupones_items = $cart->items;

         //valida que el cliente posea suficiente balance para
         //canjear los cupones. De lo contrario, no se puede canjear.           
        if($cliente->balance_ecomonedas >= $cart->ecomonedasTotal){

              //Sacar la colección solo de cupones
            $cupones_collection = $this->obtieneArregloCupones($cupones_items);

        //Convertir la coleccion a un arreglo
            $cupones = $cupones_collection->all();

            $cupones_id = array_pluck($cupones, 'id');

        //Obtiene las cantidades
        //$cantidades = $this->obtieneArregloCantidades($materiales_items)->all();
            $cantidades = array_pluck($cupones_items, 'cant');

         //Crea el objeto Canje 
            $canjeCupon = new CanjeCupon([
                'fecha' => $request->input('fecha'),
                'activo' => true
            ]);

        //Asocia el cliente con el canje
            $canjeCupon->usuario()->associate($cliente);

            $canjeCupon->save();

            $combined_data = array_combine($cupones_id, $this->obtenerPivotData($cantidades));

         //Asocia el arreglo de cupones al canje
            $canjeCupon->cupones()->attach($combined_data === null ? [] : $combined_data);

            //Actualiza el balance de ecomonedas del cliente restando la cantidad
            //del total del canje al mismo.
            $cliente->balance_ecomonedas -= $cart->ecomonedasTotal;
            $cliente->save();    

            //Envío de correo
            Mail::to($cliente->email)->send(new CuponesCanjeados($canjeCupon, $cliente, $cart->items, $cart->cantidadTotal, $cart->ecomonedasTotal));    

        
            $this->limpiarShoppingCart($request);

            return redirect()->route('billeteravirtual.index')->with('info', 'Los cupones han sido canjeados satisfactoriamente. Se le ha enviado una notificación por correo.');

        }else{

            $this->limpiarShoppingCart($request);

            return redirect()->route('billeteravirtual.index')->with('info', 'Oops! Parece ser que no hay suficiente ecomonedas para efectuar el canje. Por favor, intentelo más tarde.');

        }

    }

    public function obtieneArregloCupones($arreglo)
    {

        $cupones = collect([]);

        foreach ($arreglo as $item) {

            $cupon = new Cupon;

            $cupon = $item['item'];

            $cupones->push($cupon);
        }

        return $cupones;
    }

    public function limpiarShoppingCart(Request $request)
    {
        //Establecemos el carrito en cero otra vez
        $cart = new CartCupones(null);

        $request->session()->put('cart_cupones', $cart);
    }

    public function obtenerPivotData($arreglo)
    {

        $pivotData = array(['cantidad' => $arreglo[0]]);

        for ($i = 1; $i < count($arreglo); $i++) {
            array_push($pivotData, ['cantidad' => $arreglo[$i]]);
        }

        return $pivotData;
    }

    public function mostrarCuponesCanjeados(){

        $id = Auth::id();

        $canjecupones = CanjeCupon::where('user_id', $id)->get();


        $cupones = collect([]);
        //$cantidades = collect([]);

        foreach ($canjecupones as $canjecupon) {

            foreach($canjecupon->cupones as $cupon){

                $cupones->push($cupon);
               //$cantidades->push([$cupon->id=>$cupon->pivot->cantidad]);
            }

        }

        return view('billeteravirtual.showAll',['cupones'=> $cupones->all(),'cliente'=>Auth::user()]);
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

    public function agregarCupon(Request $request, $id)
    {

        $cupon = Cupon::find($id);

        $cart_ant = Session::has('cart_cupones') ? Session::get('cart_cupones') : null;

        $cart = new CartCupones($cart_ant);

        $cart->agregar($cupon, $cupon->id);

        $request->session()->put('cart_cupones', $cart);

        return redirect()->route('cupones.index');
    }

    public function reducirEnUno(Request $request, $id)
    {

        $cupon = Cupon::find($id);

        $cart_ant = Session::has('cart_cupones') ? Session::get('cart_cupones') : null;

        $cart = new CartCupones($cart_ant);

        $cart->reducirCantidad($cupon, $cupon->id);

        $request->session()->put('cart_cupones', $cart);

        return redirect()->route('billeteravirtual.create');

    }

    public function eliminarElemento(Request $request, $id)
    {

        $cupon = Cupon::find($id);

        $cart_ant = Session::has('cart_cupones') ? Session::get('cart_cupones') : null;

        $cart = new CartCupones($cart_ant);

        $cart->eliminarItem($cupon, $cupon->id);

        $request->session()->put('cart_cupones', $cart);

        return redirect()->route('billeteravirtual.create');
    }


    //Metodo PDF
    public function descargarPDF($id, $cant)
    {
        $cupon= Cupon::find($id);

        $pdf = PDF::loadView('billeteravirtual.reportePDF', ['cupon'=> $cupon,'cant'=>$cant]);

        return $pdf->download('Cupon' . $id . '.pdf');

    }

    public function totalEcomonedasCanjeadas(){

        $user = Auth::user();

        $canjecupones = CanjeCupon::where('user_id', $user->id)->get();

        $suma_total = 0;

        foreach($canjecupones as $canjecupon){
            foreach($canjecupon->cupones as $cupon){
                $suma_total += $cupon->cant_ecomonedas;
            }
        }

        return $suma_total;

    }

    public function totalMonedasGeneradas(){

        return $this->totalEcomonedasCanjeadas() + Auth::user()->balance_ecomonedas;
    }


}
