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
    <div class="hero-slider-item item-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="slider-content">
                        <span>Right Way..</span>
                        <h1>We Provide Legal Help For You</h1>
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising
                            pain was born and I will give you a complete account of the system, and expound the
                            actual teachings of the great explorer of the truth.</p>
                        <div class="slider-btn">
                            <a href="#" class="default-btn-two">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-slider-item item-bg2">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="slider-content">
                        <span>Right Way..</span>
                        <h1>Attorneys Fight For Your Justice</h1>
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising
                            pain was born and I will give you a complete account of the system, and expound the
                            actual teachings of the great explorer of the truth.</p>
                        <div class="slider-btn">
                            <a href="#" class="default-btn-two">Learn Moreg</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-slider-item item-bg3">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="slider-content">
                        <span>Right Way..</span>
                        <h1>It’s Our Pride To Fight For Your Dream</h1>
                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising
                            pain was born and I will give you a complete account of the system, and expound the
                            actual teachings of the great explorer of the truth.</p>
                        <div class="slider-btn">
                            <a href="#" class="default-btn-two">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Slider Area -->



<!-- About Area -->
<div class="about-area ptb-100">
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
                        <!--                                <span>Enlaces de interés</span></div>-->

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
    <!-- End About Area -->


    <!-- Partner Slider Area -->
    <div class="partner-area ptb-100">
        <div class="container">

            <div class="partner-slider owl-carousel owl-theme">
                <div class="partner-slider-item">
                    <a href="#">
                        <img src="assets/img/partner/partner1.png" alt="logo">
                    </a>
                </div>
                <div class="partner-slider-item">
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
                <h4>Enlaces de interés</h4>
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
        <!-- Fin Normatividad -->





        <!-- Blog Area -->
        <div class="blog-area pt-100 pb-70">
            <div class="container">
                <div class="section-title">
                    <h4>Noticias</h4>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-card">
                            <a href="blog-details.html">
                                <img src="assets/img/news&blog/blog1.jpg" alt="Image">
                            </a>
                            <div class="blog-card-text">
                                <h3><a href="blog-details.html">Reinicio de clases escolares</a></h3>
                                <ul>
                                    <li>
                                        <i class="las la-calendar"></i>
                                        22 de enero 2022
                                    </li>
                                    <li>
                                        <i class="las la-user-alt"></i>
                                        UGEL ILO
                                    </li>
                                </ul>

                                <p>At vero eos et accusamus et iusto odio praesentium voluptatum deleniti atque
                                    corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate.</p>

                                <a href="blog-details.html" class="read-more">
                                    Seguir leyendo <i class="las la-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="blog-card">
                            <a href="blog-details.html">
                                <img src="assets/img/news&blog/blog2.jpg" alt="Image">
                            </a>
                            <div class="blog-card-text">
                                <h3><a href="blog-details.html">Soy parte de institucional</a></h3>
                                <ul>
                                    <li>
                                        <i class="las la-calendar"></i>
                                        20 enero 2022
                                    </li>
                                    <li>
                                        <i class="las la-user-alt"></i>
                                        UGEL ILO
                                    </li>
                                </ul>

                                <p>At vero eos et accusamus et iusto odio praesentium voluptatum deleniti atque
                                    corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate.</p>

                                <a href="blog-details.html" class="read-more">
                                    Seguir leyendo <i class="las la-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 offset-sm-3 offset-lg-0">
                        <div class="blog-card">
                            <a href="blog-details.html">
                                <img src="assets/img/news&blog/blog3.jpg" alt="Image">
                            </a>
                            <div class="blog-card-text">
                                <h3><a href="blog-details.html">The virtue of justice consists in moderation</a>
                                </h3>
                                <ul>
                                    <li>
                                        <i class="las la-calendar"></i>
                                        14 enero 2022
                                    </li>
                                    <li>
                                        <i class="las la-user-alt"></i>
                                        UGEL ILO
                                    </li>
                                </ul>

                                <p>At vero eos et accusamus et iusto odio praesentium voluptatum deleniti atque
                                    corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate.</p>

                                <a href="blog-details.html" class="read-more">
                                    Seguir leyendo <i class="las la-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog Area -->
        @endsection
