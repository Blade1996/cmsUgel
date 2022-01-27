@extends('layouts.admin_layout')
@section('title', 'Editar Partner')
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
                        <form role="form" method="post"
                            action="{{ route('dashboard.section.edit',$sectionDetail['id'])}}" name="updateSection"
                            id="updateSection" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre Sección</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="sectionName" name="sectionName" value="{{$sectionDetail['name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control textAreaEditorSection" rows="3"
                                        name="sectionDescription" id="sectionDescription"
                                        placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{!!$sectionDetail['description']!!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link Texto</label>
                                    <input type="text" class="form-control" id="sectionTextLink" name="sectionTextLink"
                                        value="{{$sectionDetail['text_link']}}" placeholder="Ingrese Texto Link">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Orden Sección</label>
                                    <input type="text" class="form-control"
                                        placeholder="Ingrese Orden en la Barra Navegacion" id="sectionOrder"
                                        name="sectionOrder" value="{{$sectionDetail['order']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Orden en el Home</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Orden para el Home"
                                        id="sectionOrderHome" name="sectionOrderHome"
                                        value="{{$sectionDetail['order_home']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título para SEO</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="sectionSeoTitle" name="sectionSeoTitle"
                                        value="{{$sectionDetail['title_seo']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción para SEO</label>
                                    <textarea class="form-control" rows="3" name="sectionSeoDescription"
                                        id="sectionSeoDescription" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$sectionDetail['content_seo']}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen para SEO</label>
                                    <input type="file" class="form-control" name="sectionSeoImage" id="sectionSeoImage"
                                        onchange="preview_image(event)">
                                    <br>
                                    <img class="img-fluid" style="margin-top: 10px;" width="300" id="output_image"
                                        src="{{$sectionDetail['image_seo ']}}" />
                                    <input type="hidden" name="currentSectionSeoImage"
                                        value="{{$sectionDetail['image_seo']}}">
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
