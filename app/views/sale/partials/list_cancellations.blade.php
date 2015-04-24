<table class="table">
    <thead>
    <tr>
        <th>Tipo</th>
        <th>Documento</th>
        <th>Folio</th>
        <th>Estatus</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $sales as $sale )
        <tr>
            <td>{{ $sale->type }}</td>
            <td>{{ $sale->classification }}</td>
            <td class="text-center">{{ $sale->folio }}</td>
            <td><span class="@if ( $sale->status == 'Cancelado' ) text-red @endif">{{ $sale->status }}</span></td>
            <td>
                <a href="{{ route('customer.show', [$sale->customer->slug, $sale->customer->id]) }}">
                    {{ $sale->customer->name }}
                </a>
            </td>
            <td class="text-center">{{ $sale->created_at->format('h:i:s a - d-m-Y') }}</td>
            <td class="text-center">
                <nobr>
                    @if($sale->classification == 'Venta')
                        @include('sale.partials.btn_show')
                    @elseif($sale->classification == 'Pedido')
                        @include('order.partials.btn_show', ['order' => $sale])
                    @elseif($sale->classification == 'Servicio')
                        @include('service.partials.btn_show', ['service' => $sale])
                    @endif
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $sales->links() }}

