{{ Form::open(['method'=>'get', 'class'=>'form validate']) }}

<div class="row">
    {{ Form::label('date_init', 'Fecha inicial:') }}
    {{ Form::input('date', 'date_init', $date_init, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
    {{ Form::input('time', 'time_init', $time_init, ['title'=>'Este campo es obligatorio.']) }}

    {{ Form::label('date_end', 'Fecha final:') }}
    {{ Form::input('date', 'date_end', $date_end) }}
    {{ Form::input('time', 'time_end', $time_end) }}

    <button class="btn-green">
        <i class="fa fa-calendar"></i>
        Generar corte de caja
    </button>

    <div class="message-error">
        {{ $errors->first('date_init', '<span>:message</span>') }}
        {{ $errors->first('time_init', '<span>:message</span>') }}
        {{ $errors->first('date_end', '<span>:message</span>') }}
        {{ $errors->first('time_end', '<span>:message</span>') }}
    </div>
</div>

{{ Form::close() }}