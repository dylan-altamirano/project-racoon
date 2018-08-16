@extends('layouts.master') 
@section('titulo', 'Billetera Virtual') 
@section('contenido')

<section id="BilleteraVirtual">

    <div class="container" style="margin-bottom:3%">
    
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
                    <div class="card-body">
                        <h3>Balance Actual Ecomonedas <span class="badge badge-success"><strong>₡ {{ $cliente->balance_ecomonedas }}</strong></span></h3>
                    </div>            
                </div>
            </div>
        </div>
    </div>



    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title float-left">Historial de Canjes</h5>
                    <a href="{{ route('cupones.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="top"
                            title="Canjear un cupón"><i class="material-icons">shop</i></a>
                    </div>
                    <div class="card-body">

                        @if(count($canjes) > 0)

                            <!--Tabla canjes-->
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
                                    @foreach($canjes as $canje)
                                    <tr>
                                        <th scope="row">{{ $canje->id }}</th>
                                        <td>{{ $canje->centrosacopio->nombre}}</td>
                                        <td>{{ $canje->fecha }}</td>
                                        <td><a href="{{ route('canjes.show', ['id'=>$canje->id]) }}" class="btn btn-success" data-toggle="tooltip" data-placement="right"
                                                title="Ver detalles del canje"><i class="material-icons">visibility</i></a></td>
                                    </tr>
                                    @endforeach
                            
                                </tbody>
                            </table>
                            <!--Final tabla canjes-->

                        @else

                            <div class="alert alert-info">
                            <p>No hay canjes registrados para <strong>{{ $cliente->name }}</strong></p>
                            </div>

                        @endif
                         
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection