<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Simple Responsive Admin</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" /> <!-- depende la ruta da problemas -->
        <!-- FONTAWESOME STYLES-->
        <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="../assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


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
                </div>
            </div>
            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">

                        <li class="active-link">
                            <a href="{{route('admin.index')}}" ><i class="fa fa-desktop "></i>Inicio</a>
                        </li>

                        <li class="active-link">
                            <a href="{{route('admin.mayor')}}" ><i class="fa fa-desktop "></i>Crear Mayorista</a>
                        </li>

                        <li>
                            <a href="{{route('admin.menor')}}"><i class="fa fa-table "></i>Crear Minorista</a>
                        </li>

                    </ul>
                </div>

            </nav>

            @if($titulo == 'Panel admin')   
            @include('admin_main')
            @elseif($titulo == 'Articulo al por mayor')   
            @include('admin_mayor')
            @elseif($titulo == 'Articulo al por menor')   
            @include('admin_menor')
            @endif

        </div><!-- /. PAGE WRAPPER  -->

        <div class="footer">
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
                </div>
            </div>
        </div>


        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>


    </body>
</html>
