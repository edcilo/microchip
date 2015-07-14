@include('layouts.partials.style_print')


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
            {{ $sale->folio }}
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
                    {{ $sale->customer->id }}
                </li>
                <li>
                    <strong>Razón Social:</strong>
                    {{ $sale->customer->name }}</li>
                <li>
                    <strong>RFC:</strong>
                    {{ $sale->customer->rfc }}
                </li>
                <li>
                    <strong>Dirección:</strong>
                    {{ $sale->customer->address }}, {{ $sale->customer->colony }}, C.P. {{ $sale->customer->postal_code }}; {{ $sale->customer->city }}, {{ $sale->customer->entity }}
                </li>
                <li>
                    <strong>Telefono(s):</strong>
                    {{ $sale->customer->phone }} - {{ $sale->customer->cellphone }}
                </li>
                <li>
                    <strong>E-mail:</strong>
                    {{ $sale->customer->email }}
                </li>
            </ul>
        </td>
        <td>
            <ul class="text-right unlist">
                <li>
                    <strong>Vend.</strong>
                    {{ $sale->user->id }}
                </li>
                <li>
                    <strong>Vendedor:</strong>
                    {{ $sale->user->profile->name }} {{ $sale->user->profile->f_last_name }} {{ $sale->user->profile->s_last_name }}
                </li>
            </ul>
        </td>
    </tr>
</table>


<table>
    <thead>
    <tr>
        <th></th>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cost. unit.</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sale->movements as $movement)
        <tr>
            <td class="text-center">
                <img src="{{ asset($movement->product->image) }}" width="40px" alt="imagen">
            </td>
            <td class="text-center">{{ $movement->quantity }}</td>
            <td>{{ $movement->product->barcode}}</td>
            <td>
                {{ $movement->product->s_description }}
                <p>{{ $movement->product->description }}</p>
            </td>
            <td class="text-right">$
                @if($sale->new_price == 0)
                    {{ $movement->selling_price_without_iva_f }}
                @else
                    {{ $movement->selling_price_w_i_p }}
                @endif
            </td>
            <td class="text-right">$
                @if($sale->new_price == 0)
                    {{ $movement->total_without_iva_f }}</td>
            @else
                {{ $movement->total_price_w_i_p }}
            @endif
        </tr>
        @if($movement->product->type == 'Producto')
            @if($movement->product->p_description->have_series)
                <tr>
                    <td></td>
                    <td colspan="2"><strong>S/N</strong>
                        @foreach( $movement->seriesOut as $series )
                            {{ $series->ns }};
                        @endforeach
                    </td>
                    <td colspan="2"></td>
                </tr>
            @endif
        @endif
    @endforeach
    </tbody>
    <tfoot class="text-right">
    <tr>
        <td colspan="3"></td>
        <td><strong>Subtotal:</strong></td>
        @if( $sale->new_price == 0 )
            <td>$ {{ $sale->subtotal_f }}</td>
        @else
            <td>$ {{ $sale->subtotal_p }}</td>
        @endif
    </tr>
    <tr>
        <td colspan="3"></td>
        <td><strong>I.V.A. (%):</strong></td>
        <td>{{ $sale->iva }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td><strong>Total:</strong></td>
        @if( $sale->new_price == 0 )
            <td>$ {{ $sale->total_f }}</td>
        @else
            <td>$ {{ $sale->total_p }}</td>
        @endif
    </tr>
    <tr>
        <td colspan="5" class="text-center"><em>{{ $sale->total_text }}</em></td>
    </tr>
    </tfoot>
</table>


<div class="barcode">
    {{ DNS1D::getBarcodeHTML($sale->folio, "C128", $configuration->width_real_bar_document_barcode, $configuration->height_real_document_barcode) }}
</div>



<div class="footer text-center">
    <strong>Horarios: </strong> {{ $company->schedule }}
</div>
