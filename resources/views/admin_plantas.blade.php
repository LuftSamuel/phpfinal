<div id="page-wrapper" >

    <div id="page-inner">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo Venta</th>
                    <th scope="col">Familia</th>
                    <th scope="col">Articulo</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach($plantas as $planta)
                <tr>
                    <td>{{ $planta->nombre }}</td>
                    
                    <td>
                        @if($planta->tipo_venta == 0)
                            {{"Minorista"}}
                        @else
                            {{ "Mayorista" }}
                        @endif
                    </td>
                    
                    
                    <td>
                        @foreach($familias as $familia)
                            @if($familia->id_familia == $planta->id_familia)
                                {{ $familia->familia }}
                            @endif
                        @endforeach
                    </td>
                   
                    
                    <td>
                        <a href="{{route('individual', Str::slug($planta->id_planta))}}" target="_blank">Ver Articulo</a>
                    </td>
                    
                    <td>
                        <!-- la idea aca es que con apretar el boton pueda cambiar la imagen del
                        producto, por ahora lo dejo asi por que primero tengo que terminar bien
                        lo de subir y mostrar imagenes que tenia conflictos, y le faltan las miniaturas-->
                        <button class="btn btn-primary" type="button">POR AHORA NO HACE NADA</button>
                    </td>
                    
                </tr>
                @endforeach
                
            </tbody>
        </table>

    </div>

</div>