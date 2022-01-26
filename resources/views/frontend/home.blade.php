@extends('frontend.layouts.home_layout')
@section('title', 'UGEL ILO')
@section('content')

<!--chat whatsapp-->
<div class="chatbot"><a
        href="https://api.whatsapp.com/send?phone=[51][993652872]&amp;text=Buen día, ¿en qúe podemos ayudarle?..."><img
            src="https://toldospalomino.com/WhatsApp_Icon.png" alt=""></a></div>
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
        <div class="carousel-item {{ $i === 1 ? 'active': '' }}">
            @php
            $i++
            @endphp
            <img src="{{ $slider->slider_image }}" alt="...">
            <div class="container">
                <div class="carousel-caption text-start my-5">
                    <h1>{{ $slider->title }}</h1>
                    <p>{{ $slider->subtitle }}</p>
                    <p><a class="btn btn-lg btn-primary" href="#">+ Información</a></p>
                </div>
            </div>
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


<div class="pt-1 pb-2 mb-3" id="enlacesdeinteres" style="">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <img style="float: left;" src="assets/img/iconenlaces.png" width="70" height="70" alt="" />
                <h3 class="title-color mb-3" style="float: left; margin-top: 25px;">Enlaces de interés</h3>
            </div>
            @foreach ($linksArray->chunk(3) as $links)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                @foreach ($links as $link)
                <a href="{{ $link->url_redirect }}" target="_blank"><i class="nav-icon fas fa-link"></i>{{
                    $link->title }}<i class="fas fa-chevron-right"></i></a>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>



<!--<section id="casos" class="" style="max-height: 170px;">
    <div class="container">
        <div class="row aos-init aos-animate" data-aos="zoom-in">
            <div id="caseCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($sliders as $key=>$slider)
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{  $key }}"
                        aria-current="{{ $key === 1 ? 'true' : '' }}" aria-label="Slide {{ $key }}"
                        class="{{ $key === 0 ? 'active'  : '' }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="ml-2 mr-2 text-center">
                            <a href="http://ugelilo.edu.pe/web/noticias/192/escuela-segura" target="_blank"
                                data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/1.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="http://ugelilo.edu.pe/web/noticias/192/escuela-segura" target="_blank"
                                data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/2.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="http://wasichay.perueduca.pe/" target="_blank" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/3.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="https://www.perueduca.pe/#/home" target="_blank" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/4.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="https://www.gob.pe/minedu" target="_blank" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/5.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="http://escale.minedu.gob.pe/" target="_blank" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/6.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="https://www.gob.pe/pronabec" target="_blank" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/7.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="" target="_blank" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/8.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="https://evaluaciondocente.perueduca.pe/ascenso2021/" target="_blank"
                                data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/9.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="http://ugelilo.edu.pe/web/noticias/120/qali-warma" target="_blank"
                                data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/11.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="http://umc.minedu.gob.pe/" target="_blank" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/12.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <div class="ml-2 mr-2 text-center">
                            <a href="http://www.siseve.pe/Web/" target="_blank" data-gallery="portfolioGallery"
                                class="portfolio-lightbox preview-link" title="">
                                <img src="{{ asset('images/slider/13.jpg') }}" class="img-fluid" alt=""><i
                                    class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#caseCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#caseCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>-->

