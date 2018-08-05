@extends('layouts.master') 
@section('titulo', 'Cupones') 
@section('contenido')

@if (Session::has('info'))
    <div class="row">
    
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif


    <!--MOSTRAR Cupones-->
    <section id="cupones">
        <div class="album py-5 bg-light">
            <div class="container" style="margin-bottom:5px">
                <a href="{{ route('cupones.create') }}" class="btn btn-primary">Crear nuevo</a>
            </div>

            <div class="container">
        
                <div class="row">

                @if($cupones != null)
                    
                    @foreach($cupones as $cupon)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-title">
                                <h3>{{ $cupon->nombre }}</h3>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $cupon->descripcion }}
                                    </p>
                                    <p class="card-text">{{ $cupon->cant_monedas }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                       
                                    <div class="btn-group">
                                       <a href="{{ route('cupones.edit',['id'=> $cupon->id]) }}" class="btn btn-outline-info">Editar</a>
                                    </div>

                                    
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <small class="text-muted">Actualizado a las: {{ date_format($cupon->updated_at, 'g:ia \o\n l jS F Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                
                @endif   
                </div>
            </div>
        </div>
    </section>
    <!--FINAL MOSTRAR CENTROS-->

@endsection