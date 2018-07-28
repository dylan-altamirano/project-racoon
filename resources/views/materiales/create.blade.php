@extends('layouts.master') 
@section('titulo', 'Materiales reciclables') 
@section('contenido')

<section id="create-material">
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                <!--FORMULARIO INICIO-->
                <form action="">

                    <div class="card">
                        <div class="card-body">

                            <!--Nombre-->
                            <div class="form-group">
                                <label for="txtNombre">Nombre</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre">
                            </div>

                            <div class="form-group">
                                <label for="txaDescripcion">Descripcion</label>
                                <textarea class="form-control" id="txaDescripcion" name="txaDescripcion" rows="3"></textarea>
                            </div>

                            <!--Precio-->
                            <div class="form-group">
                                <label for="txtPrecio">Precio unitario</label>
                                <input type="text" class="form-control" id="txtPrecio" name="txtPrecio">
                            </div>

                            <!--Color-->
                            <div class="form-group">
                                <label for="txtColor">Color</label>
                                <input type="text" class="form-control" id="txtColor" name="txtColor">
                            </div>

                            <!--Activo-->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activo">
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
        </div>
    </div>
</section>

@endsection