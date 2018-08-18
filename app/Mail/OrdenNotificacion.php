<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrdenNotificacion extends Mailable
{
    use Queueable, SerializesModels;

    public $canje;
    public $cliente;
    public $centro_acopio;
    public $materiales;
    public $cantidadTotal;
    public $precioTotal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($canje, $cliente, $centro_acopio, $materiales, $cantidadTotal, $precioTotal)
    {
        $this->canje = $canje;
        $this->cliente = $cliente;
        $this->centro_acopio = $centro_acopio;
        $this->materiales = $materiales;
        $this->cantidadTotal = $cantidadTotal;
        $this->precioTotal = $precioTotal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notifications@ecodivisa.online')->view('correo.mail');
    }
}
