@component('mail::message')
# Sus cupones han sido canjeados.

A continuación se le presenta un resumen de su canje:

@component('mail::panel')
Canje Nº **{{ $canjeCupon->id }}**
@endcomponent

@component('mail::table') 
| Fecha                    | Cliente             | Correo                | 
| ------------------------ |:-------------------:| ---------------------:| 
| {{ $canjeCupon->fecha }} |{{ $cliente->name }} | {{ $cliente->email }} | 
@endcomponent

@component('mail::panel')
Detalle del Canje
@endcomponent

@if($cupones !=null)

@component('mail::table') 
| Cupon                        | Cantidad           | Valor Ecomonedas                     | 
| ---------------------------- |:------------------:| ------------------------------------:| 
@foreach($cupones as $item)
| {{ $item['item']['nombre']}} |{{ $item['cant'] }} | {{ '₡ '.$item['valor_ecomonedas'] }} | 
@endforeach
@endcomponent

@endif

@component('mail::panel')
Total de Cupones: **{{ $cantidadTotal }}**
<br>
Total de Ecomonedas: **{{' ₡'.$ecomonedasTotal}}**
@endcomponent

<br>

Gracias,<br>
{{ config('app.name') }}
@endcomponent
