{{ Form::open(['route'=>'purchasePayment.store', 'method'=>'post', 'class'=>'form validate', 'id'=>'formPaymentRegister']) }}
{{ Form::hidden('purchase_id', $purchase->id) }}

<div class="col col100">

    <div class="row flo col25 left">
        {{ Form::label('method', 'Método de pago:') }} <br/>
        {{ Form::select('method', trans('selects.pay_method'), null, ['title'=>'Selecciona una opción valida de la lista.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('method', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('payment_date', 'Fecha de pago:') }} <br/>
        {{ Form::text('payment_date', date('Y-m-d'), ['placeholder'=>'AAAA-MM-DD', 'title'=>'Este campo es obligatorio y debe serguir el siguiente formato (AAAA-MM-DD)', 'data-required'=>'required', 'data-date'=>'date']) }}
        <div class="message-error">
            {{ $errors->first('payment_date', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('type', 'Tipo de pago:') }} <br/>
        {{ Form::select('type', trans('selects.pay_type'), null, ['title'=>'Selecciona una opción valida de la lista.', 'data-required'=>'required']) }}
        {{ Form::text('type_other', null, ['class'=>'hide', 'title'=>'Este campo es obligatorio.']) }}
        <div class="message-error">
            {{ $errors->first('type', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 right">
        {{ Form::label('bank_id', 'Banco:') }} <br/>
        {{ Form::select('bank_id', $bank_list, null, ['title'=>'Selecciona una opción valida de la lista.']) }}
        <div class="message-error">
            {{ $errors->first('type', '<span>:message</span>') }}
        </div>


        {{ Form::label('cheque_id', 'Cheque:') }} <br/>
        {{ Form::select('cheque_id', $cheque_list, null, ['title'=>'Selecciona una opción valida de la lista.']) }}
        <div class="message-error">
            {{ $errors->first('cheque_id', '<span>:message</span>') }}
        </div>

        {{ Form::label('folio', 'Folio:') }} <br/>
        {{ Form::text('folio', null, ['placeholder'=>'Folio de la nota de crédito']) }}
        <div class="message-error">
            {{ $errors->first('folio', '<span>:message</span>') }}
        </div>

    </div>

</div>

<div class="col col100 text-center">
    <hr/>

    {{ Form::submit('Registrar pago') }}
</div>


{{ Form::close() }}
