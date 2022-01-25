@if(count($units))

    <ul class="todo-list ui-sortable" data-widget="todo-list">
        @foreach ($units as $unit)
            <li class="unit-item" id="{{$unit->id}}" data-title="{{$unit->title}} ">
                        <span class="handle ui-sortable-handle">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v"></i>
                        </span>

                @if($unit->is_activated==1)
                    <input name="is_activated" class="activated_unit" data-id="{{$unit->id}}" value=""
                           type="checkbox" id="todoCheck2{{$unit->id}}" checked>
                @else
                    <input name="is_activated" class="activated_unit" data-id="{{$unit->id}}"
                           id="todoCheck2{{$unit->id}}" type="checkbox">
                @endif
                <span class="text">{{$unit->title}}</span>
                <div class="tools">
                    <a class="" data-toggle="tooltip"
                       href="{{ route('units.edit',$unit->id) }}" title="Editar">
                        <i class="far fa-edit text-info"></i>
                    </a>
                </div>
            </li>

        @endforeach
    </ul>

@else
    <x-table></x-table>
@endif
