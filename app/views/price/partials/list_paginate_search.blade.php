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
    @foreach($results as $price)
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
                    <a href="{{ route('price.show', [$price->folio, $price->id]) }}" class="btn-blue">
                        <i class="fa fa-eye"></i>
                    </a>
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>