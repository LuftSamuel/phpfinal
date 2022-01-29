@include('cabecera')

<div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="inputText" class="form-label">Nombre:</label>
            <input type="text" name="title" class="form-control" id="inputText" required>
        </div>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                Familia
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li><button class="dropdown-item" type="button">familia 1</button></li>
                <li><button class="dropdown-item" type="button">familia 2</button></li>
                <li><button class="dropdown-item" type="button">familia 3</button></li>
            </ul>
        </div>
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Seleccionar archivo/s</label>
            <input class="form-control" type="file" name="file" id="formFileMultiple" required>
        </div>   
        <div class="mb-3">
            <label for="inputText" class="form-label">Pedido minimo:</label>
            <input type="text" name="title" class="form-control" id="inputText" required>
        </div>
        
    </form>
</div>

@include('pie')