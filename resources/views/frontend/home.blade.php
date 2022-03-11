@extends('frontend.layouts.home_layout')
@section('title', 'UGEL ILO')
@section('content')

<!--chat whatsapp-->
<div class="chatbot"><a
        href="https://api.whatsapp.com/send?phone=[51][953977804]&amp;text=Buen día, ¿en qúe podemos ayudarle?..."
        target="_blank"><img src="https://toldospalomino.com/WhatsApp_Icon.png" alt=""></a></div>
<!--fin chat whatsapp-->


<div id="myCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($sliders as $key=>$slider)
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{  $key }}"
            aria-current="{{ $key === 1 ? 'true' : '' }}" aria-label="Slide {{ $key }}"
            class="{{ $key === 0 ? 'active'  : '' }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @php
        $i = 1
        @endphp
        @foreach ($sliders as $slider)
        <div class="carousel-item {{ $i === 1 ? 'active': '' }}" style="background-image: url({{ $slider->url_image }});
            background-size: cover;background-repeat: no-repeat;">
            @php
            $i++
            @endphp
            @if ($slider->show_caption == 1)
            <div class="container">
                <div class="carousel-caption text-start my-5">
                    <h1>{{ $slider->title_caption }}</h1>
                    <p>{{ $slider->subtitle_caption }}</p>
                    <p><a class="btn btn-lg btn-primary" href="{{ route('home.article.detail', $slider->id)}}">+
                            Información</a></p>
                </div>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<div class="pt-1 pb-2 mb-3" id="enlacesdeinteres">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <img style="float: left;" src="assets/img/iconenlaces.png" width="70" height="70" alt="" />
                <h3 class="title-color mb-3" style="float: left; margin-top: 25px;">Enlaces de interés</h3>
            </div>
            @foreach ($linksArray->chunk(5) as $links)
            <div class="col-xs-12 col-sm-6 col-md-4">
                @foreach ($links as $link)
                @if ($link->tipo == 'external')
                <a href="{{ $link->redireccion }}" target="_blank"><i
                        class="nav-icon fas {{ $link->icon_class }}"></i>{{
                    $link->titulo }}<i class="fas fa-chevron-right"></i></a>
                @elseif ($link->tipo == 'pdf')
                <a href="{{ $link->archivo }}" target="_blank"><i class="nav-icon fas {{ $link->icon_class }}"></i>{{
                    $link->titulo }}<i class="fas fa-chevron-right"></i></a>
                @else
                <a href="{{ route('home.article.detail', $link->id) }}" target="_blank"><i
                        class="nav-icon fas {{ $link->icon_class }}"></i>{{
                    $link->titulo }}<i class="fas fa-chevron-right"></i></a>
                @endif
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ======= Casos de exito Section ======= -->
<section id="casos" style="margin-bottom: 40px">
    <div class="container">
        <div class="row aos-init aos-animate" data-aos="zoom-in">
            <div class="owl-carousel owl-theme">
                @foreach ($partners as $partner)
                <div class="ml-2 mr-2 text-center">
                    <a href="{{ $partner->url }}" target="_blank" data-gallery="portfolioGallery"
                        class="portfolio-lightbox preview-link" title="">
                        <img src="{{ $partner->logo }}" class="img-fluid" alt=""><i class="bx bx-plus"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End Casos Section -->


