@extends('layouts.master') 
@section('titulo', 'Materiales reciclables') 
@section('contenido')

@include('partials.errors')

<section id="create-material">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <!--FORMULARIO INICIO-->
                <form action="{{ route('materiales.update') }}" method="POST" enctype="multipart/form-data">

                    <div class="card">
                        <div class="card-body">

                            <!--Nombre-->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $material->nombre }}">
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3">
                                    {{ $material->descripcion }}
                                </textarea>
                            </div>

                            <!--Precio-->
                            <div class="form-group">
                                <label for="precio">Precio unitario</label>
                            <input type="text" class="form-control" id="precio" name="precio" value="{{ $material->precio_unitario }}">
                            </div>

                            <!--Color-->
                            <div class="form-group">
                                <label for="color">Color</label>
                            <input type="text" class="form-control" id="color" name="color" value="{{ $material->color }}">
                            </div>

                            <!--Activo-->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activo" name="activo" {{ ($material->activo)?"checked":"" }} >
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>

                            <!--Imagen-->
                            <div class="form-group">
                                <label for="datafile">Seleccione una imagen</label>
                                <input type="file" class="form-control-file" name="datafile" id="datafile" size="40">
                            </div>
                            @csrf

                            <input type="hidden" id="id" name="id" value="{{ $material->id }}">

                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('materiales.index') }}" class="btn btn-primary"> Cancelar</a>
                        </div>
                    </div>

                </form>
                <!--FORMULARIO FIN-->

            </div>

            <div class="col-md-6">
                <div class="card bg-dark text-white">
                    <img src="{{ URL::to('storage/imagenes/'.$material->imagen) }}" class="card-img img-fluid img-thumbnail" alt="Card image">
                    <div class="card-footer">
                       Archivo imagen: {{ $material->imagen }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection