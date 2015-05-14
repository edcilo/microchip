<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Valor</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coupons as $coupon)
        <tr>
            <td>{{ $coupon->folio }}</td>
            <td>$ {{ $coupon->value_f }}</td>
            <td>{{ $coupon->observations }}</td>
        </tr>
    @endforeach
    </tbody>
</table>