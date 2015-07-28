@if(count($product->movements))

    <table class="table">
        <thead>
        <tr>
            <th>Cantidad</th>
            <th>Costo de entrada</th>
            <th>Costo de salida</th>
            <th>
                <i class="fa fa-gears"></i>
            </th>
        </tr>
        </thead>
        <tbody class="text-center">
        @foreach($product->movements as $movement)
            <tr class="{{ $movement->class_row_series }}">
                <td>{{ $movement->quantity }} {{ $movement->class_row_series }}</td>
                <td>$ {{ $movement->purchase_price }}</td>
                <td>$ {{ $movement->selling_price }}</td>
                <td class="text-center">
                    @if($movement->product->p_description->have_series)
                        <a href="{{ route('support.series.create', [$product->id, $movement->id]) }}" class="btn-green" title="Números de serie">N/S</a>
                    @endif

                    @include('movement.partials.btn_print')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endif