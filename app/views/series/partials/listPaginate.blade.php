@if ( count($series) > 0 )

    <table class="table">
        <thead>
        <tr>
            <th>Número de serie</th>
            <th>Estado</th>
            <th>No. Compra</th>
            <th>No. Venta</th>
            <th>
                <i class="fa fa-gears"></i>
                Opciones
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach( $series as $item )
            <tr>
                <td>{{ $item->ns }}</td>
                <td>{{ $item->status }}</td>
                <td>
                    @if ( count($item->movement->purchases) > 0 )
                        <a href="{{ route('purchase.show', [$item->movement->purchases[0]->folio, $item->movement->purchases[0]->id]) }}">
                            {{ $item->movement->purchases[0]->folio }}
                        </a>
                    @else
                        Agregado directamente al inventario.
                    @endif
                </td>
                <td>
                    @if(is_object($item->movementOut) AND count($item->movementOut->sales) > 0)
                        <a href="{{ route('sale.show', [$item->movementOut->sales[0]->id]) }}">
                            {{ $item->movementOut->sales[0]->folio }}
                        </a>
                        [Venta]
                    @elseif(is_object($item->separated))
                        <a href="{{ route('order.show', [$item->separated->order->id]) }}">
                            {{ $item->separated->order->folio }}
                        </a>
                        [{{ $item->separated->order->classification }}]
                    @endif
                </td>
                <td class="text-center">
                    <nobr>
                        <a class="btn-blue" title="Ver detalles" href="{{ route('series.show', [$item->ns, $item->id]) }}">
                            <i class="fa fa-eye"></i>
                        </a>

                        @include('series.partials.btn_print', ['series' => $item])

                    </nobr>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $series->links() }}

@else

    <p class="title-clear">No hay números de serie registrados.</p>

@endif
