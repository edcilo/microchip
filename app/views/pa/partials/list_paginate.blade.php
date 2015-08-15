<table class="table">
    <thead>
    <tr>
        <th>Folio doc.</th>
        <th>Tipo</th>
        <th>Código de barras</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>
            <i class="fa fa-gears"></i>
            Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($pas as $pa)
        @if($pa->status != 'Surtido')
            <tr>
                <td>
                    <a href="
                        @if($pa->sale->classification == 'Venta')
                            {{ route('sale.show', [$pa->sale->id]) }}
                        @elseif($pa->sale->classification == 'Pedido')
                            {{ route('order.show', [$pa->sale->id]) }}
                        @elseif($pa->sale->classification == 'Cotización')
                            {{ route('price.show', [$pa->sale->id]) }}
                        @else
                            {{ route('service.show', [$pa->sale->id]) }}
                        @endif
                            ">
                        {{ $pa->sale->folio }}
                    </a>
                </td>
                <td>{{ $pa->sale->classification }}</td>
                <td>{{ $pa->barcode }}</td>
                <td>{{ $pa->s_description }}</td>
                <td class="text-right">{{ $pa->quantity }}</td>
                <td class="text-center">
                    <nobr>
                        @include('pa.partials.btn_show')
                    </nobr>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

{{ $pas->links() }}
