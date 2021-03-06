<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Estatus</th>
        <th>Cliente</th>
        <th>Fecha de entrega</th>
        <th>
            <i class="fa fa-gears"></i>
            Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($results as $order)
        <tr>
            <td>{{ $order->folio }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <a href="{{ route('customer.show', [$order->customer->slug, $order->customer->id]) }}">
                    {{ $order->customer->name }}
                </a>
            </td>
            <td class="text-center">{{ $order->delivery_date }}</td>
            <td class="text-center">
                <nobr>
                    @include('order.partials.btn_show')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $results->appends(['terms' => $terms])->links() }}
