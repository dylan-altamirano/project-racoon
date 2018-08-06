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

<link href="{{ URL::to('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
<link href="{{ URL::to('css/scrolling-nav.css') }}" rel="stylesheet">

<link href="{{ URL::to('css/album.css') }}" rel="stylesheet">

<link href="{{ URL::to('css/local.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    @include('partials.header')


    @yield('contenido')


    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Dilan Altamirano & Cielo Rodriguez 2018</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
<script src="{{ URL::to('js/jquery-3.3.1.js') }}"></script>

<script src="{{ URL::to('vendor/bootstrap/js/popper.min.js') }}"></script>

<script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ URL::to('vendor/bootstrap/js/holder.min.js') }}"></script>

    <!-- Plugin JavaScript -->
<script src="{{ URL::to('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom JavaScript for this theme -->
<script src="{{ URL::to('js/scrolling-nav.js') }}"></script>
<script src="{{ URL::to('js/custom-script.js') }}"></script>


<script>
    //initialize all tooltips on a page would be to select them by their data-toggle attribute
    $(function () { $('[data-toggle="tooltip"]').tooltip() });
</script>

</body>

</html>