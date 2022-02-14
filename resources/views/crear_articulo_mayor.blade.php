@include('cabecera')

<div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
    <form method="post" enctype="multipart/form-data" action="crearMayor"> <!-- falta el action -->
        @csrf
        
        <div class="mb-3">
            <label for="inputText" class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" id="inputText" required>
        </div>
        
        <div class="dropdown">
	  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		Dropdown button
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <option value="opcion 1">Opcion 1</option>
              <option value="opcion 2">Opcion 2</option>
	  </ul>
	</div>
        
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Seleccionar archivo/s</label>
            <input class="form-control" type="file" name="archivo_imagen" id="formFileMultiple" required>
        </div>
        
        <div class="mb-3">
            <label for="inputText" class="form-label">Pedido minimo:</label>
            <input type="text" name="cantidad_minima" class="form-control" id="inputText" required>
        </div>
        
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Subir</button>
        </div>
        
    </form>
</div>

@include('pie')