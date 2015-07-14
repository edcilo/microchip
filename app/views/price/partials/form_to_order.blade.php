@if( p(110) )
    {{ Form::open(['route'=>['price.to.order', $sale->id], 'method'=>'post', 'class'=>'form']) }}
@endif

<div class="col col100">
    <table class="table">
        <thead>
        <tr>
            @if( p(110) )
                <th>Pedir</th>
            @endif
            <th>Cantidad</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cost. unit.</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sale->pas as $pa)
            @if($pa->productPrice)
                <tr>
                    @if( p(110) )
                        <td class="text-center">
                            {{ Form::checkbox('ids[]', $pa->id, false) }}
                        </td>
                    @endif
                    <td class="text-center">
                        @if( p(110) )
                            {{ Form::text('quantity[]', $pa->quantity_price, ['class'=>'xs-input text-right']) }}
                        @else
                            {{ $pa->quantity_price }}
                        @endif
                    </td>
                    <td>{{ $pa->barcode}}</td>
                    <td>{{ $pa->s_description }}</td>
                    <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                    <td class="text-right">$ {{ $pa->total_f }}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
        <tfoot class="text-right">
        <tr>
            @if( p(110) )
                <td></td>
            @endif
            <td colspan="3"></td>
            <td><strong>Total (I.V.A. incluido):</strong></td>
            <td>$ {{ $sale->total_price_f }}</td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="message-error">
    {{ $errors->first('quantity', '<span>:message</span>') }}
</div>

<div class="col col100">

    <div class="flo col33">
        @if( p(110) )
            <button class="btn-green form_confirm" data-confirm="order_confirm">
                <i class="fa fa-file-o"></i>
                Crear orden de pedido
            </button>
        @else
            &nbsp;
        @endif
    </div>

    <div class="flo col33 center text-center">
        @include('price.partials.btn_print_large')

        @include('price.partials.btn_print')
    </div>

    <div class="flo col33 text-right">
        @include('price.partials.btn_clone')
    </div>

</div>

@if( p(110) )
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Crear orden de pedido" id="order_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer crear la orden de pedido de la cotización {{ $sale->folio }}?</h3>
        </div>
    </div>

@endif
