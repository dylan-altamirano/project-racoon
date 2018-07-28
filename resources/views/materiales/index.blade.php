@extends('layouts.master') 
@section('titulo', 'Materiales reciclables') 
@section('contenido')

<!--
    <!BIENVENIDA DE LA PÁGINA MATERIALES>
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Materiales Reciclables</h1>
            <p class="lead text-muted">En esta sección podrás encontrar una lista de posibles materiales que se reciben nuestros centros
                de acopio, para posteriormente ser canjeados por ecomonedas. Entonces, ¿Qué esperas? te estamos esperando 
            </p>
            <p>
                <a href="#" class="btn btn-primary my-2">Entrá con tu cuenta</a>
            </p>
        </div>
    </section>
    <!FINAL> -->

    @if (Session::has('info'))
        <div class="row">
        
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif

    <!--MOSTRAR MATERIALES-->
    <section id="materiales">
        <div class="album py-5 bg-light">
            <div class="container" style="margin-bottom:5px">
                <a href="{{ route('materiales.create') }}" class="btn btn-primary">Crear nuevo</a>
            </div>

            <div class="container">
        
                <div class="row">

                @if($materiales != null)
                    
                    @foreach($materiales as $material)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img class="card-img-top" src="{{ URL::to('pictures/image-placeholder.jpg') }}" alt="Card image cap">
                                <div class="card-title">
                                <h3>{{ $material->nombre }}</h3>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $material->descripcion }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Editar</button>
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <small class="text-muted">Actualizado a las: {{ date_format($material->updated_at, 'g:ia \o\n l jS F Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                
                @endif   
                </div>
            </div>
        </div>
    </section>
    <!--FINAL MOSTRAR MATERIALES-->

@endsection