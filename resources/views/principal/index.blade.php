@extends('layouts.master')

@section('titulo', 'La modena ecológica de Costa Rica')

@section('contenido')

    {{--HEADER--}}

    <header class="bg-success text-white">
        <div class="container text-center">
            <h1>Bienvenido al sitio principal de la moneda ecológica de Costa Rica</h1>
            <p class="lead">En esta página encontraras todo lo que necesitas saber para comenzar a obtener ecomonedas. Es muy simple y, práctico.
                Siéntase en libertad de explorar nuestras opciones antes de tomar una decisión.
            </p>
        </div>
    </header>

    {{--END of HEADER--}}


    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Ecolones</h2>
                    <p class="lead">Ya llegó a nuestro país, una nueva forma de hacer dinero. Estos son los beneficios con los 
                        que contamos:
                    </p>
                    <ul>
                        <li>Ayudas con el ambiente</li>
                        <li>Tenés dinero disponible con poca inversión</li>
                        <li>Inpiras a otras personas a ayudar con la causa también</li>
                        <li>Sos un importante factor del cambio para nuestro planeta</li>
                        <li>Lo que sea</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Contactenos</h2>
                    <p class="lead">
                        Puedes escribirnos, llamarnos o incluso venir a nuestras instalaciones ubicadas en centro Eurocenter en Barrial de Heredia,
                        te despejamos todas tus dudas. <br><br> Tel. 2440-33-07 | 2442-76-88 <br> Correo
                        Electrónico: soporte@ecomonedacr.com
                    </p>
                </div>
            </div>
        </div>
    </section>


@endsection