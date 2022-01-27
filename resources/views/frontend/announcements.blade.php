@extends('frontend.layouts.home_layout')
@section('title', 'Convocatorias')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Convocatorias</li>
                </ol>
            </nav>

            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">Convocatorias</h1>
                </header>

                <!-- Post content-->
                <section class="mb-5">


                    <!--
                    <p class="fs-6 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris est ipsum, tempus ac lobortis sed, commodo ornare lacus. Aliquam accumsan elit vitae aliquet ultrices. Donec tincidunt imperdiet mauris id tincidunt. Donec luctus finibus posuere. Phasellus efficitur viverra libero, quis maximus nisl facilisis quis. Pellentesque pulvinar pellentesque sodales. Nunc fringilla eros nisl, tincidunt mollis ante commodo nec. Fusce ornare sit amet diam at tristique. Suspendisse semper libero a magna tincidunt facilisis. Sed viverra ultricies nunc eu venenatis. Vestibulum id orci eget massa scelerisque vestibulum ut a arcu. Nullam elementum odio vitae dignissim accumsan. Fusce ligula erat, elementum non tortor at, fringilla hendrerit dolor.</p>
                    <p class="fs-6 mb-4">Sed et ipsum cursus odio fermentum rutrum nec quis nulla. Donec vitae nisl a libero pulvinar ullamcorper sed quis purus. Mauris et laoreet lacus. Nam in tempor lorem. Quisque pulvinar elit est, at viverra eros gravida nec. Nunc aliquam eros eget lacus rutrum, et scelerisque est bibendum. Nulla mollis nibh venenatis semper imperdiet. Mauris feugiat tincidunt mi, ut eleifend libero tincidunt quis.</p>
                    <p class="fs-6 mb-4">Praesent at lectus lorem. Nunc vitae varius erat, at tempus erat. Nullam ullamcorper gravida blandit. Pellentesque fermentum ipsum laoreet augue tristique sagittis. Nullam cursus nisl vitae condimentum suscipit. Ut congue lectus est, ac viverra mauris finibus eu. Fusce consectetur ante vitae semper tincidunt. Sed dignissim ante nec nisi fringilla, eu tincidunt arcu cursus. Duis vulputate dolor sed sapien bibendum eleifend. Etiam malesuada tortor faucibus felis ultricies posuere. Nam sed pellentesque mauris. Phasellus consectetur sem vel ipsum dignissim, at semper augue convallis. Pellentesque eu lacinia magna.</p>

-->
                    <table id="announcenentsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Unidad / Referencia de la convocatoria</th>
                                <th>Convocatoria / Bases</th>
                                <th>Resultados Evaluación de CVs</th>
                                <th>Resultado final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $announcements as $announcement)
                            <tr>
                                <td>{{ $announcement->created_at->format('d/m/Y') }}</td>
                                <td><b>{{ $announcement->title }}</b>
                                    <br>
                                    RESULTADOS FINALES ...
                                </td>
                                <td><a href="{{ $announcement->url_basis }}" target="_blank"><i
                                            class="far fa-file-pdf"></i></a></td>
                                <td><a href="{{ $announcement->result_cv }}" target="_blank"><i
                                            class="far fa-file-pdf"></i></a></td>
                                <td><a href="{{ $announcement->result_final }}" target="_blank"><i
                                            class="far fa-file-pdf"></i></a></td>
                                {{-- <td><a href="https://ugelilo.edu.pe/web/media/convocatoria/plaza-final-2912c.pdf"
                                        target="_blank"><i class="far fa-file-pdf"></i></a></td>
                                --}}
                            </tr>
                            @endforeach
                            {{-- <tr>
                                <td>28/10/2021</td>
                                <td><b>CAS Nº.013-2021-UGEL ILO-AGA-PER</b>
                                    <br>
                                    RESULTADOS FINALES ...
                                </td>
                                <td><a href="https://ugelilo.edu.pe/web/media/convocatoria/plaza-b72454eb56.pdf"
                                        target="_blank"><i class="far fa-file-pdf"></i></a></td>
                                <td><a href="https://ugelilo.edu.pe/web/media/convocatoria/plaza-eval-e40c0.pdf"
                                        target="_blank"><i class="far fa-file-pdf"></i></a></td>
                                <td><a href="https://ugelilo.edu.pe/web/media/convocatoria/plaza-final-2912c.pdf"
                                        target="_blank"><i class="far fa-file-pdf"></i></a></td>
                                <td><a href="https://ugelilo.edu.pe/web/media/convocatoria/plaza-final-2912c.pdf"
                                        target="_blank"><i class="far fa-file-pdf"></i></a></td>

                            </tr> --}}

                        </tbody>

                        </tfoot>
                    </table>



                    <!--
                    <p class="fs-6 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris est ipsum, tempus ac lobortis sed, commodo ornare lacus. Aliquam accumsan elit vitae aliquet ultrices. Donec tincidunt imperdiet mauris id tincidunt. Donec luctus finibus posuere. Phasellus efficitur viverra libero, quis maximus nisl facilisis quis. Pellentesque pulvinar pellentesque sodales. Nunc fringilla eros nisl, tincidunt mollis ante commodo nec. Fusce ornare sit amet diam at tristique. Suspendisse semper libero a magna tincidunt facilisis. Sed viverra ultricies nunc eu venenatis. Vestibulum id orci eget massa scelerisque vestibulum ut a arcu. Nullam elementum odio vitae dignissim accumsan. Fusce ligula erat, elementum non tortor at, fringilla hendrerit dolor.</p>


                    <p class="fs-6 mb-4">Praesent at lectus lorem. Nunc vitae varius erat, at tempus erat. Nullam ullamcorper gravida blandit. Pellentesque fermentum ipsum laoreet augue tristique sagittis. Nullam cursus nisl vitae condimentum suscipit. Ut congue lectus est, ac viverra mauris finibus eu. Fusce consectetur ante vitae semper tincidunt. Sed dignissim ante nec nisi fringilla, eu tincidunt arcu cursus. Duis vulputate dolor sed sapien bibendum eleifend. Etiam malesuada tortor faucibus felis ultricies posuere. Nam sed pellentesque mauris. Phasellus consectetur sem vel ipsum dignissim, at semper augue convallis. Pellentesque eu lacinia magna.</p>

-->
                </section>
            </article>

        </div>
    </div>
</div>
<script>
    $(function(){

    })
</script>
@endsection
