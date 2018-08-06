@extends('layouts.master') 
@section('titulo', 'Actualizar informacion') 
@section('contenido')

@include('partials.errors')

<section id="registrar">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Actualizar informacion') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth.update') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

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
                                <input id="direccion" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ $user->direccion }}" required autofocus>

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
                                <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ $user->telefono }}" required autofocus>

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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @foreach ($roles as $id => $role)
                        @if($role == "Cliente")
                            <input type="hidden" value="{{$id}}" id="role" name="role">
                        @endif
                        @endforeach
                        
                        
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

</section>
@endsection
