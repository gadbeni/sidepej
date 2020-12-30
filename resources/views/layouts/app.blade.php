<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','SIDEPEJ | GADBENI')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('theme/plugins/fontawesome-free/css/all.min.css')}}">
    @stack('styles')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('theme/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
               
                    <img src="{{asset('theme/dist/img/logo.jpg')}}" class="img-circle elevation-3"
             style="width: 50px; height: 50px">
        <span class="brand-text font-weight-light">iDePeJ!</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- == -->
                        @can('users.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">Usuarios</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('roles.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('roles.index')}}">Roles</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('sucursales.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('sucursales.index')}}">Sucursales</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('sucursal_usuario.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('sucursal_usuario.index')}}">Asignación Sucursales</a>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('dropdown.justicia')
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Sec. Dptal. De Justicia</a>
                            <ul class="dropdown-menu border-0 shadow">
                                <!-- === -->
                                @can('reservajusticia.index')
                                <li class="nav-item"><a href="{{route('reservajusticia.index')}}" class="nav-link dropdown-item">Reserva de Nombre</a></li>
                                @endcan
                                <!-- === -->
                                @can('personeriajusticia.index')
                                <li class="nav-item"><a href="{{route('personeriajusticia.index')}}" class="nav-link dropdown-item">Personerías Jurídicas</a></li>
                                @endcan
                                <!-- === -->
                                <li class="dropdown-divider"></li>
                                @can('report.personeria_secretariajusticia')
                                <li class="nav-item"><a href="{{route('pjsecretariajusticia')}}" class="nav-link dropdown-item">Reporte por Fechas Personerías Juridicas</a></li>
                                @endcan
                                <!-- === -->
                                @can('report.reservanombre_secretariajusticia')
                                <li class="nav-item"><a href="{{route('rnsecretariajusticia')}}" class="nav-link dropdown-item">Reporte por Fechas Reservas de Nombre</a></li>
                                @endcan
                                <!-- === -->
                                @can('report.objeto_secretariajusticia')
                                <li class="nav-item"><a href="{{route('secretariajusticia_objeto')}}" class="nav-link dropdown-item">Reporte por Objeto</a></li>
                                @endcan
                                <!-- === -->
                                @can('report.ambitoaplicacion_secretariajusticia')
                                <li class="nav-item"><a href="{{route('secretariajusticia_ambitoaplicacion')}}" class="nav-link dropdown-item">Reporte por Ambito de Aplicación</a></li>
                                @endcan
                                <!-- === -->
                            </ul>
                        </li>
                        @endcan
                        <!-- == -->
                        @can('dropdown.coordinacionmunicipal')
                        <li class="nav-item dropdown">
                            <a href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dir. Coordinación Municipal</a>
                            <ul class="dropdown-menu border-0 shadow">
                                <!-- === -->
                                @can('reservacoordinacionmunicipal.index')
                                <li class="nav-item"><a href="{{route('reservacoordinacionmunicipal.index')}}" class="nav-link dropdown-item">Reserva de Nombre</a></li>
                                @endcan
                                <!-- === -->
                                @can('personeriacoordinacionmunicipal.index')
                                <li class="nav-item"><a href="{{route('personeriacoordinacionmunicipal.index')}}" class="nav-link dropdown-item">Personerías Jurídicas</a></li>
                                @endcan
                                <!-- === -->
                                <li class="dropdown-divider"></li>
                                @can('report.personeria_coordinacionmunicipal')
                                <li class="nav-item"><a href="{{route('pjcoordinacionmunicipal_por_fecha')}}" class="nav-link dropdown-item">Reporte por Fechas Personerías Jurídicas</a></li>
                                @endcan
                                <!-- === -->
                                @can('report.reservanombre_coordinacionmunicipal')
                                <li class="nav-item"><a href="{{route('rncoordinacionmunicipal_por_fecha')}}" class="nav-link dropdown-item">Reporte por Fechas Reservas de Nombre</a></li>
                                @endcan
                                <!-- === -->
                                @can('report.objeto_coordinacionmunicipal')
                                <li class="nav-item"><a href="{{route('coordinacionmunicipal_objeto')}}" class="nav-link dropdown-item">eporte por Objeto</a></li>
                                @endcan
                                <!-- === -->
                                @can('report.tipoorganizacion_coordinacionmunicipal')
                                <li class="nav-item"><a href="{{route('coordinacionmunicipal_tipoorganizacion')}}" class="nav-link dropdown-item">Reporte por Tipo Organización</a></li>
                                @endcan
                                <!-- === -->
                            </ul>
                        </li>
                        @endcan
                        <!-- == -->
                                @can('datosantiguos.personerias')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('consultadato.index')}}">Datos de Consultas</a>
                                </li>
                                @endcan
                                <!-- == -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Hola! {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @include('sweetalert::alert')
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- jQuery -->
    <script src="{{asset('theme/plugins/jquery/jquery.min.js')}}"></script>
    @stack('script')
    <!-- Bootstrap 4 -->
    <script src="{{asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('theme/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
