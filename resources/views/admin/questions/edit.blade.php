@extends('layouts.admin_layout')
@section('title', 'Editar Pregunta')
@section('content')
    <div class="content-wrapper">
        <x-position root="Preguntas" title="Preguntas" position="Editar Preguntas" url="{{route('courses.index')}}"></x-position>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card card-primary">
                            <x-header title="Editar pregunta" url="{{route('questions.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-questions" class="card-body">
                                {!! Form::model($question,['url' => route('questions.update',$question->id),'method' => 'PUT','files' => true]) !!}
                                @include('admin.questions.partials.form')
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
    <script src="{{asset('js/scripts/courses.js')}}"></script>
@endsection
