

<!-- /. NAV SIDE  -->
<div id="page-wrapper" >

    <div id="page-inner">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Panel de administrador</h2>   
            </div>
        </div>              

        <div class="row text-center pad-top">

            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Ultimos mensajes</div>
                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Motivo</th>
                                <th>Mensaje</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach($mensajes as $mensaje)
                            <tr data-toggle="collapse" id="table1" data-target=".table1">
                                <td>{{ $mensaje->id }}</td>
                                <td>{{ $mensaje->enviado }}</td>  
                                <td>{{ $mensaje->nombre }}</td>
                                <td>{{ $mensaje->email }}</td>
                                <td>
                                    @if($mensaje->motivo == 0)
                                        Compra al por mayor 
                                    @else
                                        Otra consulta 
                                    @endif
                                </td>
                                <td><button class="btn btn-default btn-sm">View More</button></td>
                            </tr>

                            <tr class="collapse table1">
                                <td colspan="999">
                                    <div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Column 1</th>
                                                    <th>Column 2</th>
                                                    <th>Column 3</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Column 1</td>
                                                    <td>Column 2</td>
                                                    <td>Column 3</td>
                                                </tr>
                                                <tr>
                                                    <td>Column 1</td>
                                                    <td>Column 2</td>
                                                    <td>Column 3</td>
                                                </tr>
                                                <tr>
                                                    <td>Column 1</td>
                                                    <td>Column 2</td>
                                                    <td>Column 3</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            

        </div>

    </div>

</div><!-- /. PAGE INNER  -->