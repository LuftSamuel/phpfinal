<div id="page-wrapper">

    <div id="page-inner">

        @if (Session::has('alert-success'))
            <div class="alert alert-success alert-dismissible"><em>
                    {!! session('alert-success') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo Venta</th>
                    <th scope="col">Familia</th>
                    <th scope="col">Articulo</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($plantas as $planta)
                    <tr>
                        <td>{{ $planta->nombre }}</td>

                        <td>
                            @if ($planta->tipo_venta == 0)
                                {{ 'Minorista' }}
                            @else
                                {{ 'Mayorista' }}
                            @endif
                        </td>


                        <td>
                            @foreach ($familias as $familia)
                                @if ($familia->id_familia == $planta->id_familia)
                                    {{ $familia->familia }}
                                @endif
                            @endforeach
                        </td>


                        <td>
                            <a href="{{ route('individual', Str::slug($planta->id_planta)) }}" target="_blank">Ver
                                Articulo</a>
                        </td>

                        <td>
                            <form
                                action="@if ($planta->tipo_venta == 0) {{ route('admin.menor') }} @else {{ route('admin.mayor') }} @endif">
                                <input type="hidden" value="{{ $planta->id_planta }}" name="id">
                                <button type="submit">Modificar</button>
                            </form>
                        </td>

                        <td>

                            <form action="{{ route('admin.planta.eliminar') }}"
                                onsubmit="return confirm('Seguro que deseas eliminar este articulo?');">
                                <input type="hidden" value="{{ $planta->id_planta }}" name="id">
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>
        <div class="row text-center pad-top">
            {{ $plantas->links() }}
        </div>

    </div>

</div>
