@extends('layouts.master') 
@section('titulo', 'Dashboard') 
@section('contenido')

<section id="dashboard">

    <div class="container">
        <div class="row">

        <h2 class="text-center" style="margin-bottom:2%">Hola {{ Auth::user()->name }}, bienvenido a Ecomonedas!</h2>

        @can('admin-center')
            <div class="col-md-12" style="margin-bottom:3%">
                <div class="card">
                    <div class="card-body">
                        <h2 class="float-left">Canjear Materiales</h2>
                    <a href="{{ route('materiales.index') }}" class="btn btn-dark btn-lg float-right"><i class="material-icons">monetization_on</i></a>
                    </div>
                </div>
            </div>
       @endcan
        
            <div class="col-md-12" style="margin-bottom:3%">
                <div class="card">
                    <div class="card-body">
                        <h2 class="float-left">Billetera Virtual</h2>
                    <a href="{{ route('billeteravirtual.index') }}" class="btn btn-dark btn-lg float-right"><i class="material-icons">style</i></a>
                    </div>
                </div>
            </div>

    </div>
</section>

@endsection