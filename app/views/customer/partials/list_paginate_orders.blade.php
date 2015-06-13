@if($orders->getTotal())
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            {{ $orders->getTotal() }} Pedido(s)
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
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->type }}</td>
                        <td>{{ $order->classification }}</td>
                        <td>{{ $order->folio }}</td>
                        <td>{{ $order->status }}</td>
                        <td class="text-center">{{ $order->created_at->format('h:m a / d-m-Y') }}</td>
                        <td class="text-center">
                            @include('order.partials.btn_show')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $orders->links(); }}

        </div>

    </div>
@endif