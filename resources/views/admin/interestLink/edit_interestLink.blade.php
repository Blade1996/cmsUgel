@extends('layouts.admin_layout')
@section('title', 'Editar Menu Navegacion')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Enlace de Interes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.links.index') }}">Enlace de Interes</a>
                        </li>
                        <li class="breadcrumb-item active">Editar Enlace</li>
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
                            <h3 class="card-title">Editar Enlace</h3>
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
                        <form role="form" method="post" action="{{ route('dashboard.links.edit', $linkDetail['id'])}}"
                            name="addSection" id="addSection" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titulo de Link</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Titulo" id="titleLink"
                                        name="titleLink" value="{{$linkDetail['title']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link de Redireccion</label>
                                    <input type="text" class="form-control" id="redirectLink" name="redirectLink"
                                        placeholder="Ingrese Link" value="{{$linkDetail['url_redirect']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Icono</label>
                                    <input type="file" name="iconLink" id="iconLink" onchange="preview_image(event)">
                                    <br>
                                    <img class="img-fluid" style="margin-top: 10px;" width="300" id="output_image"
                                        src="{{$linkDetail['url_icon']}}" />
                                    <input type="hidden" name="currentIconLink" value="{{$linkDetail['url_icon']}}">
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
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
@endsection
