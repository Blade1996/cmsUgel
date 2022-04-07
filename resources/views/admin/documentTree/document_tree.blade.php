@extends('layouts.admin_layout')
@section('title', 'Jerarquia de Documentos')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Covid</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Jerarquias de Documentos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{ Session::get('error_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <!--Elegido-->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabla de Jerarquias de Documentos</h3>
                            <a data-toggle="modal" data-target="#createFormModal"
                                style="max-width: 150px; float: right; display:inline-block;"
                                class="btn btn-block btn-success">Agregar Jerarquia</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="sectionsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Titulo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a data-toggle="tooltip"
                                                href="{{ route('dashboard.edit-category', $category->id) }}"
                                                data-toggle="tooltip" title="Editar" title="Editar">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;"
                                                record="tree" recordId="{{ $category->id }}" data-toggle="tooltip"
                                                title="Eliminar">
                                                <i style="color: red;" class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="fade modal" tabindex="-1" role="dialog" id="createFormModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Crear Arbol</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" id="createFormTree"
                                            action="{{ route('dashboard.add-category') }}" method="POST">@csrf
                                            <div class="form-group">
                                                <label>Nombre:</label>
                                                <input class="form-control" type="text" name="name" id="name">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="createFormTree" class="btn btn-primary">Crear
                                            Arbol</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fade modal" tabindex="-1" role="dialog" id="modalEditNode">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Datos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" id="editFormNode" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label>Nombre:</label>
                                                <input class="form-control" type="text" name="nameNode" id="nameNode">
                                                <input type="hidden" id="nodeToUpd">
                                            </div>
                                            <div class="form-group" id="fileTree">
                                                <label>Archivo:</label>
                                                <input class="form-control" type="file" name="fileNode" id="fileNode">
                                                <input type="hidden" name="urlFileNode" id="urlFileNode">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="editFormNode"
                                            class="btn btn-primary">Modificar</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
