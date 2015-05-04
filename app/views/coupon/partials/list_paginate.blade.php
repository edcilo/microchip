<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Pendiente</th>
        <th>Valor</th>
        <th>Fecha de vencimiento</th>
        <th>Cliente</th>
        <th>Tipo de documento</th>
        <th>Folio</th>
        <th>
            <i class="fa fa-gears"></i>
        </th>
    </tr>
    </thead>
    <tbody class="text-center">
    @foreach($coupons as $coupon)
        <tr>
            <td>{{ $coupon->folio }}</td>
            <td>
                @if( $coupon->available )
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times" title="Pagado"></i>
                @endif
            </td>
            <td>${{ $coupon->value_f }}</td>
            <td>
                @if( $coupon->last_date )
                    {{ $coupon->last_date }}
                @else
                    Indefinido
                @endif
            </td>
            <td class="text-left">
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
                @include('coupon.partials.btn_show')

                @include('coupon.partials.btn_print')

                @include('coupon.partials.btn_destroy')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>