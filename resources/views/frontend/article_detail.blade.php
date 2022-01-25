@extends('frontend.layouts.home_layout')
@section('title', $articleDetail->title )
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{ $articleDetail->title }}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Publicado el {{ $articleDetail->created_at }}</div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">etiqueta</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">etiqueta</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded"
                        src="{{ $articleDetail->page_image }}" alt="..."></figure>
                <!-- Post content-->
                <section class="mb-5">
                   {!!$articleDetail->content!!}
                </section>
            </article>

        </div>
    </div>
</div>
@endsection