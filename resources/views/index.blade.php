@include('cabecera')

<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll"
    data-image-src="{{ url('assets/img/hero.jpg') }}">
    <form class="d-flex tm-search-form" method="get" action="{{ route('busqueda') }}">
        {{-- lo que tiene dentro del value es para que no se pierda lo escrito en el campo busqueda --}}
        <input class="form-control tm-search-input" name="buscar" type="search"
            value="{{ request()->query('buscar') }}" placeholder="Buscar" aria-label="Search">
        <button class="btn btn-outline-success tm-search-btn" type="submit">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>

<div class="container-fluid tm-container-content tm-mt-60">

    <div class="row mb-4">

        <div class="col-6 tm-text-primary">
            <h2 class="d-inline">
                Ultimos Articulos
            </h2>
            <select class="selectpicker">
                <option>Mustard</option>
                <option>Ketchup</option>
                <option>Relish</option>
            </select>

        </div>


        <div class="  col-6 d-flex justify-content-end align-items-center">
            <form action="" class="tm-text-primary">
                Pagina <input type="text" href="{{ $plantas->url(2) }}" value="{{ $plantas->currentPage() }}"
                    size="1" class="tm-input-paging tm-text-primary"> de {{ $plantas->lastPage() }}
            </form>
        </div>

    </div>

    <div class="row tm-mb-90 tm-gallery">
        <!-- desde aca -->

        @forelse ($plantas as $planta)
            <!-- todavia no tengo imagenes para poner -->
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="{{ asset('imagenes/' . $planta->id_planta . '/' . 'm' . $planta->titulo_imagen) }}"
                        class="img-fluid" style="width:320px;height:240px;">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2>{{ $planta->nombre }}</h2>
                        <!-- con Str::slug reemplazo el caracter de espacio en blanco en la url -->
                        <a href="{{ route('individual', Str::slug($planta->id_planta)) }}">Ver mas</a>
                    </figcaption>
                </figure>
            </div>
        @empty
            <p class="text-center">
                No se han encontrado resultados para <strong>{{ request()->query('buscar') }}</strong>
            </p>
        @endforelse

    </div> <!-- hasta aca row -->

    <div class="row tm-mb-90">
        @if ($plantas->hasPages())
            <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">



                @if ($plantas->onFirstPage())
                    <a class="btn btn-primary tm-btn-prev mb-2 disabled">Anterior</a>
                @else
                    <a href="{{ $plantas->previousPageUrl() }}" class="btn btn-primary tm-btn-prev mb-2">Anterior</a>
                @endif

                @if ($plantas->onFirstPage())
                    <a href="{{ $plantas->url(1) }}" class="disabled btn btn-primary tm-btn-prev mb-2">Primera</a>
                @else
                    <a href="{{ $plantas->url(1) }}" class="btn btn-primary tm-btn-prev mb-2">Primera</a>
                @endif

                <div class="tm-paging d-flex">
                    @if ($plantas->lastPage() > 6)
                        <!-- cambiar ese numero -->

                        @if ($plantas->currentPage() - 3 >= 1)
                            <a href="{{ $plantas->url($plantas->currentPage() - 3) }}"
                                class="tm-paging-link">{{ $plantas->currentPage() - 3 }}</a>
                        @endif
                        @if ($plantas->currentPage() - 2 >= 1)
                            <a href="{{ $plantas->url($plantas->currentPage() - 2) }}"
                                class="tm-paging-link">{{ $plantas->currentPage() - 2 }}</a>
                        @endif
                        @if ($plantas->currentPage() - 1 >= 1)
                            <a href="{{ $plantas->url($plantas->currentPage() - 1) }}"
                                class="tm-paging-link">{{ $plantas->currentPage() - 1 }}</a>
                        @endif
                        <a href="{{ $plantas->url($plantas->currentPage()) }}"
                            class="active tm-paging-link">{{ $plantas->currentPage() }}</a>
                        @if ($plantas->currentPage() + 1 <= $plantas->lastPage())
                            <a href="{{ $plantas->url($plantas->currentPage() + 1) }}"
                                class="tm-paging-link">{{ $plantas->currentPage() + 1 }}</a>
                        @endif
                        @if ($plantas->currentPage() + 2 <= $plantas->lastPage())
                            <a href="{{ $plantas->url($plantas->currentPage() + 2) }}"
                                class="tm-paging-link">{{ $plantas->currentPage() + 2 }}</a>
                        @endif
                        @if ($plantas->currentPage() + 3 <= $plantas->lastPage())
                            <a href="{{ $plantas->url($plantas->currentPage() + 3) }}"
                                class="tm-paging-link">{{ $plantas->currentPage() + 3 }}</a>
                        @endif
                    @else
                        @for ($i = 0; $i < $plantas->lastPage(); $i++)
                            @if ($plantas->currentPage() == $i + 1)
                                <a href="{{ $plantas->url($i + 1) }}"
                                    class="active tm-paging-link">{{ $i + 1 }}</a>
                            @else
                                <a href="{{ $plantas->url($i + 1) }}" class="tm-paging-link">{{ $i + 1 }}</a>
                            @endif
                        @endfor
                    @endif
                </div>

                @if ($plantas->onLastPage())
                    <a href="{{ $plantas->url($plantas->lastPage()) }}"
                        class="disabled btn btn-primary tm-btn-prev mb-2">Ultima</a>
                @else
                    <a href="{{ $plantas->url($plantas->lastPage()) }}"
                        class="btn btn-primary tm-btn-prev mb-2">Ultima</a>
                @endif

                @if ($plantas->onLastPage())
                    <a class="btn btn-primary tm-btn-next disabled">Siguiente</a>
                @else
                    <a href="{{ $plantas->nextPageUrl() }}" class="btn btn-primary tm-btn-next">Siguiente</a>
                @endif



            </div>
        @endif
    </div>
</div> <!-- container-fluid, tm-container-content -->

@include('pie')
