<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titulo . ' | ' . str_replace('_', ' ', config('app.name')) }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-style.css') }}">
    <!-- para el dropdown button -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <link rel="icon" type="image/png" href="{{asset('assets/iconos/favicon-32x32.png')}}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{asset('assets/iconos/favicon-16x16.png')}}" sizes="16x16" />

</head>

<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ route('busqueda') }}">
                <i class="fas fa-film mr-2"></i>
                {{ str_replace('_', ' ', config('app.name')) }}
            </a>

            @auth
                <form action="{{ route('desloguearse') }}" method="post">
                    @csrf
                    <a class="navbar-brand alert alert-danger" href="#"
                        onclick="this.closest('form').submit()">Desloguearse</a>
                </form>

                <form action="{{ route('admin.index') }}" method="get">
                    <a class="navbar-brand alert alert-dark" href="#" onclick="this.closest('form').submit()">Panel de
                        administrador</a>
                </form>
            @endauth

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button><!-- collapsable para la vista mobil -->

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-1" href="{{ route('busqueda') }}">Articulos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-2" href="{{ route('contacto.mostrar') }}">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
