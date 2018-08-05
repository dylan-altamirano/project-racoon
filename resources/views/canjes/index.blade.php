@extends('layouts.master') 
@section('titulo', 'Canjes') 
@section('contenido')

<section id="Canjes">
    <div class="container">

        @if(Session::has('info'))
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-info">{{Session::get('info')}}</p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title float-left">Historial de Canjes</h5>
                    <a href="{{ route('materiales.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="top" title="Crear un nuevo canje"><i class="material-icons">shopping_cart</i></a>
                    </div>
                        <div class="card-body">
                            <table class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nº</th>
                                        <th scope="col">Centro Acopio</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th scope="row">1</th>
                                    <td>San Jose</td>
                                    <td>07/20/2018</td>
                                    <td><a href="#" class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Editar"><i class="material-icons">create</i></a></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection