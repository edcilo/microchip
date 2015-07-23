@if($sale->data->warranty_id != 0 AND p(119))
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            Datos de garantía:
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="edc-hide-show-element col col100">

            <div class="flo col33 left">
                <ul>
                    <li>
                        <strong>Folio de venta:</strong>
                        <a href="{{ route('sale.show', $sale->data->warranty_id) }}">
                            {{ $sale->data->warranty->folio }}
                        </a>
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

            <div class="flo col33 right text-right">

                @if ($sale->status != 'Cancelado' AND !$sale->trash)
                    @include('warranty.partials.btn_create')
                    @section('warranty_fields')
                        {{ Form::hidden('service_id', $sale->id) }}
                    @endsection
                    @include('warranty.partials.form_create_float')
                @endif

            </div>

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
                            <td class="text-center">{{ date('d-m-Y H:i:s a', time($movement->date_warranty)) }}</td>
                        </tr>
                        @foreach( $movement->seriesOut as $series )
                            <tr>
                                <td></td>
                                <td><strong>S/N</strong> {{ $series->ns }}</td>
                                <td colspan="4"></td>
                            </tr>
                        @endforeach
                @endforeach
                </tbody>
            </table>

        </div>

    </div>
@endif
