@if ( Session::get('msg') )
    <aside class="msg_dialog">{{ Session::get('msg') }}</aside>
@endif

{{ Form::open(['route'=>'cheque.store', 'method'=>'post', 'class'=>'form validate plus']) }}
{{ Form::hidden('bank_id', $bank->id) }}

<div class="flo col33 left">
    <div class="row">
        {{ Form::label('folio_start', 'Folio inicial: ') }} <br/>
        {{ Form::text('folio_start', 0, ['autocomplete'=>'off', 'class'=>'text-right', 'title'=>'Este campo es obligatorio y debe contener un valor entero positivo', 'data-required'=>'required', 'data-integer-unsigned'=>'integer']) }}
    </div>
</div>

<div class="flo col33 left">
    <div class="row">
        {{ Form::label('quantity', 'Cantidad de cheques: ') }} <br/>
        {{ Form::text('quantity', 0, ['autocomplete'=>'off', 'class'=>'text-right sm-input', 'title'=>'Este campo debe contener un valor entero positivo', 'data-integer-unsigned'=>'integer']) }}
    </div>
</div>

<div class="flo col33 right">
    <div class="row">
        {{ Form::label('folio_end', 'Folio final: ') }} <br/>
        {{ Form::text('folio_end', null, ['autocomplete'=>'off', 'class'=>'text-right', 'title'=>'Este campo es obligatorio y debe contener un valor entero positivo', 'data-required'=>'required', 'data-integer-unsigned'=>'integer']) }}
    </div>
</div>

<div class="col col100">
    <div class="message-error">
        {{ $errors->first('folio', '<span>:message</span>') }}
    </div>
</div>

<div class="col col100 text-center">
    <hr/>
    {{ Form::submit('Registrar') }}
</div>

{{ Form::close() }}