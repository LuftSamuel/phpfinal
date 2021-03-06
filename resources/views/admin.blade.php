<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>{{$titulo . " | " . str_replace("_"," ",config('app.name'))}}</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link rel="icon" type="image/png" href="{{asset('assets/iconos/favicon-32x32.png')}}" sizes="32x32" />
        <link rel="icon" type="image/png" href="{{asset('assets/iconos/favicon-16x16.png')}}" sizes="16x16" />
    </head>
    <body>



        <div id="wrapper">
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="adjust-nav">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>


                    </div>

                    <span class="logout-spn" >
                        <form action="desloguearse" method="post">
                            @csrf
                            <a href="#" onclick="this.closest('form').submit()" style="color:#fff;">Desloguearse</a>
                        </form>                        
                    </span>
                    
                    <span class="logout-spn" >
                        <form action="{{route('busqueda')}}" method="get">
                            <a href="#" onclick="this.closest('form').submit()" style="color:#fff;">Inicio</a>
                        </form>                        
                    </span>
                    
                </div>
            </div>
            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        
                        <li class="{{ (Route::current()->getName() == "admin.index") ? "active-link" : "" }}">
                            <a href="{{route('admin.index')}}" ><i class="fa fa-file-o"></i>Inicio</a>
                        </li>

                        <li class="{{ (Route::current()->getName() == "admin.mayor") ? "active-link" : "" }}">
                            <a href="{{route('admin.mayor')}}" ><i class="fa fa-tree"></i>Crear Mayorista</a>
                        </li>

                        <li class="{{ (Route::current()->getName() == "admin.menor") ? "active-link" : "" }}">
                            <a href="{{route('admin.menor')}}"><i class="fa fa-pagelines"></i>Crear Minorista</a>
                        </li>
                        
                        <li class="{{ (Route::current()->getName() == "admin.familia") ? "active-link" : "" }}">
                            <a href="{{route('admin.familia')}}"><i class="fa fa-cog"></i>Administrar Familias</a>
                        </li>
                        
                        <li class="{{ (Route::current()->getName() == "admin.planta") ? "active-link" : "" }}">
                            <a href="{{route('admin.planta')}}"><i class="fa fa-cog"></i>Administrar Plantas</a>
                        </li>

                    </ul>
                </div>

            </nav>

            @if($titulo == 'Panel admin')   
                @include('admin_mensajes')
            @elseif($titulo == 'Articulo al por mayor')   
                @include('admin_mayor')
            @elseif($titulo == 'Articulo al por menor')   
                @include('admin_menor')
            @elseif($titulo == 'Familias')
                @include('admin_familia')
            @elseif($titulo == 'Plantas')
                @include('admin_plantas')
            @endif

        </div><!-- /. PAGE WRAPPER  -->

        <div class="footer">
            <div class="row">
                <div class="col-lg-12" >
                    
                </div>
            </div>
        </div>


        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="{{asset('assets/js/custom.js')}}"></script>

        <script>
            //La funcion busca el mensaje y le quita o agrega la clase d-none que oculta
            function mostrarMensaje(id){
                $('#mensaje'+id).toggle('d-none')

            }
        </script>
    </body>
</html>