<!-- End Casos Section -->
<div class="" id="accesosdirectos" style="padding-bottom: 20px; padding-top: 20px; margin-bottom: 30px;">
    <div class="row" style="margin: auto; max-width: 80%;">
        <div class="col-md-4 text-center mb-2"><a href="{{ route('home.announcements') }}" class="btn"><i
                    class="fas fa-bullhorn"></i> Convocatorias CAS</a></div>
        <div class="col-md-4 text-center mb-2"><a href="https://pandora.pe/ugel/control-interno" class="btn"><i
                    class="far fa-folder-open"></i> Sistema de control interno</a></div>
        <div class="col-md-4 text-center mb-2"><a href="{{ route('home.document') }}" class="btn"><i class="far fa-file"
                    aria-hidden="true"></i> Documentos generales</a></div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-9">
            <!-- CONVOCATORIAS CAS-->

            <div class="card-header">
                Convocatorias CAS
                <a class="pull-right" href="https://ugel.hostingonlineperu.com/convocatorias">Ver todo&nbsp;&nbsp;<i
                        class="fas fa-angle-right"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="small text-muted">10/11/21</div>
                        <h2 class="card-title h4">CAS Nº.013-2021-UGEL ILO-AGA-PER</h2>
                        <p class="card-text">28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                        <a href="post.html" class="stretched-link"><i class="bi bi-app"></i>
                            Ver/Descargar&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="small text-muted">10/11/21</div>
                        <h2 class="card-title h4">CAS Nº.013-2021-UGEL ILO-AGA-PER</h2>
                        <p class="card-text">28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                        <a href="post.html" class="stretched-link"><i class="bi bi-app"></i>
                            Ver/Descargar&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="small text-muted">10/11/21</div>
                        <h2 class="card-title h4">CAS Nº.013-2021-UGEL ILO-AGA-PER</h2>
                        <p class="card-text">28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                        <a href="post.html" class="stretched-link"><i class="bi bi-app"></i>
                            Ver/Descargar&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>

            </div>

            <!-- NOTICIAS-->
            <div class="card-header mt-4">
                Normatividad
                <a class="pull-right" href="{{route('home.normativity')}}">Ver todo&nbsp;&nbsp;<i
                        class="fas fa-angle-right"></i></a>
            </div>
            <div class="row">
                @foreach ($documents as $document)
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="small text-muted">{{ $document->created_at }}</div>
                        <h2 class="card-title h4">{{ $document->title }}</h2>
                        <p class="card-text">28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                        <a href="{{ $document->url_file }}" class="stretched-link"><i class="bi bi-app"></i>
                            Ver/Descargar&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- NORMATIVIDAD-->
            <div class="card-header mt-4">
                Noticias
                <a class="pull-right" href="{{route('home.articles')}}">Ver todo&nbsp;&nbsp;<i
                        class="fas fa-angle-right"></i></a>
            </div>
            <div class="row">
                @foreach ($articles as $document)
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="card-body">
                        <div class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative mb-4 pt-2">
                            <div class="col-auto d-none d-lg-block">
                                <img class="card-img-top-news" src="https://pandora.pe/ugel/assets/img/noticias/1.jpg"
                                    alt="..." />
                            </div>
                            <div class="col d-flex flex-column position-static">
                                <div class="mb-1 text-muted">{{ $article->created_at }}</div>
                                <h4 class="card-title h4">{{ $article->title }}</h4>

                                <p class="card-text">{{ $document->subtitle }}</p>
                                <a href="" class="stretched-link">Ver/Descargar&nbsp;&nbsp;<i
                                        class="fas fa-angle-right"></i></a>
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
                <img class="img-fluid" style="margin-top: 8px;" src="{{ asset('images/link.jpg') }}" width="700">
                <img class="img-fluid" style="margin-top: 8px;" src="{{ asset('images/link1.jpg') }}" width="700">
                <img class="img-fluid" style="margin-top: 8px;" src="{{ asset('images/link2.jpg') }}" width="700">

            </div>
            <!--            <a class="btn btn-outline-primary w-100 mb-5" href="filtro-noticias.html">Ver todas las noticias →</a>-->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ $companyData->first_image }}" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
{{-- <script src="js/scripts.js"></script> --}}<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
{{-- <script src="{{ url('plugins/js/jquery/jquery.min.js') }}"></script> --}}
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#casos .owl-carousel').owlCarousel({
      autoplay: false,
      autoplayHoverPause: true,
      items: 6,
      nav: true,
      dots: false,
      loop: false,
      margin: 10,
      responsiveClass: true,
      responsive: {
        0: {
          items: 2,
          nav: false,
          dots: false,
          loop: true,
          autoplay: true,
        },
        600: {
          items: 6,
          nav: false,
          dots: false,
          loop: true,
          autoplay: true,
        },
        1000: {
          items: 6,
          nav: false,
          loop: true,
          margin: 20,
          autoplay: true,
        }
      }
    })

})


$(document).ready(function() {

var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {

})
myModal.show();



})
</script>
@endsection
