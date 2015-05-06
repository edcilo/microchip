<div class="col col100"></div>

<div class="col col100">
    <div class="flo col50 left">
        <div class="row">
            {{ Form::label('iva', 'I.V.A (%): ', ['class'=>'label50']) }}
            {{ Form::text('iva', null, ['title'=>'Este campo es obligatorio.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('iva', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('dollar', 'Valor del dolar ($): ', ['class'=>'label50']) }}
            {{ Form::text('dollar', null, ['title'=>'Este campo es obligatorio.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('dollar', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 right">
        <div class="row">
            {{ Form::label('coupon_effective_days', 'Días de vigencia del cupón:', ['class'=>'label50']) }}
            {{ Form::text('coupon_effective_days', null, ['title'=>'Este campo es obligatorio', 'data-integer-unsigned' => 'integer', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('coupon_effective_days', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('coupon_terms_use', 'Condiciones de uso para el cupón:') }}
            {{ Form::textarea('coupon_terms_use', null, ['rows' => '2']) }}
            <div class="message-error">
                {{ $errors->first('coupon_terms_use', '<span>:message</span>') }}
            </div>
        </div>
    </div>

</div>

<div class="col col100 text-center">
    <hr/>

    {{ Form::submit('Guardar cambios') }}
</div>


{{ Form::close() }}
