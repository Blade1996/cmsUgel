<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('id_sub_category', 'Curso') !!}
            {!! Form::select('course_id', $courses,null, [ 'id'=>'course_id','class'=>'form-control']) !!}
            @error('course_id')
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
    <div class="col-lg-12">
        <div id="input_image" class="form-group">
            @include('admin.units.image')
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('url_video', 'URL VIDEO') !!}
            {!! Form::text('url_video',null, ['id'=>'title','class'=>'form-control']) !!}
            @error('url_video')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Orden</label>
            {!! Form::number('order',null, ['id'=>'order','class'=>'form-control']) !!}
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


