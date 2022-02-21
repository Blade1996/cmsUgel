@extends('layouts.admin_layout')
@section('title', 'Editar Anuncio')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Anuncios</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('dashboard/sections') }}">Anuncios</a></li>
                        <li class="breadcrumb-item active">Editar Anuncios</li>
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
                            <h3 class="card-title">Editar Anuncio</h3>
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
                            action="{{ route('dashboard.advertisements.edit', $advertisementDetail['id'] )}}"
                            name="updateDocument" id="updateDocument" enctype="multipart/form-data">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Titulo Documento</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="advertisementTitle" name="advertisementTitle"
                                        value="{{ $advertisementDetail['titulo'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control textAreaEditor" rows="3"
                                        name="advertisementDescription" id="advertisementDescription"
                                        placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{!! $advertisementDetail['descripcion'] !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Titulo1</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="advertisementTitle1" name="advertisementTitle1">
                                    <input type="file" class="form-control" name="advertisementFile1"
                                        id="advertisementFile1" value="{{ $advertisementDetail['titulo1'] }}">
                                    <input type="hidden" class="form-control" name="currentAdvertisementFile1"
                                        id="currentAdvertisementFile1" value="{{ $advertisementDetail['archivo1'] }}">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Titulo2</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="advertisementTitle2" name="advertisementTitle2"
                                        value="{{ $advertisementDetail['titulo2'] }}">
                                    <input type="file" class="form-control" name="advertisementFile2"
                                        id="advertisementFile2">
                                    <input type="hidden" class="form-control" name="currentAdvertisementFile2"
                                        id="currentAdvertisementFile2" value="{{ $advertisementDetail['archivo2'] }}">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Titulo3</label>
                                    <input type="text" class="form-control" placeholder="Ingrese Nombre"
                                        id="advertisementTitle3" name="advertisementTitle3"
                                        value="{{ $advertisementDetail['titulo3'] }}">
                                    <input type="file" class="form-control" name="advertisementFile3"
                                        id="advertisementFile3">
                                    <input type="hidden" class="form-control" name="currentAdvertisementFile3"
                                        id="currentAdvertisementFile3" value="{{ $advertisementDetail['archivo3'] }}">


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
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
      var uploadedDocumentMap = {}
      Dropzone.options.documentDropzone = {
         url: '{{ route('documents.storeMedia') }}',
         maxFilesize: 15, // MB
         addRemoveLinks: true,
         acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
         headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
         },
         success: function(file, response) {
            $('form').append('<input type="hidden" name="files[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
         },
         removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
               name = file.file_name
            } else {
               name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="files[]"][value="' + name + '"]').remove()
         },
         init: function() {
            @if (isset($files))
               var files =
               {!! json_encode($files) !!}
               for (var i in files) {
               var file = files[i]
               console.log(file);
               file = {
               ...file,
               width: 226,
               height: 324
               }
               this.options.addedfile.call(this, file)
               this.options.thumbnail.call(this, file,'https://firebasestorage.googleapis.com/v0/b/url-short-286413.appspot.com/o/pdf-128.png?alt=media&token=2c85269d-2f5b-4c86-9400-4f1a1c65927d')
               file.previewElement.classList.add('dz-complete')

               $('form').append('<input type="hidden" name="files[]" value="' + file.file_name + '">')
               }
            @endif
         }
      }
</script>
@endsection
