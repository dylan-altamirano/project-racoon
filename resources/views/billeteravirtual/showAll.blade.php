@extends('layouts.master') 
@section('titulo', 'Historial Cupones') 
@section('contenido')

<section id="historialCupones">

    <div class="container" style="margin-bottom:3%">

        @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{Session::get('info')}}</p>
            </div>
        </div>
        @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title float-left">Historial de Cupones</h5>
                    </div>
                    <div class="card-body">

                        @if(count($cupones) > 0)

                        <!--Tabla canjes-->
                        <table class="table table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nº</th>
                                    <th scope="col">Cupon</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cupones as $cupon)
                                <tr>
                                    <th scope="row">{{ $cupon->id }}</th>
                                    <td>{{ $cupon->nombre}}</td>
                                    <td>{{ $cupon->descripcion }}</td>
                                    <td>{{ $cupon->pivot->cantidad }}</td>
                                    <td>
                                        <a href="{{ route('billeteravirtual.reportePDF',['id'=>$cupon->id,'cant'=>$cupon->pivot->cantidad]) }}" class="btn btn-success" data-toggle="tooltip"
                                                data-placement="right" title="Descargar cupon"><i class="material-icons">get_app</i>
                                        </a>
                                    </td>
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