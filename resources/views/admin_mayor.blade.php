<div id="page-wrapper" >

    <div id="page-inner">

        <div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
            <form method="post" enctype="multipart/form-data" action="@if(isset($modificar_planta)) {{route('admin.mayor.modificar')}} @else {{route('admin.mayor.crear')}} @endif">
                @csrf
                @if(isset($modificar_planta))
                <input type="hidden" value="{{$modificar_planta->id_planta}}" name="id">
                @endif
                <!-- input nombre de la planta -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Nombre</label>
                    <input type="text" name="nombre" value="@if(isset($modificar_planta)) {{ $modificar_planta->nombre }} @else {{ old('nombre') }} @endif" class="form-control" id="inputText" required>
                </div>     
                <!-- input select familia -->
                <div class="form-group">
                    <label for="familia">Familia</label>
                    <select id="familia" name="familia" class="form-control">
                        <!-- <option selected>Selecciona una familia</option> -->
                        @foreach($familias as $familia)
                        <option value="{{ $familia->id_familia }}"  @if(isset($modificar_planta) and $modificar_planta->id_familia==$familia->id_familia) selected @elseif(old('familia')==$familia->id_familia) selected @endif>{{ $familia->familia }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- input archivo imagen -->
                <div class="mb-3">
                    <label for="inputFile" class="form-label">Archivo imagen</label>
                    <input class="form-control" type="file" name="archivo_imagen" id="formFileMultiple" required>
                </div>
                <!-- input pedido minimo -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Pedido minimo</label>
                    <input type="text" name="pedido_minimo" value="@if(isset($modificar_mayor)) {{$modificar_mayor->pedido_minimo}} @else {{ old('pedido_minimo') }} @endif" class="form-control" id="inputText" required>
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