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
        $this->cantidadTotal++;
        $this->precioTotal += $item->precio_unitario;
    }
}