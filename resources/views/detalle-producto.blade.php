@include('cabecera')
    
<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="{{url('assets/img/hero.jpg')}}">
    <form class="d-flex tm-search-form" method="get" action="{{ route('busqueda') }}">
        <input class="form-control tm-search-input" name="buscar" type="search" placeholder="Buscar" aria-label="Search">
        <button class="btn btn-outline-success tm-search-btn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">{{ $planta->nombre }}</h2>
        </div>
        <div class="row tm-mb-90">            
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                <img src="{{asset('imagenes/' . $planta->id_planta . '/' . $planta->titulo_imagen) }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">

                    <h2 class="tm-text-primary">
                        {{ $planta->nombre }}
                    </h2><br><br>

                        @if($planta->tipo_venta == 0)
                            <h4 class="tm-text-primary">
                                {{ "Articulo al por menor" }}
                            </h4><br>
                            <h4 class="tm-text-primary">
                                {{ "Genero: " . $familia->familia }}
                            </h4><br>
                            <h6 class="tm-text-primary">
                                {{ "Todos los articulos al por menor listados estan dispibles
                                    para la venta en nuestro puesto. Si le interesa realizar un
                                    pedido especial al por mayor de este articulo utilice la pestaña
                                    de contacto y describa lo que le interesa a traves del mensaje."
                                }}
                            </h6><br>
                            <h4 class="tm-text-primary">
                                {{ "Precio unitario: " . $datosExtra->precio_unitario }}
                            </h4><br>
                        @else
                            <h4 class="tm-text-primary">
                                {{ "Articulo al por mayor" }}
                            </h4><br>
                            <h4 class="tm-text-primary">
                                {{ "Genero: " . $familia->familia }}
                            </h4><br>
                            <h6 class="tm-text-primary">
                                {{ "Todos los articulos al por mayor se venden solo a pedido,
                                    para realizar tu pedido ve a la pestaña contacto y simplemente
                                    describe que te interesa comprar."
                                }}
                            </h6><br>
                            <h4 class="tm-text-primary">
                                {{ "Pedido minimo: " . $datosExtra->pedido_minimo }}
                            </h4><br>
                        @endif
                        <a class="btn btn-primary" href="{{ route('contacto.mostrar') }}">Contacto</a>

                </div>
            </div>
        </div>
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">
                Articulos relacionados
            </h2>
        </div>
        
        <div class="row mb-3 tm-gallery">
            
            @foreach($relacionados as $r)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
            <figure class="effect-ming tm-video-item">
                <img src="{{asset('imagenes/' . $r->id_planta . '/' . 'm' . $r->titulo_imagen) }}" class="img-fluid" style="width:320px;height:240px;"> 
                <figcaption class="d-flex align-items-center justify-content-center">
                    <h2>{{$r->nombre}}</h2>
                    <!-- con Str::slug reemplazo el caracter de espacio en blanco en la url -->
                    <a href="{{route('individual', Str::slug($r->id_planta))}}">Ver mas</a>
                </figcaption>                    
            </figure>
            </div>
            @endforeach   
            
        </div> <!-- row -->
    </div> <!-- container-fluid, tm-container-content -->

    @include('pie')