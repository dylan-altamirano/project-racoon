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
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>

                            <!--Precio-->
                            <div class="form-group">
                                <label for="precio">Precio unitario</label>
                                <input type="text" class="form-control" id="precio" name="precio">
                            </div>

                            <!--Color-->
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" class="form-control" id="color" name="color">
                            </div>

                            <!--Activo-->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activo" name="activo">
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>

                            <!--Imagen-->
                            <div class="form-group">
                                <label for="datafile">Seleccione una imagen</label>
                                <input type="file" class="form-control-file" name="datafile" id="datafile" size="40">
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('materiales.index') }}" class="btn btn-primary"> Cancelar</a>
                        </div>
                    </div>

                </form>
                <!--FORMULARIO FIN-->

            </div>

            <div class="col-md-6">
                
            </div>

        </div>
    </div>
</section>
@endsection