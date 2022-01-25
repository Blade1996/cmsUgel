<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name',null, ['id'=>'name','class'=>'form-control']) !!}
            @error('title')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('sur_name', 'Apellidos') !!}
            {!! Form::text('sur_name',null, ['id'=>'sur_name','class'=>'form-control']) !!}
            @error('sur_name')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('email', 'Correo') !!}
            {!! Form::email('email',null, ['id'=>'email','class'=>'form-control']) !!}
            @error('email')
            <x-form message="{{$message }}"/>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('name_city', 'Ciudad') !!}
            {!! Form::text('name_city',null, ['id'=>'name_city','class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('worker_type', 'Tipo de trabajador') !!}
            {!! Form::text('worker_type',null, ['id'=>'worker_type','class'=>'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('enterprise', 'Trabajador externo') !!}
            <div class="form-control">
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('external_enterprise', 1) }} Si
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('external_enterprise',0) }} No
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            {!! Form::label('gender', 'Género') !!}
            <div class="form-control">
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('gender', 'male') }} Masculino
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <label>
                        {{ Form::radio('gender','female') }} Femenino
                    </label>
                </div>
            </div>
        </div>
    </div>
    @if(isset($user))
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
            </div>
        </div>
    @endif


</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
</div>


