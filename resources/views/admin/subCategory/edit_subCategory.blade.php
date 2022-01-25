@extends('layouts.admin_layout')
@section('title', 'Editar Sub Menu')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Secciones</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/sections') }}">Secciones</a></li>
                        <li class="breadcrumb-item active">Editar Seccion</li>
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
                            <h3 class="card-title">Editar Seccion</h3>
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
                          <form role="form" method="post" action="{{ route('dashboard.subcategories.edit', $subCategoryDetail['id'])}}"
                            name="addSection" id="addSection" enctype="multipart/form-data">@csrf
                               <div class="form-group">
                                    <label>Seleccione Seccion</label>
                                    <select name="sectionId" class="form-control" style="width: 100%;">
                                        <?php echo $section_drop_down; ?>
                                    </select>
                                </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre SubCategoria</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="subcategoryName" name="subcategoryName" value="{{ $subCategoryDetail['name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contenido</label>
                                    <textarea class="form-control textAreaEditorSection" rows="3"
                                        name="subcategoryContent" id="subcategoryContent"
                                        placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{!! $subCategoryDetail['content']!!}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                             <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Editar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
@endsection
