@extends('frontend.layouts.home_layout')
@section('title', $announcementDetail->nombre )
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{ $announcementDetail->nombre }}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Publicado el {{ $announcementDetail->fecha }}</div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">etiqueta</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">etiqueta</a>
                </header>
                @php
                $document_url = $announcementDetail->archivo;
                $document_eval = $announcementDetail->archivo_eval;
                $document_final = $announcementDetail->archivo_final;
                @endphp
                <input type="hidden" name="filePdf" id="base" value="{{ $announcementDetail->archivo ?? '' }}">
                <input type="hidden" name="filePdf" id="eval" value="{{ $announcementDetail->archivo_eval }}">
                <input type="hidden" name="filePdf" id="final" value="{{ $announcementDetail->archivo_final }}">
                <!-- Preview image figure-->
                <!-- Post content-->
                <section class="mb-5">
                    {!!$announcementDetail->descripcion !!}
                </section>
                @if ($announcementDetail->archivo)
                <section class="mb-5">
                    <h2>Bases</h2>
                    <div id="pdf-file-base" style="margin: 30px"></div>
                </section>
                @endif
                @if ($announcementDetail->archivo_eval)
                <section class="mb-5">
                    <h2>Evaluacion</h2>
                    <div id="pdf-file-eval" style="margin: 30px"></div>
                </section>
                @endif
                @if ($announcementDetail->archivo_final)
                <section class="mb-5">
                    <h2>Final</h2>
                    <div id="pdf-file-final" style="margin: 30px"></div>
                </section>
                @endif
            </article>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.js"></script>
<script>
    let urlBase = document.getElementById('base').value;
    PDFObject.embed(urlBase, `#pdf-file-base`, {height: "30rem", width: "120%"});
    let urlEval = document.getElementById('eval').value;
    PDFObject.embed(urlEval, `#pdf-file-eval`, {height: "30rem", width: "120%"});
    let urlFinal = document.getElementById('final').value;
    PDFObject.embed(urlFinal, `#pdf-file-final`, {height: "30rem", width: "120%"});
</script>
@endsection
