@extends('layouts.admin_layout')
@section('title', 'Crear Unidades')
@section('content')
    <div class="content-wrapper">
        <x-position root="Unidades" title="Unidades" position="Nueva unidad" url="{{route('units.index')}}"></x-position>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <x-alert/>
                    <div class="col-12">
                        <div class="card  card-primary">
                            <x-header title="Nueva unidad" url="{{route('units.index')}}" btn="Atras"
                                      className="btn btn-sm bg-white" icon="fa fa-arrow-circle-left"/>
                            <div id="table-courses" class="card-body">
                                {!! Form::open(['url' => route('units.store'),'files' => true]) !!}
                                @include('admin.units.partials.form')
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
