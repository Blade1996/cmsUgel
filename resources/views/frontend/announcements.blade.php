@extends('frontend.layouts.home_layout')
@section('title', 'Convocatorias')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
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

                <table id="announcenentsTable" class="table table-bordered table-striped" style="max-width: 100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Unidad / Referencia de la convocatoria</th>
                            <th>Bases</th>
                            <th>Resultados Evaluacion</th>
                            <th>Resultado Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->fecha }}</td>
                            <td><b>{{ $announcement->nombre }}</b>
                                <br>
                                {{ $announcement->descripcion }}
                            </td>
                            <td><a href="{{ $announcement->archivo }}" tooltrip target="_blank"><i
                                        class="far fa-file-pdf"></i></a>
                            </td>
                            <td><a href="{{ $announcement->archivo_eval }}" tooltrip target="_blank"><i
                                        class="far fa-file-pdf"></i></a>
                            </td>
                            <td><a href="{{ $announcement->archivo_final }}" tooltrip target="_blank"><i
                                        class="far fa-file-pdf"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    </tfoot>
                </table>
            </article>

        </div>
    </div>
</div>
@endsection
