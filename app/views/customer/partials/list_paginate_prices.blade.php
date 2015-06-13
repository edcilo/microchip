@if($prices->getTotal())
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            {{ $prices->getTotal() }} Cotizaciones(s)
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="table edc-hide-show-element hide">

            <table class="table">
                <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Documento</th>
                    <th>Folio</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>
                        <i class="fa fa-gears"></i>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($prices as $price)
                    <tr>
                        <td>{{ $price->type }}</td>
                        <td>{{ $price->classification }}</td>
                        <td>{{ $price->folio }}</td>
                        <td>{{ $price->status }}</td>
                        <td class="text-center">{{ $price->created_at->format('h:m a / d-m-Y') }}</td>
                        <td class="text-center">
                            @include('price.partials.btn_show')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $prices->links(); }}

        </div>

    </div>
@endif