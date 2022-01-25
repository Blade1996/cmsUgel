@extends('layouts.admin_layout')
@section('title', 'Respuestas')
@section('content')
    <div class="content-wrapper">
        <x-position root="Home" title="Tipo de Respuestas" position="Tipo de Respuestas" url="{{url('dashboard')}}"/>
        <section class="content">
            <div class="container-fluid">
                <x-alert/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de respuestas</h3>
                                <a href="{{ route('type-answers.create') }}"
                                   style="max-width: 150px; float: right; display:inline-block;"
                                   class="btn btn-md btn-primary">Agregar</a>
                            </div>
                            <div id="table-courses" class="card-body table-courses">
                                @include('admin.type_answers.table')
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
