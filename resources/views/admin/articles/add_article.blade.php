@extends('layouts.admin_layout')
@section('title', 'Crear Articulo')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Articulos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.articles.index') }}">Artículos</a></li>
                        <li class="breadcrumb-item active">Agregar Artículo</li>
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
                    <h3 class="card-title">Agregar Artículo</h3>
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
                    <form method="post" action="{{ route('dashboard.articles.create')}}" name="createArticle"
                        id="createArticle" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seleccione Sección</label>
                                    <select name="categoryId" id="categoryId" class="form-control" style="width: 100%;">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->titulo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="form-check-input">Tipo de Contenido</label>
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="internal"
                                                value="internal" checked>
                                            Enlace Interno
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="external"
                                                value="external">
                                            Enlace Externo
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="pdf"
                                                value="pdf">
                                            Archivo PDF
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="tree"
                                                value="tree">
                                            Arbol de Documentos
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group" id="checkCaption" style="display: none">
                                    <input type="checkbox" name="showCaption" id="showCaption">
                                    <label for="showCaption">Mostrar Texto en Slider</label>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen para Slider</label>
                                    <input type="file" class="form-control" onchange="preview_image3(event)"
                                        name="sliderImage" id="sliderImage">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image3" />
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="articleTitle"
                                        placeholder="Ingrese Titulo">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Subtítulo</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        name="articleSubTitle" placeholder="Ingrese Subtitulo">
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Resumen de Artículo</label>
                                    <textarea class="form-control" name="articleResume" id="articleResume"
                                        placeholder="Ingrese Resumen"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">URL de Video</label>
                                    <input type="url" class="form-control" name="articleUrlVideo" id="articleUrlVideo">
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen de Articulo</label>
                                    <input type="file" class="form-control" onchange="preview_image(event)"
                                        name="articleImage" id="articleImage">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image" />
                                </div>
                                <div class="form-group" id="imgSlider" style="display: none">
                                    <label for="exampleInputFile">Imagen de Articulo</label>
                                    <input type="file" class="form-control" onchange="preview_image_2(event)"
                                        name="sliderImage" id="sliderImage">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image_2" />
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
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                </div>
                                <div class="form-group" id="articleFileContent" style="display: none">
                                    <label for="exampleInputFile">Subir Archivo</label>
                                    <input type="file" class="form-control" name="articleFile" id="articleFile">
                                </div>
                                <div class="form-group" id="articleUrlContent" style="display: none">
                                    <label for="exampleInputEmail1">Link Texto</label>
                                    <input type="text" class="form-control" id="articleTextLink" name="articleTextLink"
                                        placeholder="Ingrese Texto Link">
                                </div>
                                <div class="form-group" id="selectTree" style="display: none">
                                    <label>Seleccione Arbol</label>
                                    <select name="treeId" id="treeId" class="form-control" style="width: 100%;">
                                        @foreach ($trees as $id=>$tree)
                                        <option value="{{ $id }}">{{ $tree }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Título para SEO</label>
                            <input type="text" class="form-control" placeholder="Ingrese Titulo" id="articleSeoTitle"
                                name="articleSeoTitle">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción para SEO</label>
                            <textarea class="form-control" name="articleSeoDescription" id="articleSeoDescription"
                                placeholder="Ingrese Descripcion"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Insertar Imagen para SEO</label>
                            <input type="file" class="form-control" onchange="preview_image2(event)"
                                name="articleSeoImage" id="articleSeoImage">
                            <img style="margin-top: 10px;" class="img-fluid" id="output_image2" />
                        </div> --}}
                </div>

                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Publicar" class="btn btn-info">
                    </div>
                </div>
                </form>
                <!-- /.row -->

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </section>



    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image');
            output.src = reader.result;
            output.width = 400;
            output.height = 300

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
            output.height = 300

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
