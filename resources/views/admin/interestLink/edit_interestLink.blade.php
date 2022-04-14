@extends('layouts.admin_layout')
@section('title', 'Editar Enlace')
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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.link.index') }}">Enlaces</a></li>
                        <li class="breadcrumb-item active">Editar Enlace</li>
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
                    <h3 class="card-title">Editar Enlace</h3>
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
                    <form method="post" action="{{ route('dashboard.link.edit',$linkDetail->id)}}" name="createArticle"
                        id="createArticle" enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Seleccione Seccion</label>
                                    <select name="categoryId" id="categoryId" class="form-control select2"
                                        style="width: 100%;">
                                        <?php echo $categories_drop_down; ?>
                                    </select>
                                </div>
                                <label for="form-check-input">Tipo de Contenido</label>
                                <div class="form-group">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="internal"
                                                value="internal" <?php if($linkDetail->tipo == 'internal' ||
                                            $linkDetail->tipo == '')
                                            echo 'checked' ; ?> >
                                            Enlace Interno
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="external"
                                                value="external" <?php if($linkDetail->tipo == 'external' )
                                            echo 'checked' ; ?> >
                                            Enlace Enterno
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="pdf"
                                                value="pdf" <?php if($linkDetail->tipo == 'pdf' )
                                            echo 'checked' ; ?> >
                                            Archivo PDF
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="typelink" id="tree"
                                                value="tree" <?php if($linkDetail->tipo == 'tree' )
                                            echo 'checked' ; ?> >
                                            Arbol de Documentos
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Seleccione Icono</label>
                                    <select name="iconClass" id="iconClass" class="form-control select2"
                                        style="width: 100%;">
                                        <option <?php if($linkDetail->icon_class=='fa-address-book' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-address-book'>&#xf2b9; fa-address-book </option>
                                        <option <?php if($linkDetail->icon_class=='fa-address-book' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-address-book-o'>&#xf2ba; fa-address-book-o </option>
                                        <option <?php if($linkDetail->icon_class=='fa-address-card' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-address-card'>&#xf2bb; fa-address-card </option>
                                        <option <?php if($linkDetail->icon_class=='fa-address-card' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-address-card-o'>&#xf2bc; fa-address-card-o </option>
                                        <option <?php if($linkDetail->icon_class=='fa-adjust' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-adjust'>&#xf042; fa-adjust </option>
                                        <option <?php if($linkDetail->icon_class=='fa-adn' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-adn'>&#xf170; fa-and </option>
                                        <option <?php if($linkDetail->icon_class=='fa-align-center' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-align-center'>&#xf037; fa-align-center </option>
                                        <option <?php if($linkDetail->icon_class=='fa-align-justify' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-align-justify'>&#xf039; fa-align-justify </option>
                                        <option <?php if($linkDetail->icon_class=='fa-align-left' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-align-left'>&#xf036; fa-align-left </option>
                                        <option <?php if($linkDetail->icon_class=='fa-align-right' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-align-right'>&#xf038; fa-align-right </option>
                                        <option <?php if($linkDetail->icon_class=='fa-amazon' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-amazon'>&#xf270; fa-amazon </option>
                                        <option <?php if($linkDetail->icon_class=='fa-toggle-down' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-toggle-down'>&#xf150; fa-toggle-down </option>
                                        <option <?php if($linkDetail->icon_class=='fa-toggle-left' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-toggle-left'>&#xf191; fa-toggle-left </option>
                                        <option <?php if($linkDetail->icon_class=='fa-toggle-off' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-toggle-off'>&#xf204; fa-toggle-off </option>
                                        <option <?php if($linkDetail->icon_class=='fa-toggle-on' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-toggle-on'>&#xf205; fa-toggle-on </option>
                                        <option <?php if($linkDetail->icon_class=='fa-toggle-right' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-toggle-right'>&#xf152; fa-toggle-right </option>
                                        <option <?php if($linkDetail->icon_class=='fa-toggle-up' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-toggle-up'>&#xf151; fa-toggle-up </option>
                                        <option <?php if($linkDetail->icon_class=='fa-trademark' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-trademark'>&#xf25c; fa-trademark </option>
                                        <option <?php if($linkDetail->icon_class=='fa-train' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-train'>&#xf238; fa-train </option>
                                        <option <?php if($linkDetail->icon_class=='fa-transgender' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-transgender'>&#xf224; fa-transgender </option>
                                        <option <?php if($linkDetail->icon_class=='fa-transgender-alt' ) echo
                                            'selected="selected"'
                                            ; ?>
                                            value='fa-transgender-alt'>&#xf225; fa-transgender-alt </option>
                                        <option <?php if($linkDetail->icon_class=='fa-trash' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-trash'>&#xf1f8; fa-trash </option>
                                        <option <?php if($linkDetail->icon_class=='fa-trash-o' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-trash-o'>&#xf014; fa-trash-o </option>
                                        <option <?php if($linkDetail->icon_class=='fa-tree' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-tree'>&#xf1bb; fa-tree </option>
                                        <option <?php if($linkDetail->icon_class=='fa-trello' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-trello'>&#xf181; fa-trello </option>
                                        <option <?php if($linkDetail->icon_class=='fa-tripadvisor' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-tripadvisor'>&#xf262; fa-tripadvisor </option>
                                        <option <?php if($linkDetail->icon_class=='fa-trophy' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-trophy'>&#xf091; fa-trophy </option>
                                        <option <?php if($linkDetail->icon_class=='fa-truck' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-truck'>&#xf0d1; fa-truck </option>
                                        <option <?php if($linkDetail->icon_class=='fa-try' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-try'>&#xf195; fa-try </option>
                                        <option <?php if($linkDetail->icon_class=='fa-tty' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-tty'>&#xf1e4; fa-tty </option>
                                        <option <?php if($linkDetail->icon_class=='fa-tumblr' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-tumblr'>&#xf173; fa-tumblr </option>
                                        <option <?php if($linkDetail->icon_class=='fa-tumblr-square' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-tumblr-square'>&#xf174; fa-tumblr-square </option>
                                        <option <?php if($linkDetail->icon_class=='fa-turkish-lira' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-turkish-lira'>&#xf195; fa-turkish-lira </option>
                                        <option <?php if($linkDetail->icon_class=='fa-tv' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-tv'>&#xf26c; fa-tv </option>
                                        <option <?php if($linkDetail->icon_class=='fa-twitch' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-twitch'>&#xf1e8; fa-twitch </option>
                                        <option <?php if($linkDetail->icon_class=='fa-twitter' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-twitter'>&#xf099; fa-twitter </option>
                                        <option <?php if($linkDetail->icon_class=='fa-twitter-square' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-twitter-square'>&#xf081; fa-twitter-square </option>
                                        <option <?php if($linkDetail->icon_class=='fa-umbrella' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-umbrella'>&#xf0e9; fa-umbrella </option>
                                        <option <?php if($linkDetail->icon_class=='fa-underline' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-underline'>&#xf0cd; fa-underline </option>
                                        <option <?php if($linkDetail->icon_class=='fa-undo' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-undo'>&#xf0e2; fa-undo </option>
                                        <option <?php if($linkDetail->icon_class=='fa-universal-access' ) echo
                                            'selected="selected"'
                                            ; ?>
                                            value='fa-universal-access'>&#xf29a; fa-universal-access </option>
                                        <option <?php if($linkDetail->icon_class=='fa-university' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-university'>&#xf19c; fa-university </option>
                                        <option <?php if($linkDetail->icon_class=='fa-unlink' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-unlink'>&#xf127; fa-unlink </option>
                                        <option <?php if($linkDetail->icon_class=='fa-unlock' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-unlock'>&#xf09c; fa-unlock </option>
                                        <option <?php if($linkDetail->icon_class=='fa-unlock-alt' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-unlock-alt'>&#xf13e; fa-unlock-alt </option>
                                        <option <?php if($linkDetail->icon_class=='fa-unsorted' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-unsorted'>&#xf0dc; fa-unsorted </option>
                                        <option <?php if($linkDetail->icon_class=='fa-upload' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-upload'>&#xf093; fa-upload </option>
                                        <option <?php if($linkDetail->icon_class=='fa-usb' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-usb'>&#xf287; fa-usb </option>
                                        <option <?php if($linkDetail->icon_class=='fa-usd' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-usd'>&#xf155; fa-usd </option>
                                        <option <?php if($linkDetail->icon_class=='fa-user' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-user'>&#xf007; fa-user </option>
                                        <option <?php if($linkDetail->icon_class=='fa-user-circle' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-user-circle'>&#xf2bd; fa-user-circle </option>
                                        <option <?php if($linkDetail->icon_class=='fa-user-circle' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-user-circle-o'>&#xf2be; fa-user-circle-o </option>
                                        <option <?php if($linkDetail->icon_class=='fa-user-md' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-user-md'>&#xf0f0; fa-user-md </option>
                                        <option <?php if($linkDetail->icon_class=='fa-user-o' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-user-o'>&#xf2c0; fa-user-o </option>
                                        <option <?php if($linkDetail->icon_class=='fa-user-plus' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-user-plus'>&#xf234; fa-user-plus </option>
                                        <option <?php if($linkDetail->icon_class=='fa-user-secret' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-user-secret'>&#xf21b; fa-user-secret </option>
                                        <option <?php if($linkDetail->icon_class=='fa-user-times' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-user-times'>&#xf235; fa-user-times </option>
                                        <option <?php if($linkDetail->icon_class=='fa-users' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-users'>&#xf0c0; fa-users </option>
                                        <option <?php if($linkDetail->icon_class=='fa-vcard' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-vcard'>&#xf2bb; fa-vcard </option>
                                        <option <?php if($linkDetail->icon_class=='fa-vcard-o' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-vcard-o'>&#xf2bc; fa-vcard-o </option>
                                        <option <?php if($linkDetail->icon_class=='fa-venus' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-venus'>&#xf221; fa-venus </option>
                                        <option <?php if($linkDetail->icon_class=='fa-venus-double' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-venus-double'>&#xf226; fa-venus-double </option>
                                        <option <?php if($linkDetail->icon_class=='fa-venus-mars' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-venus-mars'>&#xf228; fa-venus-mars </option>
                                        <option <?php if($linkDetail->icon_class=='fa-viacoin' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-viacoin'>&#xf237; fa-viacoin </option>
                                        <option <?php if($linkDetail->icon_class=='fa-viadeo' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-viadeo'>&#xf2a9; fa-viadeo </option>
                                        <option <?php if($linkDetail->icon_class=='fa-viadeo-square' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-viadeo-square'>&#xf2aa; fa-viadeo-square </option>
                                        <option <?php if($linkDetail->icon_class=='fa-video-camera' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-video-camera'>&#xf03d; fa-video-camera </option>
                                        <option <?php if($linkDetail->icon_class=='fa-vimeo' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-vimeo'>&#xf27d; fa-vimeo </option>
                                        <option <?php if($linkDetail->icon_class=='fa-vimeo-square' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-vimeo-square'>&#xf194; fa-vimeo-square </option>
                                        <option <?php if($linkDetail->icon_class=='fa-vine' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-vine'>&#xf1ca; fa-vine </option>
                                        <option <?php if($linkDetail->icon_class=='fa-vk' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-vk'>&#xf189; fa-vk </option>
                                        <option <?php if($linkDetail->icon_class=='fa-volume-control' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-volume-control-phone'>&#xf2a0; fa-volume-control-phone
                                        </option>
                                        <option <?php if($linkDetail->icon_class=='fa-volume-down' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-volume-down'>&#xf027; fa-volume-down </option>
                                        <option <?php if($linkDetail->icon_class=='fa-volume-off' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-volume-off'>&#xf026; fa-volume-off </option>
                                        <option <?php if($linkDetail->icon_class=='fa-volume-up' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-volume-up'>&#xf028; fa-volume-up </option>
                                        <option <?php if($linkDetail->icon_class=='fa-warning' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-warning'>&#xf071; fa-warning </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wechat' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wechat'>&#xf1d7; fa-wechat </option>
                                        <option <?php if($linkDetail->icon_class=='fa-weibo' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-weibo'>&#xf18a; fa-weibo </option>
                                        <option <?php if($linkDetail->icon_class=='fa-weixin' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-weixin'>&#xf1d7; fa-weixin </option>
                                        <option <?php if($linkDetail->icon_class=='fa-whatsapp' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-whatsapp'>&#xf232; fa-whatsapp </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wheelchair' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wheelchair'>&#xf193; fa-wheelchair </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wheelchair-alt' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-wheelchair-alt'>&#xf29b; fa-wheelchair-alt </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wifi' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wifi'>&#xf1eb; fa-wifi </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wikipedia-w' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wikipedia-w'>&#xf266; fa-wikipedia-w </option>
                                        <option <?php if($linkDetail->icon_class=='fa-window-close' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-window-close'>&#xf2d3; fa-window-close </option>
                                        <option <?php if($linkDetail->icon_class=='fa-window-close' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-window-close-o'>&#xf2d4; fa-window-close-o </option>
                                        <option <?php if($linkDetail->icon_class=='fa-window-maximize' ) echo
                                            'selected="selected"'
                                            ; ?>
                                            value='fa-window-maximize'>&#xf2d0; fa-window-maximize </option>
                                        <option <?php if($linkDetail->icon_class=='fa-window-minimize' ) echo
                                            'selected="selected"'
                                            ; ?>
                                            value='fa-window-minimize'>&#xf2d1; fa-window-minimize </option>
                                        <option <?php if($linkDetail->icon_class=='fa-window-restore' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-window-restore'>&#xf2d2; fa-window-restore </option>
                                        <option <?php if($linkDetail->icon_class=='fa-windows' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-windows'>&#xf17a; fa-windows </option>
                                        <option <?php if($linkDetail->icon_class=='fa-won' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-won'>&#xf159; fa-won </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wordpress' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wordpress'>&#xf19a; fa-wordpress </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wpbeginner' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wpbeginner'>&#xf297; fa-wpbeginner </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wpexplorer' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wpexplorer'>&#xf2de; fa-wpexplorer </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wpforms' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wpforms'>&#xf298; fa-wpforms </option>
                                        <option <?php if($linkDetail->icon_class=='fa-wrench' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-wrench'>&#xf0ad; fa-wrench </option>
                                        <option <?php if($linkDetail->icon_class=='fa-xing' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-xing'>&#xf168; fa-xing </option>
                                        <option <?php if($linkDetail->icon_class=='fa-xing-square' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-xing-square'>&#xf169; fa-xing-square </option>
                                        <option <?php if($linkDetail->icon_class=='fa-y-combinator' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-y-combinator'>&#xf23b; fa-y-combinator </option>
                                        <option <?php if($linkDetail->icon_class=='fa-y-combinator' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-y-combinator-square'>&#xf1d4; fa-y-combinator-square </option>
                                        <option <?php if($linkDetail->icon_class=='fa-yahoo' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-yahoo'>&#xf19e; fa-yahoo </option>
                                        <option <?php if($linkDetail->icon_class=='fa-yc' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-yc'>&#xf23b; fa-yc </option>
                                        <option <?php if($linkDetail->icon_class=='fa-yc-square' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-yc-square'>&#xf1d4; fa-yc-square </option>
                                        <option <?php if($linkDetail->icon_class=='fa-yelp' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-yelp'>&#xf1e9; fa-yelp </option>
                                        <option <?php if($linkDetail->icon_class=='fa-yen' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-yen'>&#xf157; fa-yen </option>
                                        <option <?php if($linkDetail->icon_class=='fa-yoast' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-yoast'>&#xf2b1; fa-yoast </option>
                                        <option <?php if($linkDetail->icon_class=='fa-youtube' ) echo
                                            'selected="selected"' ; ?>
                                            value='fa-youtube'>&#xf167; fa-youtube </option>
                                        <option <?php if($linkDetail->icon_class=='fa-youtube-play' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-youtube-play'>&#xf16a; fa-youtube-play </option>
                                        <option <?php if($linkDetail->icon_class=='fa-youtube-square' ) echo
                                            'selected="selected"' ;
                                            ?>
                                            value='fa-youtube-square'>&#xf166; fa-youtube-square </option>
                                    </select>
                                    <input type="hidden" class="form-control" id="currentIconClass"
                                        name="currentIconClass" value="{{$linkDetail->icon_class}}">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen para Slider</label>
                                    <input type="file" class="form-control" onchange="preview_image3(event)"
                                        name="sliderImage" id="sliderImage">
                                    <input type="hidden" class="form-control" id="currentSliderImage"
                                        name="currentSliderImage" value="{{$linkDetail->imagen}}"
                                        placeholder="Ingrese Titulo">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image3"
                                        src="{{$linkDetail->imagen }}" />
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Subtítulo</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="linkSubTitle"
                                        value="{{$linkDetail->subtitle}}" placeholder="Ingrese Subtitulo">
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Título</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="linkTitle"
                                        value="{{$linkDetail->titulo}}" placeholder="Ingrese Titulo">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Resumen de Enlace</label>
                                    <textarea class="form-control" name="linkResume" id="linkResume"
                                        placeholder="Ingrese Resumen"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$linkDetail->resumen}}</textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputEmail1">Link Texto</label>
                                    <input type="text" class="form-control" id="linkTextLink" name="linkTextLink"
                                        value="{{$linkDetail->text_link}}" placeholder="Ingrese Texto Link">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mostrar en Slide</label>
                                    <div class="form-check">
                                        <input type="checkbox" value="1" name="showSlider" id="showSlider" <?php
                                            if($linkDetail->show_slider == 1) echo 'checked'; ?>>
                                        <label class="form-check-label" for="showSlider">
                                            Mostrar Banner de Articulo en Slider
                                        </label>
                                    </div>
                                </div> --}}
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Insertar Imagen</label>
                                    <input type="file" class="form-control" onchange="preview_image(event)"
                                        name="linkImage" id="linkImage">
                                    <img style="margin-top: 10px;" class="img-fluid" id="output_image" width=300
                                        src="{{asset($linkDetail->imagen)}}" />
                                    <input type="hidden" name="currentLinkImage" value="{{ $linkDetail->imagen }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">URL de Video</label>
                                    <input type="url" class="form-control" id="linkUrlVideo" name="linkUrlVideo"
                                        value="{{ $linkDetail->video}}" placeholder="Ingrese URL">
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <h5>Contenido del Enlace</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" id="areaArticleContent">
                                    <label for="exampleInputEmail1">Descripción</label>
                                    <textarea class="form-control textAreaEditor" name="linkContent" id="linkContent"
                                        placeholder="Ingrese Descripcion"
                                        style="margin-top: 0px; margin-bottom: 0px; height: 93px;"></textarea>
                                </div>
                                <div class="form-group" id="linkFileContent" style="display: none">
                                    <label for="exampleInputFile">Subir Archivo</label>
                                    <input type="file" class="form-control" name="linkFile" id="linkFile">
                                    <input type="hidden" class="form-control" name="currentArticleFile"
                                        id="currentArticleFile" value="{{ $linkDetail->archivo }}">
                                </div>
                                <div class="form-group" id="linkUrlContent" style="display: none">
                                    <label for="exampleInputEmail1">Link Texto</label>
                                    <input type="text" class="form-control" id="linkTextLink" name="linkTextLink"
                                        placeholder="Ingrese Texto Link" value="{{ $linkDetail->redireccion }}">
                                </div>
                                @if ($linkDetail->tipo == 'tree')
                                <div class="form-group" id="selectTree">
                                    <label>Seleccione Sección</label>
                                    <select name="treeId" id="treeId" class="form-control" style="width: 100%;">
                                        <?php echo $tree_drop_down; ?>
                                    </select>
                                </div>
                                @endif
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Título para SEO</label>
                            <input type="text" class="form-control" placeholder="Ingrese Titulo" id="linkSeoTitle"
                                value="{{$linkDetail->title_seo }}" name="linkSeoTitle">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción para SEO</label>
                            <textarea class="form-control" name="linkSeoDescription" id="linkSeoDescription"
                                placeholder="Ingrese Descripcion"
                                style="margin-top: 0px; margin-bottom: 0px; height: 93px;">{{$linkDetail->content_seo }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Insertar Imagen para SEO</label>
                            <input type="file" class="form-control" onchange="preview_image2(event)" name="linkSeoImage"
                                id="linkSeoImage">
                            <img style="margin-top: 10px;" class="img-fluid" id="output_image2" width="400"
                                src="{{$linkDetail->image_seo }}" />
                        </div> --}}
                </div>
                <!-- /.row -->
                <div class="card-footer">
                    <div class="form-actions">
                        <input type="submit" value="Actualizar Enlace" class="btn btn-info">
                    </div>
                </div>
                </form>
                <!-- /.row -->

            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
            output.height = 300

            }
            reader.readAsDataURL(event.target.files[0]);
        }
</script>
@endsection
