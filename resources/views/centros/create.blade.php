<!--@extends('layouts.master') -->
@section('titulo', 'Centros de acopio') 
@section('contenido')

@include('partials.errors')

<section id="create-centro_acopios">
    <div class="container">
        <div class="row">
            <div class="col-md-10">

                <!--FORMULARIO INICIO-->
            <form action="{{ route('centros.create') }}" method="POST" enctype="multipart/form-data">

                    <div class="card">
                        <div class="card-body">

                            <!--Nombre-->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                             <!--Direccion-->
                            <div class="form-group">
                                <label for="direccion_exacta">Dirección exacta</label>
                                <textarea class="form-control" id="direccion_exacta" name="direccion_exacta" rows="3"></textarea>
                            </div>

                            <!--Provincia-->
                            <div class="form-group">
                                 <label for="provincia">Provincia</label>
                               
                                 <select id="provincia" class="form-control" name="provincia">
                                       
                                          <option value="San José">San José</option>
                                          <option value="Alajuela">Alajuela</option>
                                          <option value="Heredia">Heredia</option>
                                          <option value="Cartago">Cartago</option>
                                          <option value="Puntarenas">Puntarenas</option>
                                          <option value="Limón">Limón</option>
                                          <option value="Guanacaste">Guanacaste</option>
                                            
                                 </select>
                                     @if ($errors->has('provincia'))
                                       <span class="invalid-feedback">
                                       <strong>{{ $errors->first('provincia') }}</strong>
                                       </span>
                                    @endif
                             

                        </div>

                           


                            <div class="form-group">
                            <label for="role">Encargado</label>
                                
                            <select id="role" class="form-control" name="role">
                             @foreach($users as $user)
                                @foreach($roles as $rol)
                                    @if($user->roles->contains($rol->id) && $rol->id == 2)
                                        <option value="{{$user->id}}">{{$user->email}}</option>
                                    @endif
                                @endforeach
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <span class="invalid-feedback">
                                     <strong>{{ $errors->first('role') }}</strong>
                                </span>
                            @endif
                           
                            </div>


                             <!--Activo-->
                             <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activo" name="activo">
                                <label class="form-check-label" for="activo">Activo</label>
                            </div>

                            @csrf
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('centros.index') }}" class="btn btn-primary"> Cancelar</a>
                        </div>
                    </div>

                </form>
                <!--FORMULARIO FIN-->

            </div>
        </div>
    </div>
</section>

@endsection