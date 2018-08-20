@extends('layouts.master')
@section('titulo', 'Cupones') 
@section('contenido')

@include('partials.errors')

<section id="create-material">
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                <!--FORMULARIO INICIO-->
            <form action="{{ route('cupones.create') }}" method="POST" enctype="multipart/form-data">

                    <div class="card">
                        <div class="card-body">

                            <!--Nombre-->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                            
                            <!--Descripcion-->
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>

                            <!--Cantidad ecomonedas-->
                            <div class="form-group">
                                <label for="cant_ecomonedas">Cantidad ecomonedas</label>
                                <input type="text" class="form-control" id="cant_ecomonedas" name="cant_ecomonedas">
                            </div>

                            <!--Activo-->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activo" name="activo">
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>

                             <div class="form-group">
                                <label>Imagen</label>
                                <input type="file"
                                name="imagenCupon"
                                accept="image/*"
                                class="form-control-file" />
                            </div>
                            

                            @csrf
                            <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="{{ route('cupones.index') }}" class="btn btn-success"> Cancelar</a>
                        </div>
                    </div>

                </form>
                <!--FORMULARIO FIN-->

            </div>
        </div>
    </div>
</section>

@endsection