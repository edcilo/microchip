@if($sale->data->warranty_id != 0)
    <div class="col col100 edc-hide-show">

        <div class="subtitle">
            <strong>Datos de garantía:</strong>
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="edc-hide-show-element col col100">

            <div class="flo col33 left">
                <ul>
                    <li>
                        <strong>Folio:</strong>
                        {{ $sale->data->warranty->folio }}
                    </li>
                </ul>
            </div>

            <div class="flo col33 center">
                <ul>
                    <li>
                        <strong>Fecha de venta:</strong>
                        {{ date( 'd/M/Y', time($sale->data->warranty->created_at)) }}
                    </li>
                </ul>
            </div>

            <div class="flo col33 right"></div>

            @if($sale->data->warranty->movements->count())
                <table class="table">
                    <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Garantía valida hasta</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sale->data->warranty->movements as $movement)
                        <tr class="{{ $movement->class_row }}">
                            <td class="text-right">{{ $movement->quantity }}</td>
                            <td>{{ $movement->product->barcode}}</td>
                            <td>{{ $movement->product->s_description }}</td>
                            <td class="text-center">{{ date('d-m-Y h:i:s a', time($movement->date_warranty)) }}</td>
                        </tr>
                        @foreach( $movement->seriesOut as $series )
                            <tr>
                                <td></td>
                                <td><strong>S/N</strong> {{ $series->ns }}</td>
                                <td colspan="3"></td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="col col100">
                    <p class="title-clear">Esta venta no tiene productos registrados.</p>
                </div>
            @endif

        </div>

    </div>
@endif
