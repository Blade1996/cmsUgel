@extends('layouts.admin_layout')
@section('title', 'Unidades')

@section('content')
    <div class="content-wrapper">
        <x-position root="Home" title="Unidades" position="Unidades" url="{{url('dashboard')}}"/>
        <section class="content">
            <div class="container-fluid">
                <x-alert/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listado de unidades</h3>

                                <a href="{{ route('units.create') }}"
                                   style="max-width: 150px; float: right; display:inline-block;"
                                   class="btn btn-sm btn-primary">Agregar unidad</a>
                            </div>
                            <select style="width: 100%;"
                                    class="form-control js-example-basic-single selected-filter-course" name="course_id"
                                    id="course_id">
                                <option value="0">Seleccione un curso</option>
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                            <div id="table-units-course" class="card-body table-units-course">

                                @include('admin.units.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.units.modals')
            @include('admin.questions.modals')
        </section>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/axios.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/scripts/all_admin.js')}}"></script>
@endsection
