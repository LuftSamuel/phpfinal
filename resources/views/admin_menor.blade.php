<div id="page-wrapper" >

    <div id="page-inner">

        <div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
            <form method="post" enctype="multipart/form-data" action={{route('admin.menor.crear')}}>
                @csrf
                <!-- input nombre de la planta -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" class="form-control" id="inputText" required>
                </div>
                <!-- input select familia -->
                <div class="form-group">
                    <label for="familia">Familia</label>
                    <select id="familia" name="familia" class="form-control">
                        <!-- <option selected>Selecciona una familia</option> -->
                        @foreach($familias as $familia)
                        <option value="{{ $familia->id_familia }}">{{ $familia->familia }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- input archivo imagen -->
                <div class="mb-3">
                    <input class="form-control" type="file" name="archivo_imagen" id="formFileMultiple" required>
                </div>
                <!-- input cantidad en stock -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Cantidad en stock:</label>
                    <input type="text" name="cantidad_stock" class="form-control" id="inputText" required>
                </div>
                <!-- input precio unitario -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Precio unitario:</label>
                    <input type="text" name="precio_unitario" class="form-control" id="inputText" required>
                </div>        
                <!-- boton tipo submit -->
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Subir</button>
                </div>
            </form>
        </div>

    </div>

</div>