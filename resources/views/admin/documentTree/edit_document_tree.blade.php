@extends('layouts.admin_layout')
@section('title', 'Editar Jerarquia de Documentos')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jerarquia de Documentos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.document-tree.index') }}">Jerarquia
                                de Documentos</a></li>
                        <li class="breadcrumb-item active">Editar Jerarquia de Documentos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Agregar Jerarquia de Documentos</h3>
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
                        <form role="form" method="post" action="{{ route('dashboard.edit-category', $parentId)}}"
                            name="addSection" id="addSection" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Title:</label>
                                    <input type="text" id="title" name="name" value="" class="form-control"
                                        placeholder="Enter Title">
                                    <span class="text-red" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                </div>
                                <input type="hidden" name="parentId" value="{{ $parentId }}">
                                <div class="form-group">
                                    <input type="checkbox" name="isParent" id="isParent"
                                        aria-label="Mostrar Texto en Slide" checked>
                                    <label for="isParent">Es Categoria Padre</label>
                                </div>
                                <div class="form-group" id="fileNode" style="display:none">
                                    <label>Archivo:</label>
                                    <input type="file" class="form-control" onchange="preview_image(event)"
                                        name="fileDocument" id="fileDocument">
                                    <span class="text-red" role="alert">
                                    </span>
                                </div>
                                <div class="form-group" id="parentSelect" style="display: none">
                                    <label>Category:</label>
                                    <select class="form-control" name="parent_id" id="parentId">
                                        <option value="{{ $parentId }}" selected="true">Seleccione</option>
                                        @foreach ($allChilds as $id => $child)
                                        <option value="{{ $id }}">{{ $child }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="accordion md-accordion" id="accordionEx" role="tablist"
                                    aria-multiselectable="true">
                                    @foreach ($treeDetail as $index =>$node )
                                    <div class="card">
                                        <!-- Card header -->
                                        <div class="card-header" role="tab" id="heading{{ $index }}">
                                            <a data-toggle="collapse" data-parent="#accordionEx"
                                                href="#collapse{{ $index }}" aria-expanded="true"
                                                aria-controls="collapse{{ $index }}">
                                                <h5 class="mb-0">
                                                    {{ $node->name }}
                                                    <div class="icons-wrapper" style="float: right">
                                                        <i data-toggle="modal" id="editHead"
                                                            data-target="#modalEdit{{ $index }}"
                                                            class="icon far fa-edit" data-id="{{ $node->id }}"
                                                            style="height: 15px; width:15px"></i>
                                                        <i style="color: red; height: 15px; width:15px" record="tree"
                                                            recordId="{{ $node->id }}"
                                                            class="icon fas fa-trash-alt confirmDelete"></i>
                                                    </div>
                                                </h5>
                                            </a>
                                        </div>
                                        @foreach ($node->childs as $child)
                                        <div id="collapse{{ $index }}" class="collapse show" role="tabpanel"
                                            aria-labelledby="heading{{ $index }}" data-parent="#accordionEx">
                                            <div class="card-body">
                                                {{ $child->name }}
                                                <div class="icons-wrapper">
                                                    <i data-toggle="modal" id="editNode"
                                                        data-target="#modalEditNode{{ $child->id }}"
                                                        data-id="{{ $child->id }}" class="icon far fa-edit"
                                                        style="height: 15px; width:15px"></i>
                                                    <i style="color: red; height: 15px; width:15px" record="tree"
                                                        recordId="{{ $child->id }}"
                                                        class="icon fas fa-trash-alt confirmDelete"></i>
                                                </div>
                                            </div>
                                            <!-- Card body -->
                                        </div>
                                        <div class="fade modal" tabindex="-1" role="dialog"
                                            id="modalEditNode{{ $child->id }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Editar Datos</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form></form>
                                                        <form role="form" id="editFormNode{{ $child->id }}"
                                                            method="POST"
                                                            action="{{ route('dashboard.edit-tree-node', $child->id) }}"
                                                            enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label>Nombre:</label>
                                                                <input class="form-control" type="text" name="nameNode"
                                                                    id="nameNode" value="{{ $child->name }}">
                                                                <input type="hidden" id="nodeToUpd">
                                                            </div>
                                                            <div class="form-group" id="fileTree">
                                                                <label>Archivo:</label>
                                                                <input class="form-control" type="file" name="fileNode"
                                                                    id="fileNode">
                                                                <input type="hidden" name="currentFile" id="currentFile"
                                                                    value="{{ $child->url_file }}">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button form="editFormNode{{ $child->id }}"
                                                            class="btn btn-primary editNode">Modificar</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- Accordion card -->
                                        <!-- Accordion card -->
                                    </div>
                                    <div class="fade modal" tabindex="-1" role="dialog" id="modalEdit{{ $index }}">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form role="form" method="POST"
                                                        action="{{ route('dashboard.edit-tree-header', $node->id) }}"
                                                        id="editFormHeader{{ $index }}">
                                                        <div class="form-group">
                                                            <label>Nombre:</label>
                                                            <input class="form-control" type="text" name="nameHeader"
                                                                id="nameHeader" value="{{ $node->name }}">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button form="editFormHeader{{ $index }}"
                                                        class="btn btn-primary editHeader">Modificar</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach
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
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<script src="{{asset('js/treeView.js')}}"></script>
@endsection
@section('css')
<script src="{{asset('css/treeView.css')}}"></script>
@endsection
