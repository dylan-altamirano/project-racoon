<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Material;
use Session;
use App\Cart;
use App\User;
use App\CentroAcopio;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;


class CanjeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('canjes.index');
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
        return redirect()->route('canjes.create');
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

    public function agregarMaterial(Request $request, $id){

        $material = Material::find($id);

        $cart_ant = Session::has('cart')?Session::get('cart'):null;

        $cart = new Cart($cart_ant);

        $cart->agregar($material, $material->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('materiales.index');
    }
}
