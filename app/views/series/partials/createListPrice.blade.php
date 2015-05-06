@if ( count($price->series) > 0 )
    <div class="subtitle">Numeros de serie registrados en este apartado:</div>

    @if ( Session::get('message') )
        <aside class="msg_dialog">{{ Session::get('message') }}</aside>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>Numero de serie</th>
            <th>Estado</th>
            <th>Producto</th>
            <th>Factura de compra</th>
            <th>
                <i class="fa fa-gears"></i>
                Opciones
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($price->series as $series)
            <tr>
                <td>{{ $series->ns }}</td>
                <td>{{ $series->status }}</td>
                <td>
                    <a href="{{ route('product.show', [$series->product->barcode, $series->product->id]) }}">
                        {{ $series->product->barcode }}
                    </a>
                </td>
                <td>
                    @if ( count($series->movement->purchases) > 0 )
                        <a href="{{ route('purchase.show', [$series->movement->purchases[0]->folio, $series->movement->purchases[0]->id]) }}">
                            {{ $series->movement->purchases[0]->folio }}
                        </a>
                    @else
                        Agregado directamente al inventario.
                    @endif
                </td>
                <td class="">
                    <a class="btn-blue" href="{{ route('series.show', [$series->ns, $series->id]) }}">
                        <i class="fa fa-eye"></i>
                    </a>

                    @if( $series->status == 'Disponible' )
                        {{ Form::open(['route'=>['series.destroy', $series->id], 'method'=>'delete', 'class'=>'form validate inline']) }}
                        <button type="submit" class="btn-red">
                            <i class="fa fa-times"></i>
                        </button>
                        {{ Form::close() }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endif
