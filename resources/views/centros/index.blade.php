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
       <!-- <div class="container text-center"><img src="storage/imagenes/centros.PNG" alt="boat" style="width:100%;height:349px;width:500px;"></div>-->
        @can('admin-all')
            <div class="container" style="margin-bottom:5px">
                <a href="{{ route('centros.create') }}" class="btn btn-primary">Crear nuevo</a>
            </div>
        @endcan
            <div class="container">
        
                <div class="row">

                @if($centros != null)
                  
                    @foreach($centros as $centro)

                   {{-- @can('cliente')

                    @if($centro->activo == 1)
                   
                    <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-title">
                                <h2>{{ $centro->provincia }}</h2>
                                
                                </div>
                                <div class="card-body">
                                <h3>{{ $centro->nombre }}</h3>
                                    <p class="card-text">{{ $centro->direccion_exacta }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                    @can('admin-all')
                                    <div class="btn-group">
                                       <a href="{{ route('centros.edit',['id'=> $centro->id]) }}" class="btn btn-outline-info">Editar</a>
                                    </div>

                                    <div class="btn-group">
                                    <a href="{{ route('centros.habilitar',['id'=> $centro->id]) }}" class="btn btn-outline-danger">{{ ($centro->activo)?"Deshabilitar":"Habilitar" }}</a>

                                     </div>
                                     @endcan
                                    
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <small class="text-muted">Actualizado a las: {{ date_format($centro->updated_at, 'g:ia \o\n l jS F Y') }}</small>
                                </div>
                            </div>
                        </div>
                       
                    @endif
                    @endcan

                    --}}

                    @if($centro->activo == 1)
                   
                    <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ $centro->provincia }}</h2>
                                    
                                    </div>
                                </div>
                                <div class="card-body">
                                <h3>{{ $centro->nombre }}</h3>
                                    <p class="card-text">{{ $centro->direccion_exacta }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                    @can('admin-all')
                                    <div class="btn-group">
                                       <a href="{{ route('centros.edit',['id'=> $centro->id]) }}" class="btn btn-outline-info">Editar</a>
                                    </div>

                                    <div class="btn-group">
                                    <a href="{{ route('centros.habilitar',['id'=> $centro->id]) }}" class="btn btn-outline-danger">{{ ($centro->activo)?"Deshabilitar":"Habilitar" }}</a>

                                     </div>
                                     @endcan
                                    
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                <small class="text-muted">Contacto del Centro: {{ $centro->user->name}}</small>
                                </div>
                            </div>
                        </div>
                    @endif   
                    
                    @can('admin-all')
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{ $centro->provincia }}</h2>
                                    
                                    </div>
                                </div>
                                <div class="card-body">
                                <h3>{{ $centro->nombre }}</h3>
                                    <p class="card-text">{{ $centro->direccion_exacta }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                  
                                    <div class="btn-group">
                                       <a href="{{ route('centros.edit',['id'=> $centro->id]) }}" class="btn btn-outline-info">Editar</a>
                                    </div>

                                    <div class="btn-group">
                                    <a href="{{ route('centros.habilitar',['id'=> $centro->id]) }}" class="btn btn-outline-danger">{{ ($centro->activo)?"Deshabilitar":"Habilitar" }}</a>

                                     </div>
                             
                                    
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <small class="text-muted">Actualizado a las: {{ date_format($centro->updated_at, 'g:ia \o\n l jS F Y') }}</small>
                                </div>
                            </div>
                        </div>
                        @endcan
                    
                        
                        
                    @endforeach
                @endif   
                </div>
    <div class="col-md-12 text-center">
        {{$centros->links()}}
    </div>
            </div>
            
        </div>
    </section>
    <!--FINAL MOSTRAR CENTROS-->
@endsection