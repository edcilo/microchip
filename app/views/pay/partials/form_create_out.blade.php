<div class="">

    <div class="row">
        <strong>{{ Form::label('amount', 'Monto: ', ['class'=>'label50']) }}</strong>
        $ {{ Form::text('amount', null, ['class'=>'text-right', 'autofocus', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('amount', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        {{ Form::checkbox('change_check', 1, null) }}
        <strong>{{ Form::label('change_check', 'Cambio pendiente:', ['class'=>'lable50']) }}</strong>
        <div class="message-error">
            {{ $errors->first('change_check', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        <strong>{{ Form::label('description', 'Concepto: ', ['class'=>'label50']) }}</strong>
        {{ Form::textarea('description', null, ['rows'=>'2', 'title'=>'Este campo es obligatorio.']) }}
        <div class="message-error">
            {{ $errors->first('description', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        <strong>{{ Form::label('user_receiving_id', 'Empleado que recibe:', ['class'=>'label50']) }}</strong>
        {{ Form::text('user_receiving_id', null, ['title'=>'Este campo es obligatorio.', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('user_receiving_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        <strong>{{ Form::label('date', 'Fecha: ', ['class'=>'label50']) }}</strong>
        {{ Form::text('date', date('Y-m-d'), ['title'=>'Este campo es obligatorio.', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('date', '<span>:message</span>') }}
        </div>
    </div>

    <hr/>

    <div class="row col col100 text-center">

        <div class="flo col50">
            <button type="submit" class="btn-green">
                <i class="fa fa-money"></i>
                Guardar salida
            </button>
        </div>

        <div class="flo col50 text-center">
            <a href="{{ route('pay.pending') }}" class="btn-red">
                <i class="fa fa-arrow-left"></i>
                Terminar
            </a>
        </div>

    </div>


</div>


{{ Form::close() }}