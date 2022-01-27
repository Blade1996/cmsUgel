@extends('frontend.layouts.home_layout')
@section('title', 'UGEL ILO')
@section('content')
<!-- Search Overlay -->
<div class="search-overlay">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>

            <div class="search-overlay-close">
                <span class="search-overlay-close-line"></span>
                <span class="search-overlay-close-line"></span>
            </div>

            <div class="search-overlay-form">
                <form>
                    <input type="text" class="input-search" placeholder="Coloque la palabra de búsqueda...">
                    <button type="submit"><i class='las la-search'></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Search Overlay -->

<!-- Hero Slider Area -->
<div class="hero-slider owl-carousel owl-theme">
    {{-- @php
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
                <p><a class="btn btn-lg btn-primary" href="{{ route('home.article.detail', $slider->slug)}}">+
                        Información</a></p>
            </div>
        </div>
    </div>
    @endforeach --}}
    @php
    $i = 1
    @endphp
    @foreach ($sliders as $slider)
    <div class="hero-slider-item {{ $i === 1 ? 'active': '' }} item-bg{{ $i }}"
        style="background-image: url({{ $slider->slider_image }})">
        @php
        $i++
        @endphp
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="slider-content">
                        <span>{{ $slider->title }}</span>
                        <h1>{{ $slider->subtitle }}</h1>
                        <p>{{ $slider->resume }}</p>
                        <div class="slider-btn">
                            <a href="{{ route('home.article.detail', $slider->slug)}}" class="default-btn-two">Ver
                                más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- End Hero Slider Area -->



<!-- Enlaces de Interes -->
<div class="about-area pt-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="about-image">
                    <img src="assets/img/enlaces.jpg" alt="Image">
                </div>
            </div>

            <div class="col-lg-7">
                <div class="about-text">
                    <div class="section-title">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul>
                                    <li>
                                        <i class="las la-check-square"></i>
                                        Contrato docente 2021
                                    </li>
                                    <li>
                                        <i class="las la-check-square"></i>
                                        Contrato auxiliares 2021
                                    </li>
                                    <li>
                                        <i class="las la-check-square"></i>
                                        Reasignación docentes y auxiliares
                                    </li>
                                    <li>

                                </ul>
                            </div>

                            <div class="col-lg-6">
                                <ul>
                                    <li>
                                        <i class="las la-check-square"></i>
                                        Proceso de encargatura
                                    </li>
                                    <li>
                                        <i class="las la-check-square"></i>
                                        Procesos de personal administrativo
                                    </li>
                                    <li>
                                        <i class="las la-check-square"></i>
                                        Nombramiento auxiliares 2021
                                    </li>
                                    <li>

                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Enlades de Interes -->


<!-- Partner Slider Area -->
<div class="partner-area ptb-100">
    <div class="container">

        <div class="partner-slider owl-carousel owl-theme">
            @foreach ($partners as $partner)
            <div class="partner-slider-item">
                <a href="{{$partner->url}}" target="_blank">
                    <img src="{{$partner->logo}}" alt="logo">
                </a>
            </div>
            @endforeach
            <!-- <div class="partner-slider-item">
                    <a href="#">
                        <img src="assets/img/partner/partner2.png" alt="logo">
                    </a>
                </div>
                <div class="partner-slider-item">
                    <a href="#">
                        <img src="assets/img/partner/partner3.png" alt="logo">
                    </a>
                </div>
                <div class="partner-slider-item">
                    <a href="#">
                        <img src="assets/img/partner/partner4.png" alt="logo">
                    </a>
                </div>
                <div class="partner-slider-item">
                    <a href="#">
                        <img src="assets/img/partner/partner5.png" alt="logo">
                    </a>
                </div> -->
        </div>
    </div>
</div>
</div>
<!-- End Partner Slider Area -->



<!-- Convocatorias -->
<div class="service-area" style="margin-top: 40px;">
    <div class="container">

        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="about-btn" style="text-align: center;">
                    <a href="#" class="default-btn-one">Convocatorias CAS</a>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="about-btn" style="text-align: center;">
                    <a href="#" class="default-btn-one">Sistema de control interno</a>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="about-btn" style="text-align: center;">
                    <a href="#" class="default-btn-one">Documentos generales</a>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Tarjetas -->
<div class="about-area ptb-100">
    <div class="container">
        <div class="section-title" style="text-align: center">
            <h4>Enlaces Directos</h4>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="about-image">
                    <img src="assets/img/link.jpg" alt="Image">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="about-image">
                    <img src="assets/img/link1.jpg" alt="Image">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="about-image">
                    <img src="assets/img/link2.jpg" alt="Image">
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Fin tarjetas -->


<!--  Convocatorias -->

<div class="our-service-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h4>Convocatorias CAS</h4>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="our-service-card">
                    <i class="las la-users"></i>
                    <h3>10/11/21</h3>
                    <p>CAS Nº.013-2021-UGEL ILO-AGA-PER
                        28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="our-service-card">
                    <i class="las la-users"></i>
                    <h3>10/11/21</h3>
                    <p>CAS Nº.013-2021-UGEL ILO-AGA-PER
                        28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="our-service-card">
                    <i class="las la-users"></i>
                    <h3>10/11/21</h3>
                    <p>CAS Nº.013-2021-UGEL ILO-AGA-PER
                        28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                </div>
            </div>
        </div>
        <div class="about-btn" style="text-align: center;">
            <a href="#" class="default-btn-one">Ver todo</a>
        </div>

    </div>
</div>
<!-- Fin convocatorias -->


<!--  Normatividad -->

<div class="our-service-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h4>Normatividad</h4>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="our-service-card">
                    <i class="las la-list-ul"></i>
                    <h3>10/11/21</h3>
                    <p>CAS Nº.013-2021-UGEL ILO-AGA-PER
                        28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="our-service-card">
                    <i class="las la-users"></i>
                    <h3>10/11/21</h3>
                    <p>CAS Nº.013-2021-UGEL ILO-AGA-PER
                        28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="our-service-card">
                    <i class="las la-users"></i>
                    <h3>10/11/21</h3>
                    <p>CAS Nº.013-2021-UGEL ILO-AGA-PER
                        28 Oct, 2021 - 08:19 pm RESULTADOS FINALES</p>
                </div>
            </div>
        </div>
        <div class="about-btn" style="text-align: center;">
            <a href="#" class="default-btn-one">Ver todo</a>
        </div>
    </div>
</div>
<!-- Fin Normatividad -->

<!-- Blog Area -->
<div class="blog-area pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            <h4>Noticias</h4>
        </div>

        <div class="row">
            @foreach ($articles as $article)
            <div class="col-lg-4 col-sm-6">
                <div class="blog-card">
                    <a href="{{ route('home.article.detail', $slider->slug)}}">
                        <img src="{{ $article->page_image }}" alt="Image">
                    </a>
                    <div class="blog-card-text">
                        <h3><a href="blog-details.html">{{ $article->title }}</a></h3>
                        <ul>
                            <li>
                                <i class="las la-calendar"></i>
                                {{ $article->created_at }}
                            </li>
                            <li>
                                <i class="las la-user-alt"></i>
                                UGEL ILO
                            </li>
                        </ul>

                        <p>{{ $article->subtitle }}</p>

                        <a href="{{ route('home.article.detail', $slider->slug)}}" class="read-more">
                            Seguir leyendo <i class="las la-angle-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Blog Area -->
@endsection
