@extends('layouts.master') 
@section('titulo', 'Centros de acopio') 
@section('contenido')

@if (Session::has('info'))
    <div class="row">
    
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif


    <!--MOSTRAR Centros-->
    <section id="centros">
        <div class="album py-5 bg-light">
            <div class="container" style="margin-bottom:5px">
                <a href="{{ route('centros.create') }}" class="btn btn-primary">Crear nuevo</a>
            </div>

            <div class="container">
        
                <div class="row">

                @if($centros != null)
                    
                    @foreach($centros as $centro)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-title">
                                <h3>{{ $centro->nombre }}</h3>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $centro->provincia }}
                                    </p>
                                    <p class="card-text">{{ $centro->direccion_exacta }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                       
                                    <div class="btn-group">
                                       <a href="{{ route('centros.edit',['id'=> $centro->id]) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                    </div>

                                    <div class="btn-group">
                                    <a href="{{ route('centros.habilitar',['id'=> $centro->id]) }}" class="btn btn-sm btn-outline-secondary">{{ ($centro->activo)?"Deshabilitar":"Habilitar" }}</a>

                                     </div>

                                    
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <small class="text-muted">Actualizado a las: {{ date_format($centro->updated_at, 'g:ia \o\n l jS F Y') }}</small>
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