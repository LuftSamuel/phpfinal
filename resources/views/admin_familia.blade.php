<div id="page-wrapper" >

    <div id="page-inner">

        <div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
            <h2>Crear nueva familia</h2>
            <form method="post" enctype="multipart/form-data" action={{route('admin.familia.crear')}}>
                @csrf

                <!-- input nombre de la familia -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Nombre</label>
                    <input type="text" name="familia" value="{{ old('familia') }}" class="form-control" id="inputText" required>
                </div><br>                  
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
        
        <div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
            <h2>Eliminar una familia</h2>
            (Solo se pueden eliminar familias a las cuales no se les haya agregado una planta)
            <form method="get" enctype="multipart/form-data" action={{route('admin.familia.borrar')}}>
                @csrf

                <!-- input select familia -->
                <div class="form-group">
                    <label for="familia">Familia</label>
                    <select id="familia" name="id_familia" class="form-control">
                        <!-- el espectro de las variables es distinto en php y blade -->
                        @php
                            $array;
                            $i = 0;
                            
                            foreach($plantas as $planta){
                               $array[$i] = $planta->id_familia;
                               $i = $i + 1; 
                            }
                        @endphp                        
                        @foreach($familias as $familia)
                            @if(!in_array($familia->id_familia,$array))
                                <option value="{{ $familia->id_familia }}"  @if(old('familia')==$familia->id_familia) selected @endif>{{ $familia->familia }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>                 
                <!-- boton tipo submit -->
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Eliminar</button>
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