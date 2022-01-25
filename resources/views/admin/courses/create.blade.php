@extends('layouts.admin_layout')
@section('title', 'Crear Cursos')
@section('content')
    <div class="content-wrapper">
        <x-position root="Cursos" title="Cursos" position="Nuevo curso" url="{{route('courses.index')}}"></x-position>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card card-primary">
                            <x-header title="Nuevo curso" url="{{route('courses.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-courses" class="card-body">
                                {!! Form::open(['url' => route('courses.store'),'files' => true]) !!}
                                @include('admin.courses.partials.form')
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
