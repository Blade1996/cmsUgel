@extends('frontend.layouts.home_layout')
@section('title', $linkDetail->titulo)
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{ $linkDetail->titulo }}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Publicado el {{ $linkDetail->fecha }}</div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">etiqueta</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">etiqueta</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="{{ $linkDetail->imagen }}" alt="...">
                </figure>
                <!-- Post content-->
                <section class="mb-5">
                    {!!$linkDetail->descripcion!!}
                </section>
                @if ($linkDetail->tipo == 'tree')
                <div class="accordion accordion-flush" id="accordionFlushExample"
                    style="margin-top: 50px; margin-bottom: 50px">
                    @foreach ($treeDetail as $index=>$node)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{ $index }}" aria-expanded="false"
                                aria-controls="flush-collapse{{ $index }}">
                                {{ $node->name }}
                            </button>
                        </h2>
                        @foreach ($node->childs as $child)
                        <div id="flush-collapse{{ $index }}" class="accordion-collapse collapse"
                            aria-labelledby="flush-heading{{ $index }}" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body" style="cursor: pointer"
                                onclick="window.open('{{ $child->url_file }}', '_blank')">{{ $child->name }}</div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                @endif

            </article>
        </div>
    </div>
</div>
@endsection
