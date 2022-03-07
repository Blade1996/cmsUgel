@extends('frontend.layouts.home_layout')
@section('title', 'Reasignación')
@section('content')
<!-- Page content-->
<div class="container mt-4 mb-4" action="{{ route('home.reassign') }}" method="GET">
    <div class="col-md-6">
        <form class="d-flex mb-2">
            <p class="mt-3 pr-2" style="margin-right: 10px">Buscar</p> <input class="form-control me-2" type="Buscar"
                placeholder="Buscar en documentos" aria-label="Buscar" name="search">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </form>
        <p>{{ $reasigns->total() }} resultados encontrados</p>
    </div>
</div>

<div class="container mt-4 mb-4">
    <div class="row">
        <!-- Filtros-->
        <div>
            <h3>Filtrar por:</h3>
            <hr>
            <!-- Search widget-->
            <div class="mb-4">
                <form action="{{ route('home.reassign') }}" method="GET" class="needs-validation">
                    <div class="col-md-12 mb-3">
                        <label for="country" class="form-label">Tipo de documento</label>
                        <select class="form-select" name="categoryId" onchange="this.form.submit()">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <a class="btn btn-primary w-100 mt-2" href="{{ route('home.reassign') }}">Limpiar</a>
            </div>
        </div>
    </div>
    <div class="row  mt-4 mb-4">
        <!-- Derecha entradas-->
        <div id="resultado-filtro">
            <h3>Documentos generales: Reasignación</h3>
            <hr>
            <div class="col-md-12 border p-3">
                @foreach ($reasigns as $reasign)
                <div class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
                    <div class="col-auto d-none d-lg-block">
                        <img class="card-img-top" src="{{ $reasign->imagen }}" alt="...">
                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0">{{ $reasign->nombre }}</h3>
                        <div class="mb-1 text-muted">{{ $reasign->fecha }}</div>
                        <p class="card-text mb-auto">{{ $reasign->descripcion }}</p>
                        <a href="{{ $reasign->archivo }}" class="stretched-link"><i class="bi bi-app"></i>
                            Ver/Descargar&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                {{ $reasigns->links('frontend.paginator') }}
            </nav>
        </div>

    </div>


</div>
</div>

@endsection
