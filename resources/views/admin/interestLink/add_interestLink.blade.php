@extends('layouts.admin_layout')
@section('title', 'Crear Enlace')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Enlaces</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.link.index') }}">Enlaces</a></li>
                        <li class="breadcrumb-item active">Agregar Enlace</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Agregar Enlace</h3>
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
                    <form method="post" action="{{ route('dashboard.link.create')}}" name="createArticle"
                        id="createArticle" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="form-check-input">Tipo de Contenido</label>
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="internal"
                                                value="internal" checked>
                                            Enlace Interno
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="external"
                                                value="external">
                                            Enlace Externo
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="pdf"
                                                value="pdf">
                                            Archivo PDF
                                        </label>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Seleccione Icono</label>
                                    <select name="iconClass" id="iconClass" class="form-control select2"
                                        style="width: 100%;">
                                        <option value='fa-address-book'>&#xf2b9; fa-address-book </option>
                                        <option value='fa-address-book-o'>&#xf2ba; fa-address-book-o </option>
                                        <option value='fa-address-card'>&#xf2bb; fa-address-card </option>
                                        <option value='fa-address-card-o'>&#xf2bc; fa-address-card-o </option>
                                        <option value='fa-adjust'>&#xf042; fa-adjust </option>
                                        <option value='fa-adn'>&#xf170; fa-and </option>
                                        <option value='fa-align-center'>&#xf037; fa-align-center </option>
                                        <option value='fa-align-justify'>&#xf039; fa-align-justify </option>
                                        <option value='fa-align-left'>&#xf036; fa-align-left </option>
                                        <option value='fa-align-right'>&#xf038; fa-align-right </option>
                                        <option value='fa-amazon'>&#xf270; fa-amazon </option>
                                        <option value='fa-toggle-down'>&#xf150; fa-toggle-down </option>
                                        <option value='fa-toggle-left'>&#xf191; fa-toggle-left </option>
                                        <option value='fa-toggle-off'>&#xf204; fa-toggle-off </option>
                                        <option value='fa-toggle-on'>&#xf205; fa-toggle-on </option>
                                        <option value='fa-toggle-right'>&#xf152; fa-toggle-right </option>
                                        <option value='fa-toggle-up'>&#xf151; fa-toggle-up </option>
                                        <option value='fa-trademark'>&#xf25c; fa-trademark </option>
                                        <option value='fa-train'>&#xf238; fa-train </option>
                                        <option value='fa-transgender'>&#xf224; fa-transgender </option>
                                        <option value='fa-transgender-alt'>&#xf225; fa-transgender-alt </option>
                                        <option value='fa-trash'>&#xf1f8; fa-trash </option>
                                        <option value='fa-trash-o'>&#xf014; fa-trash-o </option>
                                        <option value='fa-tree'>&#xf1bb; fa-tree </option>
                                        <option value='fa-trello'>&#xf181; fa-trello </option>
                                        <option value='fa-tripadvisor'>&#xf262; fa-tripadvisor </option>
                                        <option value='fa-trophy'>&#xf091; fa-trophy </option>
                                        <option value='fa-truck'>&#xf0d1; fa-truck </option>
                                        <option value='fa-try'>&#xf195; fa-try </option>
                                        <option value='fa-tty'>&#xf1e4; fa-tty </option>
                                        <option value='fa-tumblr'>&#xf173; fa-tumblr </option>
                                        <option value='fa-tumblr-square'>&#xf174; fa-tumblr-square </option>
                                        <option value='fa-turkish-lira'>&#xf195; fa-turkish-lira </option>
                                        <option value='fa-tv'>&#xf26c; fa-tv </option>
                                        <option value='fa-twitch'>&#xf1e8; fa-twitch </option>
                                        <option value='fa-twitter'>&#xf099; fa-twitter </option>
                                        <option value='fa-twitter-square'>&#xf081; fa-twitter-square </option>
                                        <option value='fa-umbrella'>&#xf0e9; fa-umbrella </option>
                                        <option value='fa-underline'>&#xf0cd; fa-underline </option>
                                        <option value='fa-undo'>&#xf0e2; fa-undo </option>
                                        <option value='fa-universal-access'>&#xf29a; fa-universal-access </option>
                                        <option value='fa-university'>&#xf19c; fa-university </option>
                                        <option value='fa-unlink'>&#xf127; fa-unlink </option>
                                        <option value='fa-unlock'>&#xf09c; fa-unlock </option>
                                        <option value='fa-unlock-alt'>&#xf13e; fa-unlock-alt </option>
                                        <option value='fa-unsorted'>&#xf0dc; fa-unsorted </option>
                                        <option value='fa-upload'>&#xf093; fa-upload </option>
                                        <option value='fa-usb'>&#xf287; fa-usb </option>
                                        <option value='fa-usd'>&#xf155; fa-usd </option>
                                        <option value='fa-user'>&#xf007; fa-user </option>
                                        <option value='fa-user-circle'>&#xf2bd; fa-user-circle </option>
                                        <option value='fa-user-circle-o'>&#xf2be; fa-user-circle-o </option>
                                        <option value='fa-user-md'>&#xf0f0; fa-user-md </option>
                                        <option value='fa-user-o'>&#xf2c0; fa-user-o </option>
                                        <option value='fa-user-plus'>&#xf234; fa-user-plus </option>
                                        <option value='fa-user-secret'>&#xf21b; fa-user-secret </option>
                                        <option value='fa-user-times'>&#xf235; fa-user-times </option>
                                        <option value='fa-users'>&#xf0c0; fa-users </option>
                                        <option value='fa-vcard'>&#xf2bb; fa-vcard </option>
                                        <option value='fa-vcard-o'>&#xf2bc; fa-vcard-o </option>
                                        <option value='fa-venus'>&#xf221; fa-venus </option>
                                        <option value='fa-venus-double'>&#xf226; fa-venus-double </option>
                                        <option value='fa-venus-mars'>&#xf228; fa-venus-mars </option>
                                        <option value='fa-viacoin'>&#xf237; fa-viacoin </option>
                                        <option value='fa-viadeo'>&#xf2a9; fa-viadeo </option>
                                        <option value='fa-viadeo-square'>&#xf2aa; fa-viadeo-square </option>
                                        <option value='fa-video-camera'>&#xf03d; fa-video-camera </option>
                                        <option value='fa-vimeo'>&#xf27d; fa-vimeo </option>
                                        <option value='fa-vimeo-square'>&#xf194; fa-vimeo-square </option>
                                        <option value='fa-vine'>&#xf1ca; fa-vine </option>
                                        <option value='fa-vk'>&#xf189; fa-vk </option>
                                        <option value='fa-volume-control-phone'>&#xf2a0; fa-volume-control-phone
                                        </option>
                                        <option value='fa-volume-down'>&#xf027; fa-volume-down </option>
                                        <option value='fa-volume-off'>&#xf026; fa-volume-off </option>
                                        <option value='fa-volume-up'>&#xf028; fa-volume-up </option>
                                        <option value='fa-warning'>&#xf071; fa-warning </option>
                                        <option value='fa-wechat'>&#xf1d7; fa-wechat </option>
                                        <option value='fa-weibo'>&#xf18a; fa-weibo </option>
                                        <option value='fa-weixin'>&#xf1d7; fa-weixin </option>
                                        <option value='fa-whatsapp'>&#xf232; fa-whatsapp </option>
                                        <option value='fa-wheelchair'>&#xf193; fa-wheelchair </option>
                                        <option value='fa-wheelchair-alt'>&#xf29b; fa-wheelchair-alt </option>
                                        <option value='fa-wifi'>&#xf1eb; fa-wifi </option>
                                        <option value='fa-wikipedia-w'>&#xf266; fa-wikipedia-w </option>
                                        <option value='fa-window-close'>&#xf2d3; fa-window-close </option>
                                        <option value='fa-window-close-o'>&#xf2d4; fa-window-close-o </option>
                                        <option value='fa-window-maximize'>&#xf2d0; fa-window-maximize </option>
                                        <option value='fa-window-minimize'>&#xf2d1; fa-window-minimize </option>
                                        <option value='fa-window-restore'>&#xf2d2; fa-window-restore </option>
                                        <option value='fa-windows'>&#xf17a; fa-windows </option>
                                        <option value='fa-won'>&#xf159; fa-won </option>
                                        <option value='fa-wordpress'>&#xf19a; fa-wordpress </option>
                                        <option value='fa-wpbeginner'>&#xf297; fa-wpbeginner </option>
                                        <option value='fa-wpexplorer'>&#xf2de; fa-wpexplorer </option>
                                        <option value='fa-wpforms'>&#xf298; fa-wpforms </option>
                                        <option value='fa-wrench'>&#xf0ad; fa-wrench </option>
                                        <option value='fa-xing'>&#xf168; fa-xing </option>
                                        <option value='fa-xing-square'>&#xf169; fa-xing-square </option>
                                        <option value='fa-y-combinator'>&#xf23b; fa-y-combinator </option>
                                        <option value='fa-y-combinator-square'>&#xf1d4; fa-y-combinator-square </option>
                                        <option value='fa-yahoo'>&#xf19e; fa-yahoo </option>
                                        <option value='fa-yc'>&#xf23b; fa-yc </option>
                                        <option value='fa-yc-square'>&#xf1d4; fa-yc-square </option>
                                        <option value='fa-yelp'>&#xf1e9; fa-yelp </option>
                                        <option value='fa-yen'>&#xf157; fa-yen </option>
                                        <option value='fa-yoast'>&#xf2b1; fa-yoast </option>
                                        <option value='fa-youtube'>&#xf167; fa-youtube </option>
                                        <option value='fa-youtube-play'>&#xf16a; fa-youtube-play </option>
                                        <option value='fa-youtube-square'>&#xf166; fa-youtube-square </option>
                                    </select>
                                </div>
                                {{-- <div class="form-group" id="selectSub" style="display: none">
                                    <label>Seleccione Sub Cateogoria</label>
                                    <select name="subCategoryId" id="subCategoryId" class="form-control select2"
                                        style="width: 100%;">
                                    </select>
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen para Slider</label>
                                    <input type="file" class="form-control" onchange="preview_image3(event)"
                                        name="sliderImage" id="sliderImage">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image3" />
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="articleTitle"
                                        placeholder="Ingrese Titulo">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Subtítulo</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        name="articleSubTitle" placeholder="Ingrese Subtitulo">
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Resumen de Enlace</label>
                                    <textarea class="form-control" name="articleResume" id="articleResume"
                                        placeholder="Ingrese Resumen"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">URL de Video</label>
                                    <input type="url" class="form-control" idlinkType </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen de Articulo</label>
                                    <input type="file" class="form-control" onchange="preview_image(event)"
                                        name="articleImage" id="articleImage">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image" />
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>

                        <h5>Contenido del Articulo</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="areaArticleContent">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control textAreaEditor" name="articleContent"
                                        id="articleContent" placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                </div>
                                <div class="form-group" id="articleFileContent" style="display: none">
                                    <label for="exampleInputFile">Subir Archivo</label>
                                    <input type="file" class="form-control" name="articleFile" id="articleFile">
                                </div>
                                <div class="form-group" id="articleUrlContent" style="display: none">
                                    <label for="exampleInputEmail1">Link Texto</label>
                                    <input type="text" class="form-control" id="articleTextLink" name="articleTextLink"
                                        placeholder="Ingrese Texto Link">
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->

                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Título para SEO</label>
                            <input type="text" class="form-control" placeholder="Ingrese Titulo" id="articleSeoTitle"
                                name="articleSeoTitle">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción para SEO</label>
                            <textarea class="form-control" name="articleSeoDescription" id="articleSeoDescription"
                                placeholder="Ingrese Descripcion"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Insertar Imagen para SEO</label>
                            <input type="file" class="form-control" onchange="preview_image2(event)"
                                name="articleSeoImage" id="articleSeoImage">
                            <img style="margin-top: 10px;" class="img-fluid" id="output_image2" />
                        </div> --}}
                </div>

                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Publicar" class="btn btn-info">
                    </div>
                </div>
                </form>
                <!-- /.row -->

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </section>



    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    function preview_image(event)
        {
            var reader = new FileReader();
            reader.onload = function()
            {
            var output = document.getElementById('output_image');
            output.src = reader.result;
            output.width = 400;
            output.height = 300

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
            output.height = 300

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
            output.height = 300

            }
            reader.readAsDataURL(event.target.files[0]);
        }
</script>
@endsection
