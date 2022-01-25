@if(count($courses))
<table id="sectionsTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Título</th>
            <th>Imagen</th>
            <th>Url Archivo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
        <tr>
            <td>{{ $course->id }}</td>
            <td>{{ $course->title }}</td>
            <td>
                <img class="img-fluid" src="{{asset($course->url_image)}}" width=200 height=100 alt="">
            </td>
            <td>
                <a target="_blank" href="{{ $course->file_url }}">
                    {{ $course->file_url }}
                </a>
            </td>
            <td>
                @if($course->is_activated==1)
                <input name="is_activated" class="activated_course" data-id="{{$course->id}}" value="" type="checkbox"
                    checked>
                @else
                <input name="is_activated" class="activated_course" data-id="{{$course->id}}" type="checkbox">
                @endif
            </td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-cog text-info"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
                        {!! Form::open(['route' => ['courses.destroy', $course->id], 'method' =>
                        'DELETE','class'=>'delete-item'.$course->id]) !!}
                        <button type="button" class="btn btn-md list-units-course dropdown-item"
                            data-id="{{$course->id}}" data-title="{{$course->title}}" data-toggle="modal"
                            data-target="#unitsListModal">
                            <i class="fas fa-file text-info"></i>
                            Ver unidades
                        </button>
                        <a class="dropdown-item" data-toggle="tooltip" href="{{ route('courses.edit',$course->id)}}"
                            title="Editar">
                            <i class="far fa-edit text-info"></i>
                            Editar
                        </a>
                        <button type="button" class="btn btn-md delete-item-table dropdown-item" data-toggle="tooltip"
                            data-id="{{$course->id}}" title="Eliminar">
                            <i style="color: red;" class="fas fa-trash-alt"></i>
                            Eliminar
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<x-table></x-table>
@endif
