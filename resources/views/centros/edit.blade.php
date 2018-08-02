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
                             <!--Direccion-->
                            <div class="form-group">
                                <label for="direccion_exacta">Dirección exacta</label>
                                <textarea class="form-control" id="direccion_exacta" name="direccion_exacta" rows="3">{{ $centros->direccion_exacta }}</textarea>
                            </div>

                            <!--Provincia-->
                            <div class="form-group">
                                 <label for="provincia">Provincia</label>
                               
                                 <select id="provincia" class="form-control" name="provincia">
                                       
                                          <option value="San José" {{ ($centros->provincia == "San José")?"selected":"" }}>San José</option>
                                          <option value="Alajuela" {{ ($centros->provincia == "Alajuela")?"selected":"" }}>Alajuela</option>
                                          <option value="Heredia" {{ ($centros->provincia == "Heredia")?"selected":"" }}>Heredia</option>
                                          <option value="Cartago" {{ ($centros->provincia == "Cartago")?"selected":"" }}>Cartago</option>
                                          <option value="Puntarenas" {{ ($centros->provincia == "Puntarenas")?"selected":"" }}>Puntarenas</option>
                                          <option value="Limón" {{ ($centros->provincia == "Limón")?"selected":"" }}>Limón</option>
                                          <option value="Guanacaste" {{ ($centros->provincia == "Guanacaste")?"selected":"" }}>Guanacaste</option>
                                            
                                 </select>
                                     @if ($errors->has('provincia'))
                                       <span class="invalid-feedback">
                                       <strong>{{ $errors->first('provincia') }}</strong>
                                       </span>
                                    @endif
                             

                        </div>

                            <!--Activo-->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activo" name="activo" {{ ($centros->activo)?"checked":"" }}>
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>
@csrf

                            <input type="hidden" id="id" name="id" value="{{ $centros->id }}">

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