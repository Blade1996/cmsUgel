@extends('frontend.layouts.home_layout')
@section('title', 'Noticias')
@section('content')
<!-- Page filter-->
<div class="container mt-4 mb-4" id="buscador-filtro">
    <div class="col-md-6">
        <p>{{ $articles->total() }} resultados encontrados</p>
    </div>
</div>

<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Derecha entradas-->
        <div class="col-lg-9">
            <h3>Noticias: Más recientes</h3>
            <hr>
            @foreach ($articles as $article)
            <div class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
                <div class="col-auto d-none d-lg-block">
                    <img class="card-top-image" width="auto" height="180" src="{{ $article->page_image }}" alt="...">
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
            {{ $articles->links('frontend.paginator') }}
        </nav>
    </div>

</div>
</div>
<script>
    let search = document.getElementById('search');

    search.addEventListener('search', function (e) {
        e.preventDefault();
        console.log(search.value);
    })
</script>
@endsection
