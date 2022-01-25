<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('title', 'Título') !!}
            {!! Form::text('title',null, ['id'=>'title','class'=>'form-control']) !!}
            @error('title')
            <x-form message="{{$message }}" />
            @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">

            <label class="mb-2" for="url_image">Imagen <small>(jpeg, png, jpg, gif)</small></label>
            <div class="text-center">
                <img class="img-fluid" id="show_img"
                    src="@if(isset($course->url_image)){{asset($course->url_image)}}@endif" height="300">
            </div>
            <div class="input-group">
                <div class="custom-file">
                    {!! Form::file('url_image', ['id'=>'url_image','class'=>'custom-file-input']) !!}
                    <label class="custom-file-label" for="url_image">
                        @if(isset($course->url_image))
                        {{$course->url_image}}
                        @else
                        Subir una imagen
                        @endif
                    </label>
                </div>
            </div>
            @error('url_image')
            <x-form message="{{$message }}" />
            @enderror
        </div>
        <div class="form-group">

            <label class="mb-2" for="url_banner">Banner Principal <small>(jpeg, png, jpg, gif)</small></label>
            <div class="text-center">
                <img class="img-fluid" id="show_banner"
                    src="@if(isset($course->banner)){{asset($course->banner)}}@endif" height="300">
            </div>
            <div class="input-group">
                <div class="custom-file">
                    {!! Form::file('banner', ['id'=>'url_banner','class'=>'custom-file-input']) !!}
                    <label class="custom-file-label" for="banner">
                        @if(isset($course->banner))
                        {{$course->banner}}
                        @else
                        Subir una imagen
                        @endif
                    </label>
                </div>
            </div>
            @error('url_image')
            <x-form message="{{$message }}" />
            @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::label('file_url', 'Certificado de finalización (PDF)') !!}
            <div class="input-group">
                <div class="custom-file">
                    {!! Form::file('file_url', ['id'=>'file_url','class'=>'custom-file-input']) !!}
                    <label class="custom-file-label" for="url_image">
                        @if(isset($course->file_url))
                        {{$course->file_url}}
                        @else
                        Subir archivo pdf
                        @endif

                    </label>
                </div>
            </div>
            @error('file_url')
            <x-form message="{{$message }}" />
            @enderror
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
            <x-form message="{{$message }}" />
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
