@extends('layouts.admin_layout')
@section('title', 'Editar Cursos')
@section('content')
    <div class="content-wrapper">
        <x-position root="Cursos" title="Cursos" position="Editar curso" url="{{route('courses.index')}}"></x-position>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card card-primary">
                            <x-header title="Editar curso" url="{{route('courses.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-courses" class="card-body">
                                {!! Form::model($course,['url' => route('courses.update',$course->id),'method' => 'PUT','files' => true]) !!}
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
