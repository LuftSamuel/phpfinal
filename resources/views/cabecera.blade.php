<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>{{str_replace("_"," ",config('app.name'))}}</title> -->
    <title>{{$titulo}}</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/templatemo-style.css')}}">
    <!-- para el dropdown button -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

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
            <a class="navbar-brand" href="index.html">
                <i class="fas fa-film mr-2"></i>
                {{str_replace("_"," ",config('app.name'))}}
                
                <!-- En esta parte podria revisar si el admin esta logeado y si esta 
                entonces que en la navegacion me aparezcan mas links, para desloguearse
                y para ir a la pagina de admin, abajo tengo algo parecido-->
                
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-1" href="{{ route('inicio') }}">Articulos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-2" href="{{ route('contacto.mostrar') }}">Contacto</a>
                </li>
                @if(isset($_SESSION['nombre']))
                    <li class="nav-item">
                        <a class="nav-link nav-link-4" href="contact.html">Panel de administrador</a>
                    </li>
                @endif
            </ul>
            </div>
        </div>
    </nav>