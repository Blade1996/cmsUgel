@extends('layouts.admin_layout')
@section('title', 'Lista de Documentos')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Secciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Documentos</li>
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
                            <h3 class="card-title">Tabla de Documentos</h3>
                            <a href="{{ route('dashboard.documents.create') }}"
                                style="max-width: 150px; float: right; display:inline-block;"
                                class="btn btn-block btn-success">Agregar Documento</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="sectionsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Titulo</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $document)
                                    <tr>
                                        <td>{{ $document->id }}</td>
                                        <td>{{ $document->title }}</td>
                                        <td>{{ $document->category->name }}</td>
                                        <td>
                                            <a data-toggle="tooltip"
                                                href="{{ route('dashboard.documents.edit', $document->id) }}"
                                                data-toggle="tooltip" title="Editar" title="Editar">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="confirmDelete" style="cursor: pointer;"
                                                record="section" recordId="{{ $document->id }}" data-toggle="tooltip"
                                                title="Eliminar">
                                                <i style="color: red;" class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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