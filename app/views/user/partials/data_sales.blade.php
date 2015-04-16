<div class="block description-product">

    <div class="subtitle">Lista de ventas</div>

    <table class="table">
        <thead>
        <tr>
            <th>Tipo</th>
            <th>Folio</th>
            <th>Fecha de venta</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sales as $sale)
            <tr class="text-center">
                <td class="text-left">{{ $sale->type }}</td>
                <td>
                    <a href="{{ route('sale.show', [$sale->folio, $sale->id]) }}">
                        {{ $sale->folio }}
                    </a>
                </td>
                <td>{{ $sale->created_at->format('h:m:i A / d-m-Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $sales->links() }}

</div>
