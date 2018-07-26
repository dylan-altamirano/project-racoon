<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ecolones - @yield('titulo')</title>

    <!-- Bootstrap core CSS -->
<link href="{{ URL::to('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
<link href="{{ URL::to('css/scrolling-nav.css') }}" rel="stylesheet">

<link href="{{ URL::to('css/album.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    @include('partials.header')

    <section id="about">
        <div class="container">
            @yield('contenido')
        </div>
    </section>

    
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Contactenos</h2>
                    <p class="lead">
                        Puedes escribirnos, llamarnos o incluso venir a nuestras instalaciones ubicadas
                        en centro Eurocenter en Barrial de Heredia, te despejamos todas tus dudas. <br><br>

                        Tel. 2440-33-07 | 2442-76-88 <br>
                        Correo Electrónico: soporte@ecomonedacr.com 
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Dilan Altamirano & Cielo Rodriguez 2018</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
<script src="{{ URL::to('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugin JavaScript -->
<script src="{{ URL::to('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom JavaScript for this theme -->
<script src="{{ URL::to('js/scrolling-nav.js') }}"></script>

</body>

</html>