@extends('layouts.admin_layout')
@section('title', 'Preguntas')
@section('content')
    <div class="content-wrapper">
        <x-position root="Home" title="Preguntas" position="Preguntas" url="{{url('dashboard')}}"/>
        <section class="content">
            <div class="container-fluid">
                <x-alert/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de Preguntas</h3>
                                <a href="{{ route('questions.create') }}"
                                   style="max-width: 150px; float: right; display:inline-block;"
                                   class="btn btn-md btn-primary">Agregar Pregunta</a>
                            </div>
                            <div id="table-questions" class="card-body table-questions">
                                @include('admin.questions.table')
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.questions.modals')
            </div>
        </section>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('js/axios.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
