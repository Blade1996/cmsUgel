@extends('frontend.layouts.home_layout')
@section('title', $announcementDetail->title )
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{ $announcementDetail->title }}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Publicado el {{ $announcementDetail->created_at }}</div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">etiqueta</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">etiqueta</a>
                </header>
                <!-- Preview image figure-->
                <!-- Post content-->
                <section class="mb-5">
                    {!!$announcementDetail->description !!}
                </section>
                <section class="mb-5">
                    @php
                    $documents_urls = [];
                    @endphp
                    @foreach ($announcementDetail->getMedia($files) as $key=>$media)
                    <div id="document-{{ $key }}" style="margin: 30px"></div>
                    @php
                    array_push($documents_urls, $media->getUrl());
                    @endphp
                    @endforeach
                </section>

            </article>

        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.js"></script>
<script>
    let urls = [];
        urls = <?php echo json_encode($documents_urls); ?>;
        urls.forEach((element, index) => {
            PDFObject.embed(element, `#document-${index}`, {height: "50rem", width: "100rem"});
        });
</script>
@endsection
