@extends('layouts.master') 
@section('titulo', 'Canjes') 
@section('contenido')
    @include('partials.errors')
<section id="Canjes">
    <div class="container">

            <div class="row" style="margin-bottom:3%">
                <!--INICIO ENCABEZADO CANJE-->
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Detalles del Canje</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fecha"><h6>Fecha</h6></label> <span class="badge badge-pill badge-light">{{ $canje->fecha }}</span>
                                <!--Campo Hidden para guardar la fecha-->
                            </div>

                            <div class="form-group row">
                                <label for="centro_acopios" class="col-md-2">Centro de Acopio</label>
                                <div class="col-md-4">
                                    <h5><span class="badge badge-light">{{ $centro_acopio->nombre }}</span></h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Cliente" class="col-md-2">Cliente Registrado: </label>
                                <div class="col-md-4 float-right">
                                <h4><span id="lblNombreCliente" class="col-md-6 badge badge-light">{{ $cliente->name }}</span></h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--FIN ENCABEZADO CANJE-->
            </div>

            <div class="row">

                <!--INICIO DETALLES DEL CANJE-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title float-left">Materiales a Canjear</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nº</th>
                                        <th scope="col">Material</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($materiales as $item)
                                    <tr>
                                        <th scope="col">{{ $item->id}}</th>
                                        <td scope="col">{{ $item->nombre}}</td>
                                        <td scope="col">{{ $item->pivot->cantidad }}</td>
                                        <td scope="col">{{ '₡ '.$item->precio_unitario }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--FIN DETALLES DEL CANJE-->
            </div>
            <!--Final Row-->

            <!--Parte de Totales del Canje-->
            <div class="row" style="margin-top:3%">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Total de Materiales: </th>
                                        <td><strong>{{ $cantidadTotal }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total de Ecomonedas: </th>
                                        <td><strong>{{' ₡'.$precioTotal}}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                        <p>Este canje fue registrado por: <span class="badge badge-info">{{ $admin_centro->name }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!--Final parte de totales del Canje-->

    </div>
</section>
@endsection