<table class="table">
    <thead>
    <tr>
        <th>Revisión</th>
        <th>Num. de Folio</th>
        <th>Proveedor</th>
        <th>Fecha de compra</th>
        <th>Total</th>
        <th>Estado</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $purchases as $purchase )
        <tr>
            <td class="text-center">
                @if ( $purchase->progress_1 AND $purchase->progress_2 AND $purchase->progress_3 AND !$purchase->progress_4 )
                    <i class="fa fa-check"></i>
                @else
                    <i class="fa fa-times"></i>
                @endif
            </td>
            <td class="text-right">{{ $purchase->folio }}</td>
            <td>{{ $purchase->provider->name }}</td>
            <td>{{ $purchase->date }}</td>
            <td class="text-right">$ {{ $purchase->total }}</td>
            <td>{{ $purchase->status }}</td>
            <td class="text-center">
                @include('purchase.partials.btn_show')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $purchases->links() }}
