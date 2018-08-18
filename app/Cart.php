<?php

namespace App;

class Cart 
{
    public $items = null;
    public $cantidadTotal = 0;
    public $precioTotal = 0;

    public function __construct($cart_ant){
        if($cart_ant){
            $this->items = $cart_ant->items;
            $this->cantidadTotal = $cart_ant->cantidadTotal;
            $this->precioTotal = $cart_ant->precioTotal;
        }
    }

    public function agregar($item, $id){
        $item_almacenado = ['cant'=>0 , 'precio' => $item->precio_unitario, 'item'=> $item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $item_almacenado = $this->items[$id];
            }
        }

        $item_almacenado['cant']++;
        $item_almacenado['precio'] = $item->precio_unitario * $item_almacenado['cant'];
        $this->items[$id]= $item_almacenado;
        $this->cantidadTotal++;
        $this->precioTotal += $item->precio_unitario;
    }


    /**
     * Reduce la cantidad de un producto en 1.
     */
    public function reducirCantidad($item, $id){

        $item_almacenado = ['cant' => 0, 'precio' => $item->precio_unitario, 'item' => $item];

        if ($this->items) {

            if (array_key_exists($id, $this->items)) {
                $item_almacenado = $this->items[$id];

                if($item_almacenado['cant']<=1){
                    $this->eliminarItem($item, $id);

                    exit;

                }else{
                    $item_almacenado['cant']--;
                }

                $this->items[$id] = $item_almacenado;
                $this->cantidadTotal--;
                $this->precioTotal -= $item->precio_unitario;                
            }
        }
    }

    /**
     * Elimina un item del carro. 
     */
    public function eliminarItem($item, $id){

        if ($this->items) {

            if (array_key_exists($id, $this->items)) {
                
                unset($this->items[$id]);
            }
        }

    }
}
