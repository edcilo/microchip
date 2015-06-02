@foreach($services as $service)
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            {{ $service->folio }}
            ({{ $service->type }})
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
                </tr>
                </thead>
                <tbody>
                @foreach($service->movements as $movement)
                    <tr>
                        <td>{{ $movement->quantity }}</td>
                        <td>{{ $movement->product->barcode }}</td>
                        <td>{{ $movement->product->s_description }}</td>
                        <td class="text-right">$ {{ $movement->purchase_price }}</td>
                        <td class="text-right">$ {{ $movement->selling_price }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <hr/>

        </div>

        <table class="table">
            <tbody>
            <tr>
                <td>Total</td>
                <td class="text-right">$ {{ $service->total_services }}</td>
            </tr>
            <tr>
                <td>Participantes:</td>
                <td>
                    @foreach($service->staff as $user)
                        {{ $user }};
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>

    </div>
@endforeach