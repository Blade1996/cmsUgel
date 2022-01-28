@extends('frontend.layouts.home_layout')
@section('title', 'Noticias')
@section('content')
<!-- Page filter-->
<div class="container mt-4 mb-4" id="buscador-filtro">
    <div class="col-md-6">

        <form class="d-flex mb-2">
            <p class="mt-3 pr-2" style="margin-right: 10px">Buscar</p> <input class="form-control me-2" type="Buscar"
                placeholder="Buscar en noticias" aria-label="Buscar">
        </form>
        <p>100 resultados encontrados</p>
    </div>
</div>

<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Filtros-->
        <div class="col-lg-3">
            <h3>Ordenar por:</h3>
            <hr>
            <!-- Search widget-->
            <div class="mb-4">
                <form class="needs-validation" novalidate>
                    <div class="col-md-12 mb-3">
                        <select class="form-select" id="country" required="">
                            <option value="">Más recientes</option>
                            <option>Publicado los últimos 7 días</option>
                            <option>Publicado el último mes</option>
                            <option>Más antiguas</option>
                        </select>
                    </div>

                    <a class="btn btn-primary w-100 mt-2" href="#!">Aplicar</a>
            </div>
        </div>

        <!-- Derecha entradas-->
        <div class="col-lg-9">
            <h3>Noticias: Más recientes</h3>
            <hr>
            @foreach ($articles as $article)
            <div class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
                <div class="col-auto d-none d-lg-block">
                    <img class="card-top-image" width="140" height="180" src="{{ $article->page_image }}" alt="...">
                </div>
                <div class="col p-4 d-flex flex-column position-static">

                    <h3 class="mb-0">{{$article->title}}</h3>
                    <div class="mb-1 text-muted">{{$article->created_at}}</div>
                    <p class="card-text mb-auto">{{$article->subtitle}}</p>
                    <a href="{{route('home.article.detail',$article->slug )}}" class="stretched-link">Continuar
                        leyendo</a>
                </div>
            </div>
            <hr>
            @endforeach

        </div>
        <!-- Pagination-->
        <nav aria-label="Pagination">
            <hr class="my-0" />
            <ul class="pagination justify-content-center my-4">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Más
                        recientes</a></li>
                <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                <li class="page-item"><a class="page-link" href="#!">2</a></li>
                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                <li class="page-item"><a class="page-link" href="#!">15</a></li>
                <li class="page-item"><a class="page-link" href="#!">Más antiguos</a></li>
            </ul>
        </nav>
    </div>

</div>
</div>
@endsection
