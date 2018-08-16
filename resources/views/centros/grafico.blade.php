@extends('layouts.master') 
@section('contenido')

<section id="grafico">
    <div class="row justify-content-md-center">
    
        <div class="col-md-10">
            <h1>Total de ecomonedas por Centro de Acopio</h1>
        </div>
    
        <div class="col-md-10">
           <div class="card">
               <div class="card-body">
                   <div>
                        <!--Contenedor grafico-->
                        {!! $chart->container() !!}
                    </div>
               </div>
           </div>
        </div>
    
    </div>
</section>

<script type="text/javascript" src="{{ URL::to('js/Chart.min.js') }}"></script>
{!! $chart->script() !!}
@endsection