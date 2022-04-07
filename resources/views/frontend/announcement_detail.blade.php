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
                <section class="mb-5">
                    {!!$announcementDetail->descripcion !!}
                </section>

                <input type="hidden" id="countFiles" value="{{ $announcementDetail->getMedia($files)->count() }}">
                @foreach ($announcementDetail->getMedia($files) as $index=>$file)
                <input type="hidden" name="filePdf" id="base{{ $index }}" value="{{ $file->getUrl() }}">
                <section class="mb-5">
                    <h2>{{ $file->name }}</h2>
                    <div id="pdf-file-{{ $index }}" style="margin: 30px"></div>
                </section>
                @endforeach
            </article>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.js"></script>
<script>
    let countFiles = document.getElementById('countFiles').value;
    for(let i = 0; i < countFiles; i++){
        let urlBase = document.getElementById(`base${i}`).value;
        PDFObject.embed(urlBase, `#pdf-file-${i}`, {height: "30rem", width: "120%"});
    }
</script>
@endsection
