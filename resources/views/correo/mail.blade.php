<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Notificacion de Canje</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>

        body{
            font-family: Arial, Helvetica, sans-serif;
        }

        table{
            width: 100%;    
        }

        table, th{
            border:1px solid black;
            padding: 15px; 
            text-align: left;
        }

        th{
            background-color: #4CAF50; 
            color: white;
        }
        
        td{
            height: 50px;
            vertical-align: bottom;
            border: 1px solid black;
            padding: 15px; 
            text-align: left;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .center-div{ 
            margin: 0 auto; 
            width: 100px; 
        } 
        
        #outer{ 
            text-align: left; 
            padding: 30px; 
        }
    
    </style>

</head>
<body>
     
  <div id="outer" class="center-div">
    
        <div style="margin-bottom:3%; margin-bottom:3%; padding:15px;">
            <!--INICIO ENCABEZADO CANJE-->
    
                <table>
                    <tr>
                        <th colspan="4">
                            <h5>Detalles del Canje</h5>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4"><label><h6>Fecha</h6></label> <strong>{{ $canje->fecha }}</strong></td>
                        <!--Campo Hidden para guardar la fecha-->
                    </tr> 
    
                        <tr>
                            <td colspan="2"><label for="centro_acopios">Centro de Acopio</label></td>
                            <td colspan="2">
                                <h5><strong>{{ $centro_acopio->nombre }}</strong></h5>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><label>Cliente Registrado: </label></td>
                            <td colspan="2">
                                <h4><strong id="lblNombreCliente">{{ $cliente->name }}</strong></h4>
                            </td>
    
                        </tr>
                    </table>

            <!--FIN ENCABEZADO CANJE-->
        </div> <!--Fin ROW-->
    
    
            <!--INICIO DETALLES DEL CANJE-->
            <div style="margin-top:3%; margin-bottom:3%; padding:15px;">
                    <div>
                        <h5>Materiales a Canjear</h5>
                    </div>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Nº</th>
                                    <th scope="col">Material</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($materiales as $item)
                                <tr>
                                    <th scope="col">{{ $item['item']['id']}}</th>
                                    <td scope="col">{{ $item['item']['nombre']}}</td>
                                    <td scope="col">{{ $item['cant'] }}</td>
                                    <td scope="col">{{ '₡ '.$item['precio'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
    
        <!--Parte de Totales del Canje-->
        <div style="margin-top:3% padding:15px">
                        <table>
                            <tbody>
                                <tr>
                                    <th scope="row">Total de Materiales: </th>
                                    <td><strong>{{ $cantidadTotal }}</strong></td>
                                </tr>
                                <tr>
                                    <th scope="row">Total de Ecomonedas: </th>
                                    <td><strong>{{' ₡'.$precioTotal}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
        </div>
        <div>
            <p>Este canje fue registrado por: <strong>{{ $centro_acopio->user->name }}</strong></p>
         </div>
</div>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
</body>
</html>