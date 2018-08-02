@extends('layouts.master')
@section('titulo', 'Centros de Acopio') 
@section('contenido')

@include('partials.errors')

<section id="create-centros">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

            <form action="{{ route('centros.update') }}" method="POST" enctype="multipart/form-data">
               <!--Nombre-->
               <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $centros->nombre }}">
                            </div>
      

                            <!--Activo-->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activo" name="activo" {{ ($centros->activo)?"checked":"" }}>
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>
@csrf

                            <input type="hidden" id="id" name="id" value="{{ $centros->id }}">
                            <input type="hidden" id="direccion_exacta" name="direccion_exacta" value="{{ $centros->direccion_exacta }}">
                            <input type="hidden" id="provincia" name="provincia" value="{{ $centros->provincia }}">
                            <input type="hidden" id="user_id" name="user_id" value="{{ $centros->user_id }}">
     

                            <button type="submit" class="btn btn-primary">Editar</button>
                            <a href="{{ route('centros.index') }}" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>

                </form>
                <!--FORMULARIO FIN-->

            </div>

        </div>
    </div>
</section>
@endsection