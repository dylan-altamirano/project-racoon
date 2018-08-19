@extends('layouts.master') 
@section('titulo', 'Actualizar informacion') 
@section('contenido')

@include('partials.errors')

<section id="registrar">

<div class="container">

       @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{Session::get('info')}}</p>
            </div>
        </div>
        @endif
        
<form action="{{ route('auth.update') }}" method="POST" enctype="multipart/form-data">
<div class="row" style="margin-bottom:3%">

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Actualizar usuarios') }}</div>


                    <div class="col-md-12">      

<div class="card">
</br>
    <div class="form-group row">
            <label for="Cliente" class="col-md-4">Consultar Administrador</label>
            <div class="col-md-4">
                    <input type="text" name="emailCliente" id="emailCliente" class="form-control">
            </div>
            <div class="show col-md-3">
                <button type="button" class="btn btn-success buscarAdmin" data-toggle="tooltip" data-placement="top" title="Comprobar nombres" ><i class="material-icons">how_to_reg</i></button>
            </div>
            <div class="col-md-4 float-right"><p class="float-left">Cliente:</p>
              <h4><label id="lblNombreCliente" class="col-md-6 badge badge-light"></label></h4>
              <input type="hidden" name="cliente" id="cliente_id">    <!--Campo Hidden para guardar el id del cliente-->
            </div>
            
        </div>
</div>
</div>


                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.registeradmin') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Direccion') }}</label>

                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ old('direccion') }}" required autofocus>

                                    @if ($errors->has('direccion'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('direccion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" required autofocus>

                                    @if ($errors->has('direccion'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electronico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

                
                </form>
</div>
</section>
@endsection
