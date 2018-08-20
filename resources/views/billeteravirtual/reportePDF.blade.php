<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        body {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            position: relative;
            width: 19cm;
            height: 27cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-size: 14px;
        }

        h1 {
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            margin: 0 0 2em 0;
            width: 100%;
        }

        h1 small {
            font-size: 0.45em;
            line-height: 1.5em;
            float: left;
        }

        h1 small:last-child {
            float: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 30px;
        }

        table th,
        table td {
            text-align: left;
            vertical-align: top;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            font-weight: normal;
        }

        table th img,
        table td image {
            padding: 1px;
            width: 150px;
            height: 150px;
        }

        table td {
            padding: 10px;
            text-align: left;
        }

        table tr:nth-child(2n-1) td {
            background: #EEEEEE;
        }

        table tr:last-child td {
            background: #DDDDDD;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <main>
        <h1 class="clearfix">
            <small>
          <span>Fecha</span><br />
          {{date('d-m-Y')}}
        </small> Cupones registrados de {{ Auth::user()->name }}
        </h1>
        
        @for($i =0; $i< $cant; $i++)
        <table class="table table-bordered">
            <thead>
                <thead>
                    <tr>
                        <th>{{$cupon->nombre}}</th>
                       <th>
                            <img src="{{ public_path().'/storage/'.$cupon->imagen}}" alt="{{$cupon->nombre}}" />
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <b>Descripción</b>
                        </td>
                        <td>
                            {{$cupon->descripcion}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Valor ecomonedas</b>
                        </td>
                        <td>
                            {{$cupon->cant_ecomonedas}}
                        </td>
                    </tr>
                    
                </tbody>
        </table>
        @endfor
    </main>
    <footer>
        Ecodivisa Costa Rica 2018 - Todos los derechos reservados
    </footer>
</body>

</html>