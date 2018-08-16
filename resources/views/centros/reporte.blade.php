@extends('layouts.master') 
@section('contenido')

<section id="filtroGrafico">
    <div class="container">
        <div class="row justify-content-md-center">
        
            <div class="col-md-10">
                <h1>Total de ecomonedas por Centro de Acopio</h1>
            </div>
        
            <div class="col-md-10">
                <div class="card">
        
                   <div class="card-body">
                   <form action="{{ route('centros.grafico') }}" method="POST">
                        
                            <div class="form-group">
                                <input type="date" name="fecha_ini" id="fecha_ini" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-success">Filtrar</button>
                        
                        </form>
                   </div>
        
                </div>
            </div>
        
        </div>
    </div>

</section>


<script>
    $(function() {

    $('#fecha_ini').daterangepicker({

        singleDatePicker: true,

        showDropdowns: true,

        minYear: 1901,

        maxYear: parseInt(moment().format('YYYY'),10)

    }, function(start, end, label) {


    });

    });


    $('#fecha_fin').daterangepicker({ 
        singleDatePicker: true, showDropdowns: true, minYear: 1901, maxYear: parseInt(moment().format('YYYY'),10)
    }, function(start, end, label) { }); 
    });

</script>

@endsection