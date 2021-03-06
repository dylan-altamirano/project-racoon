<?php

namespace App;

class CartCupones
{
    public $items = null;
    public $cantidadTotal = 0;
    public $ecomonedasTotal = 0;

    public function __construct($cart_ant)
    {
        if ($cart_ant) {
            $this->items = $cart_ant->items;
            $this->cantidadTotal = $cart_ant->cantidadTotal;
            $this->ecomonedasTotal = $cart_ant->ecomonedasTotal;
        }
    }

    public function agregar($item, $id)
    {
        $item_almacenado = ['cant' => 0, 'valor_ecomonedas' => $item->cant_ecomonedas, 'item' => $item];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $item_almacenado = $this->items[$id];
            }
        }

        $item_almacenado['cant']++;
        $item_almacenado['valor_ecomonedas'] = $item->cant_ecomonedas * $item_almacenado['cant'];
        $this->items[$id] = $item_almacenado;
        $this->cantidadTotal++;
        $this->ecomonedasTotal += $item->cant_ecomonedas;
    }


    /**
     * Reduce la cantidad de un producto en 1.
     */
    public function reducirCantidad($item, $id)
    {

        $item_almacenado = ['cant' => 0, 'valor_ecomonedas' => $item->cant_ecomonedas, 'item' => $item];

        if ($this->items) {

            if (array_key_exists($id, $this->items)) {
                $item_almacenado = $this->items[$id];

                if ($item_almacenado['cant'] <= 1) {

                    $this->eliminarItem($item, $id);

                } else {
                    $item_almacenado['cant']--;

                    $item_almacenado['valor_ecomonedas'] -= $item->cant_ecomonedas;

                    $this->items[$id] = $item_almacenado;
                    $this->cantidadTotal--;
                    $this->ecomonedasTotal -= $item_almacenado['valor_ecomonedas'];
                }


            }
        }
    }

    /**
     * Elimina un item del carro. 
     */
    public function eliminarItem($item, $id)
    {

        if ($this->items) {

            if (array_key_exists($id, $this->items)) {

                $item_almacenado = $this->items[$id];

                unset($this->items[$id]);

                $this->cantidadTotal--;
                $this->ecomonedasTotal -= $item_almacenado['valor_ecomonedas'];

            }
        }

    }
}
