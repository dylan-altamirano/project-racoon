<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark" id="mainNav" style="background-color: #009900;">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{ route('principal.index')}}">Ecolones</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
            aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                {{--Centros de acopio--}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                          Centros de Acopio
                        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item js-scroll-trigger" href="{{ route('centros.index') }}">Ver Centros</a>

                    @auth
                        <a class="dropdown-item js-scroll-trigger" href="{{ route('centros.reporte') }}">Ver Gráfico</a>
                    @endauth
                    </div>
                </li>
                {{--Fin centros de acopio--}}

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('materiales.index') }}">Materiales</a>
                </li>
                @can('admin-all')
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('cupones.index') }}">Cupones</a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('auth.registeradmin') }}">Crear usuarios</a>
               </li>

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('auth.index') }}">Lista clientes</a>
                </li>
                @endcan
               
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contactenos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('otros.acerca')}}">Acerca</a>
                </li>

                @can('admin-center')
                    <!--SHOPPING CART-->
                    <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('canjes.create') }}">
                            <i class="material-icons" aria-hidden="true">shopping_cart</i> Para Canjear 
                            <span class="badge badge-light">{{ Session::has('cart')?Session::get('cart')->cantidadTotal:'' }}</span>
                        </a>
                    </li>
                    <!--FINAL DEL SHOPPING CART-->
                @endcan

                @can('cliente')
                <!--SHOPPING CART-->
                <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="{{ route('billeteravirtual.create') }}">
                        <i class="material-icons" aria-hidden="true">shopping_cart</i> Cupones a canjear 
                        <span class="badge badge-light">{{ Session::has('cart_cupones')?Session::get('cart_cupones')->cantidadTotal:'' }}</span>
                    </a>
                </li>
                <!--FINAL DEL SHOPPING CART-->
                @endcan    

            </ul>



        <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a></li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('auth.resetpassword',['id' => Auth::user()->id]) }}">
                    {{ __('Cambiar contraseña') }}
                </a>
                
                <a href="{{ route('principal.dashboard') }}" class="dropdown-item">Mi Dashboard</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>
                

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              
            </li>

           

        @endguest
        </div>
        </ul>
           


        </div>
    </div>
</nav>

{{--END of Navigation--}}

