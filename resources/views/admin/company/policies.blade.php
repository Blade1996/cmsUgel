@extends('layouts.admin_layout')
@section('title', 'Politicas')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
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
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Políticas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Políticas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{$companyPolicies->helpCenter->title}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
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
                    <form method="post" action="{{ route('dashboard.policies', 'helpCenter')}}" name="createArticle"
                        id="createArticle" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="helpCenterTitle" name="helpCenterTitle"
                                        value="{{$companyPolicies->helpCenter->title}}" placeholder="Ingrese Titulo">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control" name="helpCenterDescription"
                                        id="helpCenterDescription" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$companyPolicies->helpCenter->description}}</textarea>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Términos y Condiciones Registro</label>
                                    <textarea class="form-control " name="beforeRegister" id="beforeRegister"
                                        placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$companyPolicies->beforeRegister}}</textarea>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        <div class="form-group">
                            <label for="exampleInputEmail1">Título para SEO</label>
                            <input type="text" class="form-control" placeholder="Ingrese Titulo" id="helpCenterSeoTitle"
                                name="helpCenterSeoTitle" value="{{$companyPolicies->helpCenter->seoTitle}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción para SEO</label>
                            <textarea class="form-control" name="helpCenterSeoDescription" id="helpCenterSeoDescription"
                                placeholder="Ingrese Descripcion"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$companyPolicies->helpCenter->seoDescription}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Insertar Imagen para SEO</label>
                            <input type="file" class="form-control" onchange="preview_image(event)"
                                name="helpCenterSeoImage" id="helpCenterSeoImage">
                            <img class="img-fluid" style="margin-top: 10px;" width="400" id="output_image"
                                src="{{$companyPolicies->helpCenter->seoImage}}" />
                            <input type="hidden" name="currenthelpCenterSeoImage"
                                value="{{$companyPolicies->helpCenter->seoImage}}">
                        </div>
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Guardar Configuracion" class="btn btn-info">
                    </div>
                </div>
                </form>
                <!-- /.row -->

            </div>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">{{$companyPolicies->cookiePolicy->title}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
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
                    <form method="post" action="{{  route('dashboard.policies', 'cookiePolicy')}}" name="createArticle"
                        id="createArticle" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="cookiePolicyTitle"
                                        name="cookiePolicyTitle" value="{{$companyPolicies->cookiePolicy->title}}"
                                        placeholder="Ingrese Titulo">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control" name="cookiePolicyDescription"
                                        id="cookiePolicyDescription" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$companyPolicies->cookiePolicy->description}}</textarea>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->

                        <div class="form-group">
                            <label for="exampleInputEmail1">Título para SEO</label>
                            <input type="text" class="form-control" placeholder="Ingrese Titulo"
                                id="cookiePolicySeoTitle" name="cookiePolicySeoTitle"
                                value="{{$companyPolicies->cookiePolicy->seoTitle}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción para SEO</label>
                            <textarea class="form-control" name="cookiePolicySeoDescription"
                                id="cookiePolicySeoDescription" placeholder="Ingrese Descripcion"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$companyPolicies->cookiePolicy->seoDescription}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Insertar Imagen para SEO</label>
                            <input type="file" class="form-control" onchange="preview_image2(event)"
                                name="cookiePolicySeoImage" id="cookiePolicySeoImage">
                            <img class="img-fluid" style="margin-top: 10px;" width="400" id="output_image2"
                                src="{{$companyPolicies->cookiePolicy->seoImage}}" />
                            <input type="hidden" name="currentcookiePolicySeoImage"
                                value="{{$companyPolicies->cookiePolicy->seoImage}}">
                        </div>
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Guardar Configuración" class="btn btn-info">
                    </div>
                </div>
                </form>
                <!-- /.row -->

            </div>
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">{{$companyPolicies->privacyPolicy->title}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
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
                    <form method="post" action="{{ route('dashboard.policies', 'privacyPolicy')}}" name="createArticle"
                        id="createArticle" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="privacyPolicyTitle"
                                        name="privacyPolicyTitle" value="{{$companyPolicies->privacyPolicy->title}}"
                                        placeholder="Ingrese Titulo">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control" name="privacyPolicyDescription"
                                        id="privacyPolicyDescription" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$companyPolicies->privacyPolicy->description}}</textarea>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->

                        <div class="form-group">
                            <label for="exampleInputEmail1">Título para SEO</label>
                            <input type="text" class="form-control" placeholder="Ingrese Titulo"
                                id="privacyPolicySeoTitle" name="privacyPolicySeoTitle"
                                value="{{$companyPolicies->privacyPolicy->seoTitle}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción para SEO</label>
                            <textarea class="form-control" name="privacyPolicySeoDescription"
                                id="privacyPolicySeoDescription" placeholder="Ingrese Descripcion"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$companyPolicies->privacyPolicy->seoDescription}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Insertar Imagen para SEO</label>
                            <input type="file" class="form-control" onchange="preview_image3(event)"
                                name="privacyPolicySeoImage" id="privacyPolicySeoImage">
                            <img class="img-fluid" style="margin-top: 10px;" width="400" id="output_image3"
                                src="{{$companyPolicies->privacyPolicy->seoImage}}" />
                            <input type="hidden" name="currentprivacyPolicySeoImage"
                                value="{{$companyPolicies->privacyPolicy->seoImage}}">
                        </div>
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Guardar Configuración" class="btn btn-info">
                    </div>
                </div>
                </form>
                <!-- /.row -->

            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
    <script>
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

    function preview_image2(event)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
        var output = document.getElementById('output_image2');
        output.src = reader.result;
        output.width = 400;
        output.width = 300

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
        output.width = 300

        }
        reader.readAsDataURL(event.target.files[0]);
    }
    function preview_image4(event)
    {
        var reader = new FileReader();
        reader.onload = function()
        {
        var output = document.getElementById('output_image4');
        output.src = reader.result;
        output.width = 400;
        output.width = 300

        }
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
</div>
@endsection
