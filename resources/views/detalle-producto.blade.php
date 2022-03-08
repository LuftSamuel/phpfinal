@include('cabecera')
    
<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="{{url('assets/img/hero')}}.jpg">
        <form class="d-flex tm-search-form" action="{{ route('busqueda') }}">
            <input class="form-control tm-search-input" type="search" placeholder="Search" aria-label="Search">
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
                <!-- sin el foreach no podia llegar a las distintas variables que estan
                contenidas en planta, array con 1 elemento cambiarlo despues-->
                <img src="{{asset('imagenes/' . $planta->id_planta . '/' . $planta->titulo_imagen) }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">
                    <p class="mb-4">
                        Please support us by making <a href="https://paypal.me/templatemo" target="_parent" rel="sponsored">a PayPal donation</a>. Nam ex nibh, efficitur eget libero ut, placerat aliquet justo. Cras nec varius leo.
                    </p>
                    <div class="text-center mb-5">
                        <a href="#" class="btn btn-primary tm-btn-big">Download</a>
                    </div>                    
                    <div class="mb-4 d-flex flex-wrap">
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Dimension: </span><span class="tm-text-primary">1920x1080</span>
                        </div>
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Format: </span><span class="tm-text-primary">JPG</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h3 class="tm-text-gray-dark mb-3">License</h3>
                        <p>Free for both personal and commercial use. No need to pay anything. No need to make any attribution.</p>
                    </div>
                    <div>
                        <h3 class="tm-text-gray-dark mb-3">Tags</h3>
                        <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">Cloud</a>
                        <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">Bluesky</a>
                        <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">Nature</a>
                        <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">Background</a>
                        <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">Timelapse</a>
                        <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">Night</a>
                        <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block">Real Estate</a>
                    </div>
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