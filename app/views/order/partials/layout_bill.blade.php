<div id="header">
    <table>
        <tr>
            <td>
                <img src="{{ asset($company->photo) }}" alt="Logotipo"/>
            </td>
            <td>
                <ul class="unlist">
                    <li>{{ $company->web }}</li>
                    <li><strong>Correo:</strong> {{ $company->email }}</li>
                    <li><strong>Tels.</strong>{{ $company->phone_1 }} y {{ $company->phone_2 }}, {{ $company->phone_3 }}</li>
                    <li>{{ $company->address }}, {{ $company->colony }}; {{ $company->city }}, {{ $company->state }}</li>
                </ul>
            </td>
            <td>
                <strong>Servicios:</strong> <br/>
                <ul class="unlist">
                    <li>{{ $company->services }}</li>
                </ul>
            </td>
        </tr>
    </table>
</div>


<table>
    <tr>
        <td>
            <strong>Folio:</strong>
            {{ $order->folio }}
        </td>
        <td class="text-right">
            <strong>Fecha:</strong>
            {{ date( 'd/M/Y h:m a', time()) }}
        </td>
    </tr>
    <tr>
        <td>
            <ul class="unlist">
                <li>
                    <strong>No. Cte:</strong>
                    {{ $order->customer->id }}
                </li>
                <li>
                    <strong>Razón Social:</strong>
                    {{ $order->customer->prefix }}
                    {{ $order->customer->name }}
                </li>
                <li>
                    <strong>Dirección:</strong>
                    {{ $order->customer->address }}, {{ $order->customer->colony }}, C.P. {{ $order->customer->postal_code }}; {{ $order->customer->city }}, {{ $order->customer->entity }}
                </li>
                <li>
                    <strong>Telefono(s):</strong>
                    {{ $order->customer->phone }} - {{ $order->customer->cellphone }}
                </li>
                <li>
                    <strong>E-mail:</strong>
                    {{ $order->customer->email }}
                </li>
            </ul>
        </td>
        <td>
            <ul class="text-right unlist">
                <li>
                    <strong>Vend.</strong>
                    {{ $order->user->id }}
                </li>
                <li>
                    <strong>Vendedor:</strong>
                    {{ $order->user->profile->name }} {{ $order->user->profile->f_last_name }} {{ $order->user->profile->s_last_name }}
                </li>
                <li>
                    <strong>Fecha de entrega:</strong>
                    {{ $order->delivery_date }}
                </li>
                @if($order->shipping_address != '')
                <li>
                    <strong>Dirección de envio:</strong>
                    {{ $order->shipping_address }}
                </li>
                @endif
            </ul>
        </td>
    </tr>
</table>


<table>
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cost. unit.</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->pas as $pa)
        @if($pa->status != 'Surtido' AND $pa->productOrder AND !$pa->soft_delete)
        <tr>
            <td class="text-right">{{ $pa->quantity }}</td>
            <td>{{ $pa->barcode}}</td>
            <td>{{ $pa->s_description }}</td>
            <td class="text-right">$ {{ $pa->selling_price_f }}</td>
            <td class="text-right">$ {{ $pa->total_f }}</td>
        </tr>
        @endif
    @endforeach
    </tbody>
    <tfoot class="text-right">
    <tr>
        <td colspan="3"></td>
        <td><strong>Total:</strong></td>
        <td>$ {{ $order->total_order_f }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td><strong>Anticipo:</strong></td>
        <td>$ {{ $order->advance_f }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td><strong>Saldo:</strong></td>
        <td>$ {{ $order->rest_f }}</td>
    </tr>
    </tfoot>
</table>


<div class="barcode">
    {{ DNS1D::getBarcodeHTML($order->folio, "C128", $configuration->width_real_bar_document_barcode, $configuration->height_real_document_barcode) }}
</div>



<div class="text-center footer">
    <strong>Horarios: </strong> {{ $company->schedule }}
</div>
