@if ( count($series) > 0 )

    <table class="table">
        <thead>
        <tr>
            <th>Número de serie</th>
            <th>Estado</th>
            <th>Factura</th>
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
                <td class="text-center">
                    <nobr>
                        <a class="btn-blue" href="{{ route('series.show', [$item->ns, $item->id]) }}">
                            <i class="fa fa-eye"></i>
                        </a>
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
