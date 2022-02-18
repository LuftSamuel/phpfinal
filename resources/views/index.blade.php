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
        <h2 class="col-6 tm-text-primary">
            Ultimos Articulos
        </h2>
        <div class="col-6 d-flex justify-content-end align-items-center">
            <form action="" class="tm-text-primary">
                Page <input type="text" value="1" size="1" class="tm-input-paging tm-text-primary"> of 200
            </form>
        </div>
    </div>

    <div class="row tm-mb-90 tm-gallery"> <!-- desde aca -->

        @foreach($plantas as $planta) <!-- todavia no tengo imagenes para poner -->
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5 img-thumbnail">
            <figure class="effect-ming tm-video-item">
                <img src="imagenes/{{ $planta->titulo_imagen }}" alt="Image" class=" img-fluid" >
                <figcaption class="d-flex align-items-center justify-content-center">
                    <h2>{{$planta->nombre}}</h2>
                    <a href="<?php echo "www.google.com"; ?>">View more</a>
                </figcaption>                    
            </figure>
        </div>
        @endforeach

    </div> <!-- hasta aca row -->

    <div class="row tm-mb-90">
        <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
            <a href="javascript:void(0);" class="btn btn-primary tm-btn-prev mb-2 disabled">Previous</a>
            <div class="tm-paging d-flex">
                <a href="javascript:void(0);" class="active tm-paging-link">1</a>
                <a href="javascript:void(0);" class="tm-paging-link">2</a>
                <a href="javascript:void(0);" class="tm-paging-link">3</a>
                <a href="javascript:void(0);" class="tm-paging-link">4</a>
            </div>
            <a href="javascript:void(0);" class="btn btn-primary tm-btn-next">Next Page</a>
        </div>  

    </div>
</div> <!-- container-fluid, tm-container-content -->

@include('pie')