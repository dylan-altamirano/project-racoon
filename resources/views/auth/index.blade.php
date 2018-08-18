@extends('layouts.master') 
@section('titulo', 'Lista Clientes') 
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
                <a href="{{ route('auth.registeradmin') }}" class="btn btn-primary">Crear nuevo</a>
            </div>
        @endcan
            <div class="container">
        
                <div class="row">

                @if($users != null)
                    
                    @foreach($users as $user)
                    @foreach($roles as $rol)
                    @if($user->roles->contains($rol->id) && $rol->id == 3)
                            
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-title">
                                <h2>{{ $user->name }}</h2>
                                
                                </div>
                                <div class="card-body">
                                <h3>{{ $user->email }}</h3>
                                
                                </div>
                                <div class="card-footer text-muted">
                                    <small class="text-muted">Actualizado a las: {{ date_format($user->updated_at, 'g:ia \o\n l jS F Y') }}</small>
                                </div>
                            </div>
                        </div>
                    
                        
                        @endif  
                    @endforeach
                    
                    @endforeach
                @endif   
                </div>
    
    </section>
    <!--FINAL MOSTRAR CENTROS-->
@endsection