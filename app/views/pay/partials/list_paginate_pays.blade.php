<table class="table">
    <thead>
    <tr>
        <th>Venta</th>
        <th>Monto</th>
        <th>Método</th>
        <th>No. de tarjeta/No. de cheque/Folio/Referencia</th>
        <th>Banco/IFE</th>
        <th>Descripción</th>
        <th>Fecha de pago</th>
        <th>
            <i class="fa fa-gears"></i>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($pays as $pay)
        <tr class="{{ $pay->class_row }}">
            <td>
                @if( $pay->sale )
                    <a href="{{ route('sale.show', [$pay->sale->folio, $pay->sale->id]) }}">
                        {{ $pay->sale->folio }}
                    </a>
                @endif
            </td>
            <td class="text-right">$ {{ $pay->amount - $pay->change }}</td>
            <td>{{ $pay->method }}</td>
            <td>{{ $pay->reference }}</td>
            <td>{{ $pay->entity }}</td>
            <td>@if($pay->concept) {{ $pay->concept->concept }}; @endif {{ $pay->description }}</td>
            <td class="text-center">{{ $pay->date_f }}</td>
            <td class="text-center">

                @if( $pay->sale )

                    @include('pay.partials.btn_edit')

                @elseif( $pay->amount > 0 )

                    @include('pay.partials.btn_edit_in')

                @elseif( $pay->amount < 0 )

                    @include('pay.partials.btn_edit_out')

                @endif

                @include('pay.partials.btn_destroy')

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $pays->links() }}
