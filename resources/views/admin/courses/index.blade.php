@extends('layouts.admin_layout')
@section('title', 'Cursos')
@section('content')
    <div class="content-wrapper">
        <x-position root="Home" title="Cursos" position="Cursos" url="{{url('dashboard')}}"/>
        <section class="content">
            <div class="container-fluid">
                <x-alert/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de cursos</h3>
                                <a href="{{ route('courses.create') }}"
                                   style="max-width: 150px; float: right; display:inline-block;"
                                   class="btn btn-md btn-primary">Agregar Curso</a>
                            </div>
                            <div id="table-courses" class="card-body table-courses">
                                @include('admin.courses.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('admin.courses.modals')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/axios.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
