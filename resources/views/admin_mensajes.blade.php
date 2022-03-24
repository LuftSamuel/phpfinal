<!-- /. NAV SIDE  -->
<div id="page-wrapper">

    <div id="page-inner">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Panel de administrador</h2>
            </div>
        </div>

        @if (Session::has('alert-success'))
            <div class="alert alert-success alert-dismissible"><em>
                    {!! session('alert-success') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <div class="">

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
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mensajes as $mensaje)
                                <tr>
                                    <td>{{ $mensaje->id }}</td>
                                    <td>{{ $mensaje->enviado }}</td>
                                    <td>{{ $mensaje->nombre }}</td>
                                    <td>{{ $mensaje->email }}</td>
                                    <td>
                                        @if ($mensaje->motivo == 0)
                                            Compra al por mayor
                                        @else
                                            Otra consulta
                                        @endif
                                    </td>
                                    <td>

                                        <form action="{{ route('admin.mensaje.eliminar') }}"
                                            onsubmit="return confirm('Seguro que deseas eliminar este mensaje?');">
                                            <input type="hidden" value="{{ $mensaje->id }}" name="id">
                                            <button type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                    <td><button class="btn btn-default btn-sm"
                                            onclick="mostrarMensaje({{ $mensaje->id }})">Ver Mensaje</button></td>

                                <tr class="d-none" id="mensaje{{ $mensaje->id }}">
                                    <td colspan="6">
                                        <div>{{ $mensaje->mensaje }}</div>
                                    </td>
                                </tr>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row text-center pad-top">
                        {{ $mensajes->onEachSide(2)->links() }}
                    </div>

                </div>
            </div>



        </div>

    </div>

</div><!-- /. PAGE INNER  -->
