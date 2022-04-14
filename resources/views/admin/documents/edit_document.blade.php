@extends('layouts.admin_layout')
@section('title', 'Editar Documento')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Documentos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/sections') }}">Documentos</a></li>
                        <li class="breadcrumb-item active">Editar Documento</li>
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
                            <h3 class="card-title">Editar Documento</h3>
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
                        <form role="form" method="post"
                            action="{{ route('dashboard.documents.edit', $documentDetail['id'] )}}"
                            name="updateDocument" id="updateDocument" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Seleccione Categoria</label>
                                    <select name="categoryId" id="categoryId" class="form-control" style="width: 100%;">
                                        <option <?php if($documentDetail['category_id']===1) echo 'selected="selected"'
                                            ; ?> value="1">Documentos Generales</option>
                                        <option <?php if($documentDetail['category_id']===2) echo 'selected="selected"'
                                            ; ?> value="2">Convocatorias</option>
                                        <option <?php if($documentDetail['category_id']===3) echo 'selected="selected"'
                                            ; ?> value="3">Normativas</option>
                                    </select>
                                    <input type="hidden" name="currentCategoryId"
                                        value="{{ $documentDetail['category_id'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titulo Documento</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="documentTitle" name="documentTitle" value="{{ $documentDetail['title'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control" rows="3" name="documentDescription"
                                        id="documentDescription" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{!! $documentDetail['description'] !!}</textarea>
                                </div>
                                @if ($documentDetail['id'] == 2)
                                <div class="col-md-6" id="announcement">
                                    <div class="form-group">
                                        <label class="control-label">Bases de Convocatoria</label>
                                        <div class="controls">
                                            <input type="file" name="documentBasis" id="documentBasis"
                                                onchange="preview_image(event)">
                                            <br>
                                            <input type="hidden" name="currentDocumentBasis" id="currentDocumentBasis"
                                                value="{{$documentDetail['url_basis']}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Resultados Evaluacion de CV</label>
                                        <div class="controls">
                                            <input type="file" name="documentResultCV" id="documentResultCV"
                                                onchange="preview_image(event)">
                                            <br>
                                            <input type="hidden" name="currentDocumentResultCV"
                                                id="currentDocumentResultCV" value="{{$documentDetail['result_cv']}}" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Resultado Final</label>
                                        <div class="controls">
                                            <input type="file" name="documentFinalResult" id="documentFinalResult"
                                                onchange="preview_image(event)">
                                            <br>
                                            <input type="hidden" name="currentDocumentFinalResult"
                                                id="currentDocumentFinalResult"
                                                value="{{$documentDetail['result_final']}}" />
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="form-group" id="documentsFile" style="display: none">
                                    <label class="control-label">Subir Archivo</label>
                                    <div class="controls">
                                        <input type="file" name="documentFile" id="documentFile"
                                            onchange="preview_image(event)">
                                        <br>
                                        <input type="hidden" name="currentDocumentFile" id="currentDocumentFile"
                                            value="{{$documentDetail['url_file']}}" />
                                    </div>
                                </div>
                                @endif
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
