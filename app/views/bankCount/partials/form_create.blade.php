<div class="col col100">

    <div class="row flo col25">
        {{ Form::label('status', 'Tipo de movimiento: ') }} <br/>
        {{ Form::select('status',
            ['Selecciona...', 'Entrada'=>'Entrada', 'Salida'=>'Salida'],
            null, ['autofocus', 'title'=>'Este campo es obligatorio', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('status', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('amount', 'Monto ($):') }} <br/>
        {{ Form::text('amount', null, ['data-required'=>'required', 'data-numeric'=>'numeric', 'title'=>'Este campo es obligatorio']) }}
        <div class="message-error">
            {{ $errors->first('amount', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('date', 'Fecha:') }} <br/>
        {{ Form::text('date', (isset($count) ? $count->date : date('Y-m-d')), ['data-required'=>'required', 'data-date'=>'date', 'title'=>'Este campo es obligatorio']) }}
        <div class="message-error">
            {{ $errors->first('date', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('description', 'Descripción:') }} <br/>
        {{ Form::textarea('description', null, ['data-required'=>'required', 'rows'=>'3', 'title'=>'Este campo es obligatorio']) }}
        <div class="message-error">
            {{ $errors->first('description', '<span>:message</span>') }}
        </div>
    </div>

</div>

<hr/>

<div class="col col100 text-center">

    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i>
        Guardar
    </button>

</div>

{{ Form::close() }}
