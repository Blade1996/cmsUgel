@extends('layouts.admin_layout')
@section('title', 'Editar Articulo')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Artículos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.articles.index') }}">Artículos</a></li>
                        <li class="breadcrumb-item active">Editar Artículo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Editar Artículo</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger" style="margin-top: 10px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ route('dashboard.articles.edit',$articleDetail->id)}}"
                        name="createArticle" id="createArticle" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seleccione Seccion</label>
                                    <select name="categoryId" id="categoryId" class="form-control select2"
                                        style="width: 100%;">
                                        <?php echo $categories_drop_down; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="articleTitle"
                                        value="{{$articleDetail->titulo}}" placeholder="Ingrese Titulo">
                                </div>
                                <label for="form-check-input">Tipo de Contenido</label>
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="internal"
                                                value="internal" <?php if($articleDetail->tipo == 'internal' ||
                                            $articleDetail->tipo == '')
                                            echo 'checked' ; ?> >
                                            Enlace Interno
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="external"
                                                value="external" <?php if($articleDetail->tipo == 'external' )
                                            echo 'checked' ; ?> >
                                            Enlace Externo
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="pdf"
                                                value="pdf" <?php if($articleDetail->tipo == 'pdf' )
                                            echo 'checked' ; ?> >
                                            Archivo PDF
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="tree"
                                                value="tree" <?php if($articleDetail->tipo == 'tree' )
                                            echo 'checked' ; ?> >
                                            Arbol de Documentos
                                        </label>
                                    </div>
                                </div>
                                @if ($articleDetail->idarticulo_categoria == 11)
                                <div class="form-group" id="checkCaption">
                                    <input type="checkbox" name="showCaption" id="showCaption" <?php
                                        if($articleDetail->show_caption === 1) echo 'checked' ?> >
                                    <label for="showCaption">Mostrar Texto en Slider</label>
                                </div>
                                @endif
                                {{-- <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen para Slider</label>
                                    <input type="file" class="form-control" onchange="preview_image3(event)"
                                        name="sliderImage" id="sliderImage">
                                    <input type="hidden" class="form-control" id="currentSliderImage"
                                        name="currentSliderImage" value="{{$articleDetail->imagen}}"
                                        placeholder="Ingrese Titulo">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image3"
                                        src="{{$articleDetail->imagen }}" />
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Subtítulo</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        name="articleSubTitle" value="{{$articleDetail->subtitle}}"
                                        placeholder="Ingrese Subtitulo">
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Resumen de Artículo</label>
                                    <textarea class="form-control" name="articleResume" id="articleResume"
                                        placeholder="Ingrese Resumen"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$articleDetail->resumen}}</textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Link Texto</label>
                                    <input type="text" class="form-control" id="articleTextLink" name="articleTextLink"
                                        value="{{$articleDetail->text_link}}" placeholder="Ingrese Texto Link">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mostrar en Slide</label>
                                    <div class="form-check">
                                        <input type="checkbox" value="1" name="showSlider" id="showSlider" <?php
                                            if($articleDetail->show_slider == 1) echo 'checked'; ?>>
                                        <label class="form-check-label" for="showSlider">
                                            Mostrar Banner de Articulo en Slider
                                        </label>
                                    </div>
                                </div> --}}
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen</label>
                                    <input type="file" class="form-control" onchange="preview_image(event)"
                                        name="articleImage" id="articleImage">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image" width=300
                                        src="{{asset($articleDetail->imagen)}}" />
                                    <input type="hidden" name="currentArticleImage"
                                        value="{{ $articleDetail->imagen }}">
                                </div>
                                @if ($articleDetail->idarticulo_categoria == 11)
                                <div class="form-group" id="imgSlider">
                                    <label for="exampleInputFile">Imagen para Slider</label>
                                    <input type="file" class="form-control" onchange="preview_image_2(event)"
                                        name="sliderImage" id="sliderImage">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image_2"
                                        src="{{ $articleDetail->imagen_slider }}" />
                                    <input type="hidden" name="currentSliderImage"
                                        value="{{ $articleDetail->imagen_slider }}">
                                </div>

                                @endif
                                <div class="form-group">
                                    <label for="exampleInputEmail1">URL de Video</label>
                                    <input type="url" class="form-control" id="articleUrlVideo" name="articleUrlVideo"
                                        value="{{ $articleDetail->video}}" placeholder="Ingrese URL">
                                    <input type="hidden" name="currentUrlVideo" value="{{ $articleDetail->video }}">
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <h5>Contenido del Articulo</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="areaArticleContent">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control textAreaEditor" name="articleContent"
                                        id="articleContent" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{ $articleDetail->descripcion }}</textarea>
                                </div>
                                <div class="form-group" id="articleFileContent" style="display: none">
                                    <label for="exampleInputFile">Subir Archivo</label>
                                    <input type="file" class="form-control" name="articleFile" id="articleFile">
                                    <input type="hidden" class="form-control" name="currentArticleFile"
                                        id="currentArticleFile" value="{{ $articleDetail->archivo }}">
                                </div>
                                <div class="form-group" id="articleUrlContent" style="display: none">
                                    <label for="exampleInputEmail1">Link Texto</label>
                                    <input type="text" class="form-control" id="articleTextLink" name="articleTextLink"
                                        placeholder="Ingrese Texto Link" value="{{ $articleDetail->redireccion }}">
                                </div>
                                <div class="form-group" id="selectTree" style="display: none">
                                    <label>Seleccione Sección</label>
                                    <select name="treeId" id="treeId" class="form-control" style="width: 100%;">
                                        <?php echo $tree_drop_down; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Título para SEO</label>
                            <input type="text" class="form-control" placeholder="Ingrese Titulo" id="articleSeoTitle"
                                value="{{$articleDetail->title_seo }}" name="articleSeoTitle">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción para SEO</label>
                            <textarea class="form-control" name="articleSeoDescription" id="articleSeoDescription"
                                placeholder="Ingrese Descripcion"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$articleDetail->content_seo }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Insertar Imagen para SEO</label>
                            <input type="file" class="form-control" onchange="preview_image2(event)"
                                name="articleSeoImage" id="articleSeoImage">
                            <img style="margin-top: 10px;" class="img-fluid" id="output_image2" width="400"
                                src="{{$articleDetail->image_seo }}" />
                        </div> --}}
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Actualizar Artículo" class="btn btn-info">
                    </div>
                </div>
                </form>
                <!-- /.row -->

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type='text/javascript'>
    function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image');
            output.src = reader.result;
            output.width = 400;
            output.width = 300

            }
            reader.readAsDataURL(event.target.files[0]);
        }
        function preview_image_2(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image_2');
            output.src = reader.result;
            output.width = 400;
            output.width = 300

            }
            reader.readAsDataURL(event.target.files[0]);
        }
        function preview_image3(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image3');
            output.src = reader.result;
            output.width = 400;
            output.height = 300

            }
            reader.readAsDataURL(event.target.files[0]);
        }
</script>
@endsection
