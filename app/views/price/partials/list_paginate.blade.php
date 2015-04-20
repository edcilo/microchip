<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Estatus</th>
        <th>Cliente</th>
        <th>
            <i class="fa fa-gears"></i>
            Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($prices as $price)
        <tr>
            <td>{{ $price->folio }}</td>
            <td>{{ $price->status }}</td>
            <td>
                <a href="{{ route('customer.show', [$price->customer->slug, $price->customer->id]) }}">
                    {{ $price->customer->name }}
                </a>
            </td>
            <td class="text-center">
                <nobr>
                    @include('price.partials.btn_show')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>