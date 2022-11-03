@extends('frontend.layouts.home_layout')
@section('title', 'Sistema de Control Interno')
@section('content')
<div class="container mt-4 mb-4" action="{{ route('home.normativity') }}" method="GET">
    <div class="col-md-6">
        <form class="d-flex mb-2">
            <p class="mt-3 pr-2" style="margin-right: 10px">Buscar</p> <input class="form-control me-2" type="Buscar"
                placeholder="Buscar en documentos" aria-label="Buscar" name="search">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </form>
        <p>{{ $controls->total() }} resultados encontrados</p>
    </div>
</div>
<!-- Page content-->
<div class="container">
    <div class="row mt-4 mb-4">
        <!-- Filtros-->
        <div>
            <h3>Filtrar por:</h3>
            <hr>
            <!-- Search widget-->
            <div class="mb-4">
                <form action="{{ route('home.controls') }}" method="GET" class="needs-validation">
                    <div class="col-md-12 mb-3">
                        <label for="country" class="form-label">Tipo de documento</label>
                        <select class="form-select" name="categoryId" onchange="this.form.submit()">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <a class="btn btn-primary w-100 mt-2" href="{{ route('home.controls') }}">Aplicar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="resultado-filtro">
            <h3>Documentos generales: Control Intreno</h3>
            <hr>
            <div class="col-md-12 border p-3">
                @foreach ($controls as $charge)
                <div class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
                    <div class="col-auto d-none d-lg-block">
                        <img class="card-img-top" src="{{ $charge->imagen }}" alt="...">

                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0">{{ $charge->titulo }}</h3>
                        <div class="mb-1 text-muted">{{ $charge->fecha }}</div>
                        <p class="card-text mb-auto">{{ $charge->descripcion }}</p>
                        <a href="{{ route('') }}" class="stretched-link"><i class="bi bi-app"></i>
                            Ver&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                {{ $controls->links('frontend.paginator') }}
            </nav>
        </div>
    </div>
    <!-- Derecha entradas-->


</div>
</div>

@endsection
