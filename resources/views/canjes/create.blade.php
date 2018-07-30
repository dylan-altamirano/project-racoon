@extends('layouts.master') 
@section('titulo', 'Canjes') 
@section('contenido')

<section id="Canjes">
    <div class="container">

        <div class="row" style="margin-bottom:3%">
                <!--INICIO ENCABEZADO CANJE-->
                <div class="col-md-12">

                    <!--FORM CHECKOUT CANJE-->
                    <form action="#" method="POST">        

                    <div class="card">
                        <div class="card-header"><h5>Detalles del Canje</h5></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fecha"><h6>Fecha</h6></label> <span class="badge badge-pill badge-light">{{ date('d/M/y h:i:sa') }}</span>
                            </div>
            
                            <div class="form-group">
                                <label for="centro_acopios">Centro de Acopio</label>
                                <select class="form-control" name="centro_acopios" id="centro_acopios">
                                                <option value="#">option1</option>
                                                <option value="#">option2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--FIN ENCABEZADO CANJE-->
        </div>

        <div class="row">

                <!--INICIO DETALLES DEL CANJE-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title float-left">Materiales a Canjear</h5>   
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nº</th>
                                        <th scope="col">Material</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <th scope="row">1</th>
                                    <td>Material 1</td>
                                    <td>0</td>
                                    <td>100.00</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--FIN DETALLES DEL CANJE-->
            </form>
            <!--FINAL DEL FORM-->

        </div>
        <!--Final Row-->

        <div class="row" style="margin-top:3%">
            <div class="col-md-12">
                <div class="card">
                    <div class="body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Total de Materiales: </th>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th scope="row">Total de Ecomonedas: </th>
                                    <td>0.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection