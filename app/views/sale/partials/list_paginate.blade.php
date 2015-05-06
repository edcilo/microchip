<table class="table">
    <thead>
    <tr>
        <th>Tipo</th>
        <th>Estatus</th>
        <th>Folio</th>
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
            <td><span class="@if ( $sale->status == 'Cancelado' ) text-red @endif">{{ $sale->status }}</span></td>
            <td class="text-center">{{ $sale->folio }}</td>
            <td class="text-center">{{ $sale->created_at->format('h:i:s a - d-m-Y') }}</td>
            <td class="text-center">
                <nobr>
                    @include('sale.partials.btn_show')

                    @include('sale.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $sales->links() }}
