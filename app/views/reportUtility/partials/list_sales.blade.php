@foreach($sales as $sale)
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            @if($sale->service) Servicio @else Venta @endif {{ $sale->folio }}
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="table edc-hide-show-element hide">

            <table class="table">
                <thead>
                <tr>
                    <td>Cantidad</td>
                    <th>Clave</th>
                    <th>Descripción</th>
                    <th>P. Costo</th>
                    <th>P. Venta</th>
                    <th>Desc.</th>
                    <th>Utilidad</th>
                    <th>% Utilidad</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sale->movements as $movement)
                    <tr>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->product->barcode }}</td>
                        <td>{{ $movement->product->s_description }}</td>
                        <td class="text-right">$ {{ $movement->purchase_price }}</td>
                        <td class="text-right">$ {{ $movement->selling_price }}</td>
                        <td></td>
                        <td class="text-right">$ {{ $movement->utility }}</td>
                        <td class="text-right">{{ $movement->u_percentage }} %</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <hr/>

        </div>

        <table class="table">
            <tbody>
            <tr>
                <td>Precio total de compra</td>
                <td class="text-right">$ {{ $sale->total_purchase_f }}</td>
            </tr>
            <tr>
                <td>Precio total de venta</td>
                <td class="text-right">$ {{ $sale->total_f }}</td>
            </tr>
            <tr>
                <td>Gastos</td>
                <td class="text-right">$ {{ $sale->expenses_total }}</td>
            </tr>
            <tr>
                <td>Utilidad del documento</td>
                <td class="text-right">$ {{ number_format($sale->utility, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td>Porcentaje de utilidad</td>
                <td class="text-right">{{ number_format($sale->u_percentage, 2, '.', ',') }} %</td>
            </tr>
            </tbody>
        </table>

    </div>
@endforeach