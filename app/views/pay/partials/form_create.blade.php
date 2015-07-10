<div class="">

    <div class="row">
        <strong class="label50">Total:</strong>
        @if($sale->classification == 'Servicio')
            $ {{ $sale->total_price_f }}
        @elseif($sale->classification == 'Pedido')
            $ {{ $sale->total_order_f }}
        @else
            @if( $sale->new_price > 0 )
                $ {{ $sale->pv_di_f }}
                =
                [$ {{ $sale->total_f }} + $ {{ $sale->difference_iva }}]
            @else
                $ {{ $sale->total_f }}
            @endif
        @endif
    </div>

    <div class="row">
        <strong class="label50">Abono:</strong>
        $ {{ $sale->user_total_pay_f }}
    </div>

    <div class="row">
        <strong class="label50">Saldo:</strong>
        $ <span id="user_rest">{{ $sale->user_rest_total_f }}</span>
    </div>

    @if( $sale->classification != 'Venta' AND $sale->getPaymentTotalAttribute() == 0 )
        <div class="row">
            <strong class="label50">Anticipo:</strong>
            $ {{ $sale->advance }}
        </div>
    @endif

    <div class="row">
        <strong>{{ Form::label('method', 'Método de pago:', ['class'=>'label50']) }}</strong>
        {{ Form::select('method', trans('lists.payment_methods'), null, ['title'=>'Este campo es obligatorio', 'autofocus', 'data-required']) }}
        <div class="message-error">
            {{ $errors->first('method', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row amount">
        <strong>{{ Form::label('amount', 'Pago: ', ['class'=>'label50']) }}</strong>
        $ {{ Form::text('amount', null, ['class'=>'text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('amount', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row hide" id="pay_change">
        <strong>
            <label for="" class="label50">Cambio:</label>
        </strong>
        <span>
            $ <input type="text" class="value text-right" id="change" value="0.00" data-accept="false" disabled>
        </span>
    </div>

    <div class="row folio hide">
        <strong>{{ Form::label('folio', 'Folio: ', ['class'=>'label50']) }}</strong>
        {{ Form::text('folio', null, ['class'=>'text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('folio', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row reference hide">
        <strong>{{ Form::label('reference', 'No. Tarjeta/No. de cheque/folio/referencia: ', ['class'=>'label50']) }}</strong>
        {{ Form::text('reference', null, ['title'=>'Este campo es obligatorio.', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('reference', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row entity hide">
        <strong>{{ Form::label('entity', 'IFE/Banco: ', ['class'=>'label50']) }}</strong>
        {{ Form::text('entity', null, ['title'=>'Este campo es obligatorio.', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('entity', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        <strong>{{ Form::label('description', 'Comentarios: ', ['class'=>'label50']) }}</strong>
        {{ Form::textarea('description', null, ['rows'=>'2', 'title'=>'Este campo es obligatorio.']) }}
        <div class="message-error">
            {{ $errors->first('description', '<span>:message</span>') }}
        </div>
    </div>

    <hr/>

    <div class="row col col100">

        <div class="flo col33">
            <a href="{{ route('pay.pending') }}" class="btn-red">
                <i class="fa fa-arrow-left"></i>
                Terminar
            </a>
        </div>

        <div class="flo col33">
            {{--
            <a href="#" class="btn-blue">
                <i class="fa fa-print"></i>
                Imprimir
            </a>
            --}}
            &nbsp;
        </div>

        <div class="flo col33 text-right">
            <button type="submit" class="btn-green form_confirm" data-confirm="store_confirm">
                <i class="fa fa-money"></i>
                Guardar pago
            </button>
        </div>

    </div>


</div>


{{ Form::close() }}

<div class="confirm-dialog hide" title="Guardar pago" id="store_confirm" data-width="400">
    <div class="mesasge text-center">
        <p>¿Guardar pago?</p>
    </div>
</div>
