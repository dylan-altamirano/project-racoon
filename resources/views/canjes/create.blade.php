@extends('layouts.master') 
@section('titulo', 'Canjes') 
@section('contenido')

@include('partials.errors')
<section id="Canjes">
    <div class="container">

     <!--FORM CHECKOUT CANJE-->
    <form action="{{ route('canjes.create') }}" method="POST" enctype="multipart/form-data">

        <div class="row" style="margin-bottom:3%">
                <!--INICIO ENCABEZADO CANJE-->
                <div class="col-md-12">      

                    <div class="card">
                        <div class="card-header"><h5>Detalles del Canje</h5></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fecha"><h6>Fecha</h6></label> <span class="badge badge-pill badge-light">{{ date('d/M/y h:i:sa') }}</span>
                                <input type="hidden" name="fecha" id="fecha" value="{{ date('Y-m-d H:i:s') }}"> <!--Campo Hidden para guardar la fecha-->
                            </div>
            
                            <div class="form-group row">
                                <label for="centro_acopios" class="col-md-2">Centro de Acopio</label>
                                <div class="col-md-4">
                                <input type="hidden" name="centro_acopio_id" id="centro_acopio_id" value="{{ $centro_acopio->id }}"> <!--Campo Hidden para guardar el id del centro de acopio-->
                                    <h5><span class="badge badge-light">{{ $centro_acopio->nombre }}</span></h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Cliente" class="col-md-2">Consulta Cliente</label>
                                <div class="col-md-3">
                                        <input type="text" name="emailCliente" id="emailCliente" class="form-control">
                                </div>
                                <div class="show col-md-3">
                                    <button type="button" class="btn btn-success buscarCliente" data-toggle="tooltip" data-placement="top" title="Comprobar nombres" ><i class="material-icons">how_to_reg</i></button>
                                </div>
                                <div class="col-md-4 float-right"><p class="float-left">Cliente:</p>
                                  <h4><label id="lblNombreCliente" class="col-md-6 badge badge-light"></label></h4>
                                  <input type="hidden" name="cliente" id="cliente_id">    <!--Campo Hidden para guardar el id del cliente-->
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
                         @if($productos !=null)   
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nº</th>
                                        <th scope="col">Material</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                  @foreach($productos as $item)
                                        <tr>
                                            <th scope="col">{{ $item['item']['id']}}</th>
                                            <td scope="col">{{ $item['item']['nombre']}}</td>
                                            <td scope="col">{{ $item['cant'] }}</td>
                                            <td scope="col">{{ '₡ '.$item['precio'] }}</td>
                                            <td scope="col">
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDropAcciones" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                          Acción
                                                        </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDropAcciones">
                                                        <a class="dropdown-item" href="{{ route('canjes.reducirCant',['id'=>$item['item']['id'] ]) }}">Eliminar uno</a>
                                                        <a class="dropdown-item" href="{{ route('canjes.eliminarMaterial',['id'=>$item['item']['id']]) }}">Eliminar todos</a>   
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                  @endforeach

                                  </tbody>
                                </table>
                            @else
                                
                                <div class="alert alert-warning">No posee materiales agregados a su canje todavía.</div>  
                                        
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
                        @csrf

                        @if(Session::get('cart')==null)
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