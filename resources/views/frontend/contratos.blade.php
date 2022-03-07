@extends('frontend.layouts.home_layout')
@section('title', 'Contratos')
@section('content')
<div class="container mt-4 mb-4" action="{{ route('home.contract') }}" method="GET">
    <div class="col-md-6">
        <form class="d-flex mb-2">
            <p class="mt-3 pr-2" style="margin-right: 10px">Buscar</p> <input class="form-control me-2" type="Buscar"
                placeholder="Buscar en documentos" aria-label="Buscar" name="search">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </form>
        <p>{{ $contracts->total() }} resultados encontrados</p>
    </div>
</div>
<!-- Page content-->
<div class="container mt-4 mb-4">
    <div class="row">
        <!-- Filtros-->
        <div>
            <h3>Filtrar por:</h3>
            <hr>
            <!-- Search widget-->
            <div class="mb-4">
                <form action="{{ route('home.contract') }}" method="GET">
                    <div class="col-md-12 mb-3">
                        <label for="country" class="form-label">Tipo de documento</label>
                        <select class="form-select" id="category" type="contrato" required="">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <a class="btn btn-primary w-100 mt-2" href="{{ route('home.contract') }}">Limpiar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="resultado-filtro">
            <h3>Documentos generales: Contratos</h3>
            <hr>
            <div class="col-md-12 border p-3">
                @foreach ($contracts as $contract)
                <div class="row g-0 rounded overflow-hidden flex-md-row h-md-250 position-relative">
                    <div class="col-auto d-none d-lg-block">
                        <img class="card-img-top" src="{{ $contract->imagen }}" alt="...">

                    </div>
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0">{{ $contract->nombre }}</h3>
                        <div class="mb-1 text-muted">{{ $contract->fecha }}</div>
                        <p class="card-text mb-auto">{{ $contract->descripcion }}</p>
                        <a href="{{ $contract->archivo }}" class="stretched-link"><i class="bi bi-app"></i>
                            Ver/Descargar&nbsp;&nbsp;<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                {{ $contracts->links('frontend.paginator') }}
            </nav>
        </div>
    </div>
    <!-- Derecha entradas-->


</div>
</div>

@endsection
