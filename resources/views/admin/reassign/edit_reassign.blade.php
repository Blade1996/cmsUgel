@extends('layouts.admin_layout')
@section('title', 'Editar Documento')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reasignacion</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/sections') }}">Reasignacion</a></li>
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
                            action="{{ route('dashboard.reassign.edit', $reassignDetail['id'] )}}" name="updateDocument"
                            id="updateDocument" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Seleccione Categoria</label>
                                    <select name="categoryId" id="categoryId" class="form-control" style="width: 100%;">
                                        <?php echo $categories_drop_down; ?>
                                    </select>
                                    <input type="hidden" name="currentCategoryId"
                                        value="{{ $reassignDetail['category_id'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titulo Documento</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="reassignTitle" name="reassignTitle" value="{{ $reassignDetail['nombre'] }}">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control" rows="3" name="reassignDescription"
                                        id="reassignDescription" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{!! $reassignDetail['description'] !!}</textarea>
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputFile">Ingresar Archivo</label>
                                    <input type="file" class="form-control" name="reassignFile" id="reassignFile">
                                    <input type="hidden" name="currentReassignFile" id="currentReassignFile"
                                        value="{{ $reassignDetail->archivo }}">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
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
