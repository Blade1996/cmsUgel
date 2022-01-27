@extends('frontend.layouts.home_layout')
@section('title', $articleDetail->title )
@section('content')
<!-- Page banner Area -->
<div class="page-banner bg-1">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-content">
                    <h2>Noticias</h2>
                    <ul>
                        <li><a href="#">Inicio <i class="las la-angle-right"></i></a></li>
                        <li>Noticias</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page banner Area -->

<!-- Articulo -->
<div class="services-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-sm-12">
                <div class="services-details">
                    <div class="img">
                        <img src="{{ $articleDetail->page_image }}" alt="Image">
                    </div>
                    <div class="services-details-content">
                        <h3>{{ $articleDetail->title }}</h3>
                        <ul class="blog-list">
                            <li>
                                <i class="las la-calendar"></i>
                                {{ $articleDetail->created_at }}
                            </li>
                            <li>
                                <i class="las la-user-tie"></i>
                                <a href="#">UGEL ILO</a>
                            </li>
                        </ul>
                        <p>{!! $articleDetail->content !!}</p>
                    </div>
                    <div class="article-footer">
                        <div class="article-tags">
                            <span><i class="las la-tags"></i></span>
                            <a href="#">Articulo</a>,
                            <a href="#">Noticia</a>

                        </div>

                        <div class="article-share">
                            <ul class="social">
                                <li><span>Compartir:</span></li>
                                <li><a href="#" class="facebook" target="_blank"><i class="lab la-facebook-f"></i></a>
                                </li>
                                <li><a href="#" class="twitter" target="_blank"><i class="lab la-twitter"></i></a></li>
                                <li><a href="#" class="linkedin" target="_blank"><i class="lab la-linkedin-in"></i></a>
                                </li>
                                <li><a href="#" class="instagram" target="_blank"><i class="lab la-instagram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12">
                <div class="side-bar">



                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin de articulo -->
@endsection
