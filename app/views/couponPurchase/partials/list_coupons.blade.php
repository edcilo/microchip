<table class="table">
    <thead>
    <tr>
        <th>Disponibilidad</th>
        <th>Folio</th>
        <th>Valor</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coupons as $coupon)
        <tr>
            <td>
                @if($coupon->available)
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
            <td>{{ $coupon->folio }}</td>
            <td>$ {{ $coupon->value_f }}</td>
            <td>{{ $coupon->observations }}</td>
        </tr>
    @endforeach
    </tbody>
</table>