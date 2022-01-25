<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('unit_id', 'Unidad') !!}
            {!! Form::select('unit_id', $units,null, [ 'id'=>'unit_id','class'=>'form-control']) !!}
            @error('unit_id')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('title', 'Título') !!}
            {!! Form::text('title',null, ['id'=>'title','class'=>'form-control']) !!}
            @error('title')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label for="exampleInputEmail1">Contenido</label>
            {!! Form::textarea('content',null, ['id'=>'content','class'=>'form-control textAreaEditor form-content']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('is_activated', 'Estado') !!}
            <div class="form-control">
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('is_activated', 1) }} Activo
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('is_activated',0) }} Inactivo
                    </label>
                </div>
            </div>
            @error('is_activated')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
</div>


