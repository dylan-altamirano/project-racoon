@extends('layouts.master') 
@section('titulo', 'Cupones') 
@section('contenido')

@include('partials.errors')

<section id="create-material">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <!--FORMULARIO INICIO-->
                <form action="{{ route('cupones.update') }}" method="POST" enctype="multipart/form-data">

                    <div class="card">
                        <div class="card-body">

                            <!--Nombre-->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cupones->nombre }}">
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">
                                    {{ $cupones->descripcion }}
                                </textarea>
                            </div>

                            <!--Precio-->
                            <div class="form-group">
                                <label for="cant_ecomonedas">Cant ecomonedas</label>
                            <input type="text" class="form-control" id="cant_ecomonedas" name="cant_ecomonedas" value="{{ $cupones->cant_ecomonedas }}">
                            </div>

                            <!--Activo-->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activo" name="activo" {{ ($cupones->activo)?"checked":"" }} >
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>

                            @csrf

                            <input type="hidden" id="id" name="id" value="{{ $cupones->id }}">

                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('cupones.index') }}" class="btn btn-primary"> Cancelar</a>
                        </div>
                    </div>

                </form>
                <!--FORMULARIO FIN-->

            </div>
        </div>
    </div>
</section>
@endsection