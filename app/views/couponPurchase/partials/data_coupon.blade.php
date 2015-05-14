<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Valor</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $coupon->folio }}</td>
        <td>$ {{ $coupon->value_f }}</td>
        <td>{{ $coupon->observations }}</td>
    </tr>
    </tbody>
</table>