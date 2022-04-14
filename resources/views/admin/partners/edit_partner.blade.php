@extends('layouts.admin_layout')
@section('title', 'Editar Partner')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Partners</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/partners') }}">Partners</a></li>
                        <li class="breadcrumb-item active">Editar Partners</li>
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
                            <h3 class="card-title">Editar Partner</h3>
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
                            action="{{ route('dashboard.partner.edit',$partnerDetail['id'])}}" name="updatePartner"
                            id="updatePartner" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre Partner</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="partnerName" name="partnerName" value="{{$partnerDetail['name']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Logo</label>
                                    <input type="file" class="form-control" name="partnerLogo" id="partnerLogo"
                                        onchange="preview_image(event)">
                                    <br>
                                    <img class="img-fluid" style="margin-top: 10px;" width="300" id="output_image"
                                        src="{{$partnerDetail['logo']}}" />
                                    <input type="hidden" name="currentPartnerLogo" value="{{$partnerDetail['logo']}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">URL</label>
                                    <input type="text" class="form-control" id="partnerUrl" name="partnerUrl"
                                        value="{{$partnerDetail['url']}}" placeholder="Ingrese URL">
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
