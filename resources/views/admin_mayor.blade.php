<div id="page-wrapper" >

    <div id="page-inner">

        <div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
            <form method="post" enctype="multipart/form-data" action={{route('admin.mayor.crear')}}>
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
                        <option value="{{ $familia->id_familia }}"  @if(old('familia')==$familia->id_familia) selected @endif>{{ $familia->familia }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- input archivo imagen -->
                <div class="mb-3">
                    <input class="form-control" type="file" name="archivo_imagen" id="formFileMultiple" required>
                </div>
                <!-- input pedido minimo -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Pedido minimo:</label>
                    <input type="text" name="pedido_minimo" class="form-control" id="inputText" required>
                </div>
                <!-- boton tipo submit -->
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Subir</button>
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