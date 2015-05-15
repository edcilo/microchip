<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Valor</th>
        <th>Proveedor</th>
        <th>Descripción</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($coupons as $coupon)
        <tr>
            <td>{{ $coupon->folio }}</td>
            <td>$ {{ $coupon->value }}</td>
            <td>{{ $coupon->provider->name }}</td>
            <td>{{ $coupon->observations }}</td>
            <td class="text-center">
                @include('couponPurchase.partials.btn_show')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $coupons->links() }}