<div class="" id="accesosdirectos" style="padding-bottom: 20px; padding-top: 20px; margin-bottom: 30px;">
    <div class="row" style="margin: auto; max-width: 80%;">
        <div class="col-md-2 col-sm-6 text-center mb-2"><a href="{{ route('home.announcements') }}" class="btn"><i
                    class="fas fa-bullhorn"></i> Convocatorias CAS</a></div>
        <div class="col-md-2 col-sm-6 text-center mb-2"><a href="#" class="btn"><i class="far fa-folder-open"></i>
                Sistema de
                control interno</a></div>
        <div class="col-md-2 col-sm-6 text-center mb-2"><a href="{{ route('home.contract') }}" class="btn"><i
                    class="far fa-file" aria-hidden="true"></i>Contratos</a></div>
        <div class="col-md-2 col-sm-6 text-center mb-2"><a href="{{ route('home.reassign') }}" class="btn"><i
                    class="fas fa-sync" aria-hidden="true"></i>Reasignación</a></div>
        <div class="col-md-2 col-sm-6 text-center mb-2"><a href="{{ route('home.normativity') }}" class="btn"><i
                    class="far fa-file" aria-hidden="true"></i>Normatividad</a></div>
        <div class="col-md-2 col-sm-6 text-center mb-2"><a href="{{ route('home.charges') }}" class="btn"><i
                    class="far fa-file" aria-hidden="true"></i>Encargaturas</a></div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-9">
            <!-- CONVOCATORIAS CAS-->

            <div class="card-header">
                Convocatorias CAS
                <a class="pull-right" href="{{ route('home.announcements') }}">Ver todo&nbsp;&nbsp;<i
                        class="fas fa-angle-right"></i></a>
            </div>
            <div class="row">
                @foreach ($announcements as $announcement)
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="small text-muted">{{ $announcement->creado ?? "" }}</div>
                        <h2 class="card-title h4">{{ $announcement->nombre }}</h2>
                        <p class="card-text">{{ $announcement->created_at }} RESULTADOS FINALES</p>
                        <a href="{{ route('home.announcement.detail', $announcement->id) }}" class="stretched-link"><i
                                class="bi bi-app"></i>
                            Ver&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>


            <!-- NORMATIVIDAD-->
            <div class="card-header mt-4">
                Normatividad
                <a class="pull-right" href="{{route('home.normativity')}}">Ver todo&nbsp;&nbsp;<i
                        class="fas fa-angle-right"></i></a>
            </div>
            <div class="row">
                @foreach ($normativities as $normativity)
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="small text-muted">{{ $normativity->fecha }}</div>
                        <h2 class="card-title h4">{{ $normativity->nombre }}</h2>
                        <p class="card-text">28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                        <a href="{{ $normativity->archivo }}" class="stretched-link"><i class="bi bi-app"></i>
                            Ver&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- NOTICIAS-->
            <div class="card-header mt-4">
                Noticias
                <a class="pull-right" href="{{route('home.articles')}}">Ver todo&nbsp;&nbsp;<i
                        class="fas fa-angle-right"></i></a>
            </div>
            <div class="row">
                @foreach ($articles as $article)
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative mb-4 pt-2">
                            <div class="col-auto d-none d-lg-block">
                                <img class="card-img-top-news" src="{{ $article->imagen }}" alt="..." />
                            </div>
                            <div class="col d-flex flex-column position-static">
                                <div class="mb-1 text-muted">{{ $article->creado }}</div>
                                <h4 class="card-title h4">{{ $article->titulo }}</h4>

                                <p class="card-text">{{ $article->resumen }}</p>
                                <a href="{{ route('home.article.detail', $article->id) }}"
                                    class="stretched-link">Ver&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- GESTION PEDAGOGICA-->
            <div class="card-header mt-4">
                Gestion Pedagógica
                <a class="pull-right" href="{{route('home.articles')}}">Ver todo&nbsp;&nbsp;<i
                        class="fas fa-angle-right"></i></a>
            </div>
            <div class="row">
                @foreach ($gestions as $gestion)
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative mb-4 pt-2">
                            <div class="col-auto d-none d-lg-block">
                                <img class="card-img-top-news" src="{{ $gestion->imagen }}" alt="..." />
                            </div>
                            <div class="col d-flex flex-column position-static">
                                <div class="mb-1 text-muted">{{ $gestion->creado }}</div>
                                <h4 class="card-title h4">{{ $gestion->titulo }}</h4>

                                <p class="card-text">{{ $gestion->resumen }}</p>
                                <a href="{{ route('home.article.detail', $gestion->id) }}"
                                    class="stretched-link">Ver&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

        <div class="col-lg-3">
            <h class="title-color">Enlaces Directos</h>
            <hr />
            <div class="col-md-12 border p-3 mb-4">
                <a href="http://200.48.65.242/sisgedonew/app/main.php?_op=1I&_type=L&_nameop=Login%20de%20Acceso"
                    target="_blank"><img class="img-fluid" style="margin-top: 8px;" src="{{ asset('images/link.jpg') }}"
                        width="700"></a>
                <a href="http://miboleta.minedu.gob.pe/" target="_blank"><img class="img-fluid" style="margin-top: 8px;"
                        src="{{ asset('images/link1.jpg') }}" width="700"></a>
                <a href="http://siagie.minedu.gob.pe/inicio/" target="_blank"><img class="img-fluid"
                        style="margin-top: 8px;" src="{{ asset('images/link2.jpg') }}" width="700"></a>

            </div>
            <!--            <a class="btn btn-outline-primary w-100 mb-5" href="filtro-noticias.html">Ver todas las noticias →</a>-->
        </div>
    </div>
</div>
<input type="hidden" name="countModal" value="{{ $popUps->count() }}">
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                        $i = 1
                        @endphp
                        @foreach ($popUps as $popUp)
                        <div class="carousel-item {{  $i === 1 ? 'active': ''  }}">
                            @php
                            $i++
                            @endphp
                            <a href="{{ $popUp->image }}">
                                <img class="w-100" src="{{ $popUp->image }}" alt="">
                            </a>

                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{-- <script src="{{ url('plugins/js/jquery/jquery.min.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
@endsection
