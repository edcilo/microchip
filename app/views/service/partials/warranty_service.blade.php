@if($sale->data->warranty_id != 0)
    <div class="col col100 block description-product edc-hide-show">

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

            <div class="flo col33 right">

                {{ Form::open(['route'=>'warranty.store', 'class'=>'form']) }}

                <div class="text-right">
                    {{ Form::text('series', null, ['placeholder' => 'Número de serie']) }}

                    <button class="btn-blue" title="Hacer valida la garantía">
                        <i class="fa fa-check"></i>
                        <i class="fa fa-truck"></i>
                    </button>
                </div>

                <div class="message-error">
                    {{ $errors->first('quantity', '<span>:message</span>') }}
                </div>

                {{ Form::close() }}

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
                        <td class="text-center">{{ $movement->date_warranty }}</td>
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
