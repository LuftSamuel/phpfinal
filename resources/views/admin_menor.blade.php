<div id="page-wrapper" >

    <div id="page-inner">





        <div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
            <form method="post" enctype="multipart/form-data" action="@if(isset($modificar_planta)) {{route('admin.menor.modificar')}} @else {{route('admin.menor.crear')}} @endif">
                @csrf
                <!-- input id (oculto) -->
                @if(isset($modificar_planta))
                <input type="hidden" value="{{$modificar_planta->id_planta}}" name="id">
                @endif
                <!-- input nombre de la planta -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Nombre</label>
                    <input type="text" value="@if(isset($modificar_planta)) {{ $modificar_planta->nombre }} @else {{ old('nombre') }} @endif" name="nombre" class="form-control" id="inputText" required>
                </div>
                <!-- input select familia -->
                <div class="form-group">
                    <label for="familia">Familia</label>
                    <select id="familia" name="familia" class="form-control">
                        @foreach($familias as $familia)
                        <option value="{{ $familia->id_familia }}" @if(isset($modificar_planta) and $modificar_planta->id_familia==$familia->id_familia) selected @elseif(old('familia')==$familia->id_familia) selected @endif>{{ $familia->familia }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- input archivo imagen -->
                <div class="mb-3">
                    <label for="inputFile" class="form-label">Archivo imagen:</label>
                    <input class="form-control" type="file" name="archivo_imagen" id="formFileMultiple" @if(!isset($modificar_planta)) required @endif>
                </div>
                <!-- input cantidad en stock -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Cantidad en stock</label>
                    <input type="text" value="@if(isset($modificar_menor)) {{$modificar_menor->cantidad_stock}} @else {{ old('cantidad_stock') }} @endif" name="cantidad_stock" class="form-control" id="inputText" required>
                </div>
                <!-- input precio unitario -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Precio unitario</label>
                    <input type="text" value="@if(isset($modificar_menor)) {{$modificar_menor->precio_unitario}} @else {{ old('precio_unitario') }} @endif" name="precio_unitario" class="form-control" id="inputText" required>
                </div><br>        
                <!-- boton tipo submit -->
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">@if(isset($modificar_planta)) Modificar @else Subir @endif</button>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>   
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </div>




    </div>

</div>