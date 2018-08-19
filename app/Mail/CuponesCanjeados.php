<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CuponesCanjeados extends Mailable
{
    use Queueable, SerializesModels;

    public $canjeCupon;
    public $cliente;
    public $cupones;
    public $cantidadTotal;
    public $ecomonedasTotal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($canjeCupon, $cliente, $cupones, $cantidadTotal, $ecomonedasTotal)
    {
        $this->canjeCupon = $canjeCupon;
        $this->cliente = $cliente;
        $this->cupones = $cupones;
        $this->cantidadTotal = $cantidadTotal;
        $this->ecomonedasTotal = $ecomonedasTotal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notifications@ecodivisa.online')->markdown('correo.cuponesCanjeados');
    }
}
