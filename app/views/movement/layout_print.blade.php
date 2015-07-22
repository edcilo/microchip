@include('layouts.partials.style_print')

<h2>Movimiento de inventario No. {{ $movement->id }}</h2>

<strong>Emitido por:</strong> {{ $movement->user }}

<table class="table">
    <thead>
    <tr>
        <th>Movimiento</th>
        <th>Fecha</th>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Costo de entrada</th>
        <th>Costo de salida</th>
    </tr>
    </thead>
    <tbody>
    <tr class="text-center">
        <td>@if ( $movement->status == 'in' ) Entrada @else Salida @endif</td>
        <td>{{ $movement->created_at->format('h:i:s A / d-m-Y') }}</td>
        <td>{{ $movement->quantity }}</td>
        <td>{{ $movement->product->barcode }}</td>
        <td>$ {{ $movement->purchase_price_f }}</td>
        <td>$ {{ $movement->selling_price_f }}</td>
    </tr>
    </tbody>
</table>

<p class="text-left">
    <strong>Descripción:</strong>
    {{ $movement->description }}
</p>

@if($movement->product->type == 'Producto' AND $movement->product->p_description->have_series)

    <p class="text-left">
        <strong>Números de serie:</strong>
    </p>

    @if($movement->series->count() OR $movement->seriesOut->count())
        <ul class="text-left">
            @if($movement->status == 'in')
                @foreach($movement->series as $series)
                    <li>{{ $series->ns }}</li>
                @endforeach
            @else
                @foreach($movement->seriesOut as $series)
                    <li>{{ $series->ns }}</li>
                @endforeach
            @endif
        </ul>
    @endif

    @if(
        ($movement->status == 'in' AND $movement->series->count() != $movement->quantity)
        OR
        ($movement->status == 'out' AND $movement->seriesOut->count() != $movement->quantity)
    )
        <em>Aún no se han terminado de registrar los números de serie.</em>
    @endif

@endif