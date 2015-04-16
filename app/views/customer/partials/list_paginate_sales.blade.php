<div class="col col100 block description-product edc-hide-show">

    <div class="subtitle">
        {{ $sales->getTotal() }} Ventas
        <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
    </div>

    <div class="table edc-hide-show-element hide">

        <table class="table">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Folio</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>
                    <i class="fa fa-gears"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->type }}</td>
                    <td>{{ $sale->folio }}</td>
                    <td>{{ $sale->status }}</td>
                    <td class="text-center">{{ $sale->created_at->format('h:m a / d-m-Y') }}</td>
                    <td class="text-center">
                        @include('sale.partials.btn_show')
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $sales->links(); }}

    </div>

</div>