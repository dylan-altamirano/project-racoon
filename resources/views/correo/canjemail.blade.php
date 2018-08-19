@component('mail::message')
# Sus materiales han sido canjeados.

A continuación se le presenta un resumen de su canje:

@component('mail::panel')
Canje Nº **{{ $canje->id }}**
@endcomponent

@component('mail::table') 
| Fecha                    | Cliente             | Centro de Acopio             | 
| ------------------------ |:-------------------:| ----------------------------:| 
| {{ $canje->fecha }}      |{{ $cliente->name }} | {{ $centro_acopio->nombre }} | 
@endcomponent

@component('mail::panel')
Detalle del Canje
@endcomponent

@if($materiales !=null)

@component('mail::table') 
| Material                     | Cantidad           | Precio                     | 
| ---------------------------- |:------------------:| --------------------------:| 
@foreach($materiales as $item)
| {{ $item['item']['nombre']}} |{{ $item['cant'] }} | {{ '₡ '.$item['precio'] }} | 
@endforeach
@endcomponent

@endif

@component('mail::panel')
Total de Materiales: **{{ $cantidadTotal }}**
<br>
Total de Ecomonedas: **{{' ₡'.$precioTotal}}**
@endcomponent

<br>

@component('mail::footer')

Este canje fue registrado por **{{ $centro_acopio->user->name }}**

@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent


