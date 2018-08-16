@extends('layouts.master') 
@section('titulo', 'Canjear Cupones') 
@section('contenido')

@include('partials.errors')

<section id="CanjeCupones">
    <div class="container">

        <!--FORM CHECKOUT CANJE-->
    <form action="{{ route('billeteravirtual.create') }}" method="POST" enctype="multipart/form-data">

            <div class="row" style="margin-bottom:3%">
                <!--INICIO ENCABEZADO CANJE-->
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Detalles del Canje</h5>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="fecha"><h6>Fecha</h6></label> <span class="badge badge-pill badge-light">{{ date('d/M/y h:i:sa') }}</span>
                                <input type="hidden" name="fecha" id="fecha" value="{{ date('Y-m-d H:i:s') }}">
                                <!--Campo Hidden para guardar la fecha-->
                            </div>

                            <div class="form-group row">
                                <label for="centro_acopios" class="col-md-2">Cliente</label>
                                <div class="col-md-4">
                                    <input type="hidden" name="cliente_id" id="cliente_id" value="{{ $cliente->id }}">
                                    <!--Campo Hidden para guardar el id del centro de acopio-->
                                    <h5><span class="badge badge-light">{{ $cliente->name }}</span></h5>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Cliente" class="col-md-2">Correo Electrónico: </label>
                                <div class="col-md-3">
                                    <h5><span class="badge badge-light">{{ $cliente->email }}</span></h5>
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
                            <h5 class="card-title float-left">Cupones a Canjear</h5>
                        </div>
                        <div class="card-body">
                            @if($cupones !=null)
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nº</th>
                                        <th scope="col">Cupón</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Valor Ecomonedas</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($cupones as $item)
                                    <tr>
                                        <th scope="col">{{ $item['item']['id']}}</th>
                                        <td scope="col">{{ $item['item']['nombre']}}</td>
                                        <td scope="col">{{ $item['cant'] }}</td>
                                        <td scope="col">{{ '₡ '.$item['valor_ecomonedas'] }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @else

                            <div class="alert alert-warning">No posee cupones agregados a su canje todavía.</div>

                            @endif

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
                                        <th scope="row">Total de Cupones: </th>
                                        <td><strong>{{ $cantidadTotal }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total de Ecomonedas: </th>
                                        <td><strong>{{' ₡'.$ecomonedasTotal}}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            @csrf 
                            @if(Session::get('cart_cupones')==null)
                                    <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg float-right" disabled>Crear Canje<i class="material-icons">beenhere</i></button> 
                            @else
                                    <button type="submit" name="submit" id="submit" class="btn btn-success btn-lg float-right">Crear Canje<i class="material-icons">beenhere</i></button>                            
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!--Final parte de totales del Canje-->

        </form>
        <!--FINAL DEL FORM-->

    </div>
</section>
@endsection