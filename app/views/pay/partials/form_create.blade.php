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
        $ <span id="user_rest" data-value="{{ $sale->getUserRestTotalAttribute('') }}">{{ $sale->user_rest_total_f }}</span>
    </div>

    @if( $sale->classification != 'Venta' AND $sale->getPaymentTotalAttribute() == 0 )
        <div class="row">
            <strong class="label50">Anticipo:</strong>
            $ <input type="text" id="anticipo" value="{{ $sale->advance }}" class="text-right">
        </div>
    @endif

    <div class="row">
        <strong>{{ Form::label('method', 'Método de pago:', ['class'=>'label50']) }}</strong>
        {{ Form::select('method', trans('lists.payment_methods'), null, ['title'=>'Este campo es obligatorio', 'autofocus', 'data-required'=>'required', 'data-url_customer'=>route('customer.search')]) }}
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
        {{ Form::text('folio', null, ['class'=>'text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-url'=>route('api.coupon.search')]) }}
        <div class="message-error">
            {{ $errors->first('folio', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row reference hide">
        <strong>{{ Form::label('reference', 'No. Tarjeta/No. de cheque/folio/referencia: ', ['class'=>'label50']) }}</strong>
        {{ Form::text('reference', null, ['class' => 'stopEnter', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off']) }}
        <a href="#" class="btn-blue" id="btn_show_customer" data-url="{{ route('api.customer.card.get') }}"><i class="fa fa-eye"></i></a>
        <div class="col col100">
            <div class="flo col50">&nbsp;</div>
            <div class="flo col50 cont-form-search">
                <div class="resultSearch globe-center hide" id="customer_search_and_add"></div>
            </div>
        </div>
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

        <div class="flo col50">
            <a href="{{ route('pay.pending') }}" class="btn-red">
                <i class="fa fa-arrow-left"></i>
                Volver a la caja
            </a>
        </div>

        <div class="flo col50 text-right">
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
        <p>
            <strong>¿Guardar pago?</strong>
        </p>

        <table class="table">
            <tbody class="text-left">
            <tr>
                <th>Método:</th>
                <td class="text-right">
                    <span id="c_m">Efectivo</span>
                </td>
            </tr>
            <tr>
                <th>Saldo:</th>
                <td class="text-right">
                    $
                    <span id="c_s">0.00</span>
                </td>
            </tr>
            <tr>
                <th>Pago:</th>
                <td class="text-right">
                    $
                    <span id="c_p">0.00</span>
                </td>
            </tr>
            <tr>
                <th>
                    <span id="l_c" data-default="Cambio:">Cambio:</span>
                </th>
                <td class="text-right">
                    $
                    <span id="c_c">0.00</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
