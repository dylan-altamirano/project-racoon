@extends('layouts.master') 
@section('titulo', 'Dashboard') 
@section('contenido')

<section id="dashboard">

    <div class="container">
        <div class="row">

        <h2 class="text-center" style="margin-bottom:2%">Hola {{ Auth::user()->name }}, bienvenido a Ecomonedas!</h2>

        @can('admin-all')
        <div class="col-md-12" style="margin-bottom:4%">
            <div class="card">
                <div class="card-body">
                    <h2 class="float-left">Crear Usuarios</h2>
                    <a href="{{ route('auth.registeradmin') }}" class="btn btn-dark btn-lg float-right"><i class="material-icons">supervisor_account</i></a>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom:4%">
            <div class="card">
                <div class="card-body">
                    <h2 class="float-left">Actualizar Administradores de centros de acopio</h2>
                    <a href="{{ route('auth.edit') }}" class="btn btn-dark btn-lg float-right"><i class="material-icons">group_add</i></a>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="margin-bottom:4%">
            <div class="card">
                <div class="card-body">
                    <h2 class="float-left">Listado de clientes</h2>
                    <a href="{{ route('auth.index') }}" class="btn btn-dark btn-lg float-right"><i class="material-icons">menu</i></a>
                </div>
            </div>
        </div>
        @endcan

        @can('admin-center')
            <div class="col-md-12" style="margin-bottom:3%">
                <div class="card">
                    <div class="card-body">
                        <h2 class="float-left">Canjear Materiales</h2>
                    <a href="{{ route('canjes.index') }}" class="btn btn-dark btn-lg float-right"><i class="material-icons">monetization_on</i></a>
                    </div>
                </div>
            </div>
       @endcan
        
       @can('cliente')
            <div class="col-md-12" style="margin-bottom:3%">
                <div class="card">
                    <div class="card-body">
                        <h2 class="float-left">Billetera Virtual</h2>
                    <a href="{{ route('billeteravirtual.index') }}" class="btn btn-dark btn-lg float-right"><i class="material-icons">style</i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-12" style="margin-bottom:3%">
                <div class="card">
                    <div class="card-body">
                        <h2 class="float-left">Historial Cupones</h2>
                        <a href="{{ route('billeteravirtual.showAll') }}" class="btn btn-dark btn-lg float-right"><i class="material-icons">home</i></a>
                    </div>
                </div>
            </div>
       @endcan     
    </div>
</section>

@endsection