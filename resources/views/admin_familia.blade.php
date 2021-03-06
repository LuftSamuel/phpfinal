<div id="page-wrapper">

    <div id="page-inner">

        <div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
            @if (Session::has('fm_crear'))
                <div class="alert alert-success alert-dismissible"><em>
                        {!! session('fm_crear') !!}</em>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h2>Crear nueva familia</h2>
            <form method="post" enctype="multipart/form-data" action={{ route('admin.familia.crear') }}>
                @csrf

                <!-- input nombre de la familia -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Nombre</label>
                    <input type="text" name="familia" value="{{ old('familia') }}" class="form-control"
                        id="inputText" required>
                </div><br>
                <!-- boton tipo submit -->
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Crear</button>
                </div>
                @if ($errors->has('familia'))
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
            @if (Session::has('fm_eliminar'))
                <div class="alert alert-success alert-dismissible"><em>
                        {!! session('fm_eliminar') !!}</em>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h2>Eliminar una familia</h2>
            (Solo se pueden eliminar familias a las cuales no se les haya agregado una planta)
            <form method="get" enctype="multipart/form-data" action={{ route('admin.familia.borrar') }}>
                @csrf

                <!-- input select familia -->
                <div class="form-group">
                    <label for="familia">Familia</label>
                    <select id="familia" name="id_familia" class="form-control">
                        <!-- el espectro de las variables es distinto en php y blade -->
                        @php
                            $array;
                            $i = 0;
                            
                            foreach ($plantas as $planta) {
                                $array[$i] = $planta->id_familia;
                                $i = $i + 1;
                            }
                        @endphp
                        @foreach ($familias as $familia)
                            @if (!in_array($familia->id_familia, $array))
                                <option value="{{ $familia->id_familia }}"
                                    @if (old('familia') == $familia->id_familia) selected @endif>{{ $familia->familia }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <!-- boton tipo submit -->
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Eliminar</button>
                </div>

            </form>
        </div>


        <div style="margin: auto; max-width: 600px; width: 100%; padding: 2em;">
            @if (Session::has('fm_modificar'))
                <div class="alert alert-success alert-dismissible"><em>
                        {!! session('fm_modificar') !!}</em>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <h2>Modificar una familia</h2>
            <form method="post" enctype="multipart/form-data" action={{ route('admin.familia.modificar') }}>
                @csrf

                <!-- input select familia -->
                <div class="form-group">
                    <label for="familia">Familia</label>
                    <select id="familia" name="id_familia" class="form-control">
                        @foreach ($familias as $familia)
                            <option value="{{ $familia->id_familia }}"
                                @if (old('familia') == $familia->id_familia) selected @endif>{{ $familia->familia }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- input nuevo nombre de la familia -->
                <div class="mb-3">
                    <label for="inputText" class="form-label">Nuevo Nombre</label>
                    <input type="text" name="nombre" value="{{ old('familia') }}" class="form-control"
                        id="inputText" required>
                </div><br>
                <!-- boton tipo submit -->
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Modificar</button>
                </div>
                @if ($errors->has('nombre'))
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
