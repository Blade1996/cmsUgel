<!-- Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark position-sticky" aria-label="Fifth navbar example"
    style="top: 0!important;">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
            aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample05">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach ($sections as $section)
                @if (count($section->articles) > 0)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdown05" data-bs-toggle="dropdown"
                        aria-expanded="false">{{ $section->titulo }}</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown05">
                        @foreach ($section->articles as $article)
                        @if ($article->tipo == 'external')
                        <li><a class="dropdown-item" href="{{ $article->redireccion }}">{{
                                $article->titulo
                                }}</a></li>
                        @elseif ($article->tipo == 'pdf')
                        <li><a class="dropdown-item" href="{{ $article->archivo }}">{{
                                $article->titulo
                                }}</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{ route('home.article.detail', $article->id) }}">{{
                                $article->titulo
                                }}</a></li>
                        @endif
                        @endforeach
                    </ul>
                    @else
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">{{ $section->titulo }}</a>
                </li>
                @endif
                @endforeach
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home.contact') }}">Contacto</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>
<!-- Slider-->
