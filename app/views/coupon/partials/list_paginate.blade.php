<table class="table">
    <thead>
    <tr>
        <td>Folio</td>
        <td>Pendiente</td>
        <td>Valor</td>
        <td>Fecha de vencimiento</td>
        <td>Cliente</td>
        <td>Tipo de documento</td>
        <td>Folio</td>
        <td>
            <i class="fa fa-gears"></i>
        </td>
    </tr>
    </thead>
    <tbody>
    @foreach($coupons as $coupon)
        <tr>
            <td>{{ $coupon->folio }}</td>
            <td>{{ $coupon->available }}</td>
            <td>${{ $coupon->value_f }}</td>
            <td>
                @if( $coupon->last_date )
                    {{ $coupon->last_date }}
                @else
                    Indefinido
                @endif
            </td>
            <td>
                <a href="{{ route('customer.show', [$coupon->customer->slug, $coupon->customer->id]) }}">
                    {{ $coupon->customer->name }}
                </a>
            </td>
            <td>{{ $coupon->sale->classification }}</td>
            <td>
                <a href="
                    @if($coupon->sale->classification == 'Venta')
                        {{ route('sale.show', $coupon->sale->id) }}
                    @elseif($coupon->sale->classification == 'Pedido')
                        {{ route('order.show', $coupon->sale->id) }}
                    @else
                        {{ route('service.show', $coupon->sale->id) }}
                    @endif
                ">
                    {{ $coupon->sale->folio }}
                </a>
            </td>
            <td>
                @include('coupon.partials.btn_print')
                
                @include('coupon.partials.btn_destroy')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>