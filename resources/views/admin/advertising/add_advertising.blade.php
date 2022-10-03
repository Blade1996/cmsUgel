@extends('layouts.admin_layout')
@section('title', 'Agregar Publicidad')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Publicidad</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('dashboard.advertisements.index') }}">Publicidad</a>
                        </li>
                        <li class="breadcrumb-item active">Agregar Publicidad</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Publicidad</h3>
                        </div>
                        <!-- /.card-header -->

                        @if ($errors->any())
                        <div class="alert alert-danger" style="margin-top: 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('dashboard.advertising.create')}}"
                            name="addSection" id="addSection" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Seleccione Categoria</label>
                                    <select name="categoryId" id="categoryId" class="form-control">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->descripcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titulo Publicidad</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="advertisingTitle" name="advertisingTitle">
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
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group" id="areaArticleContent">
                                            <label for="exampleInputEmail1">Descripci��n</label>
                                            <textarea class="form-control textAreaEditor" name="advertisingContent"
                                                id="advertisingContent" placeholder="Ingrese Descripcion"
                                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                        </div>
                                        <div class="form-group" id="articleFileContent" style="display: none">
                                            <label for="exampleInputFile">Subir Archivo</label>
                                            <input type="file" class="form-control" name="advertisingFile"
                                                id="advertisingFile">
                                        </div>
                                        <div class="form-group" id="articleUrlContent" style="display: none">
                                            <label for="exampleInputEmail1">Link Texto</label>
                                            <input type="text" class="form-control" id="advertisingRedirect"
                                                name="advertisingRedirect" placeholder="Ingrese Texto Link">
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
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen de Publicidad</label>
                                    <input type="file" class="form-control" onchange="preview_image(event)"
                                        name="advertisingImage" id="advertisingImage">
                                    <img style="margin-top: 10px; height: 500px" class="img-fluid" id="output_image" />
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
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
</script>
@endsection
