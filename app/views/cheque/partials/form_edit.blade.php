<div class="col col100">

    <div class="flo col33 row left">
        <strong>Banco:</strong> <br/>
        {{ $cheque->bank->name }}
    </div>

    <div class="flo col33 row center">
        <strong>Folio:</strong> <br/>
        {{ $cheque->folio }}
    </div>

    <div class="flo col33 row right">
        {{ Form::label('status', 'Estado: ', ['class'=>'label50']) }} <br/>
        {{ Form::select('status', $status_list, null, ['title'=>'']) }}
        <div class="message-error">
            {{ $errors->first('status', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">

    <div class="flo col33 row left">
        {{ Form::label('payment_date', 'Fecha de pago: ') }} <br/>
        {{ Form::input('date', 'payment_date', ( $cheque->payment_date == 0 ) ? date('Y-m-d') : $cheque->payment_date, ['class'=>'text-right', 'title'=>'Este campo es obligatorio y debe almacenar una fecha con el formato "AAAA-MM-DD".', 'data-required'=>'required', 'data-date'=>'date']) }}
        <div class="message-error">
            {{ $errors->first('payment_date', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col33 row center">
        {{ Form::label('amount', 'Monto: ') }} <br/>
        $ {{ Form::text('amount', number_format($cheque->amount, 2, '.', ''), ['class'=>'text-right', 'title'=>'Este campo es obligatorio y debe almacenar un valor numerico.', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('amount', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col33 row right">
        {{ Form::label('receiver', 'Paguese este cheque a: ') }} <br/>
        {{ Form::text('receiver', null, ['data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('receiver', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">

    <div class="flo col33 row left">
        {{ Form::label('concept', 'Concepto: ') }} <br/>
        {{ Form::text('concept', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('concept', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col33 row center">
        {{ Form::checkbox('message', 1, null, []) }}
        {{ Form::label('message', 'PARA ABONO A CUENTA DEL BENEFICIARIO') }}
    </div>

    <div class="flo col33 row right">
        {{ Form::label('observations', 'Observaciones: ') }} <br/>
        {{ Form::textarea('observations', null, ['rows'=>'3', 'title'=>'', 'data-max'=>'max']) }}
        <div class="message-error">
            {{ $errors->first('observations', '<span>:message</span>') }}
        </div>
    </div>

</div>

<hr/>

<div class="col col100 text-center">
    {{ Form::submit('Guardar') }}
</div>

{{ Form::close() }}
