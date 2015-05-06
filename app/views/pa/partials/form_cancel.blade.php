@if($order->order->classification != 'Venta' AND (p(113) OR p(90) OR p(102)) )

    <hr/>

    {{ Form::open(['route'=>['order.product.destroy', $order->id], 'method'=>'delete', 'class'=>'form']) }}



        <div class="flo col75 left text-right">
            @if($order->product->type == 'Producto')
                @if($order->product->p_description->have_series)

                    @if($order->order->classification == 'Pedido')
                        <a href="{{ route('series.create.separate', [$order->id]) }}" class="btn-green">N/S</a>
                    @else
                        <a href="{{ route('series.create.price', [$order->id]) }}" class="btn-green">N/S</a>
                    @endif
                    <div class="text-right">
                        Productos a desapartar:
                        @include('pa.partials.list_series')
                    </div>
                @else
                    Cantidad a desapartar:
                    {{ Form::text('quantity', 0, ['class'=>'xs-input text-right', 'autocomplete'=>'off', 'data-required'=>'required', 'data-integer-unsigned'=>'integer', 'title'=>'Este campo es obligatorio.']) }}
                @endif
            @else
                Cantidad a desapartar:
                {{ Form::text('quantity', 0, ['class'=>'xs-input text-right', 'autocomplete'=>'off', 'data-required'=>'required', 'data-integer-unsigned'=>'integer', 'title'=>'Este campo es obligatorio.']) }}
            @endif

        </div>

        <div class="flo col25 right">
            <button type="submit" class="btn-red">
                <i class="fa fa-times"></i> Desapartar
            </button>
        </div>


    {{ Form::close() }}

@endif
