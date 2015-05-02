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


<p class="text-left">
    Vale por $ {{ $coupon->value_f }} ({{ $coupon->value_text }}) por concepto de cancelación
    @if( $coupon->sale->classification == 'Venta' )
        de la
    @else
        del
    @endif
    {{ $coupon->sale->classification }} con número de
    folio {{ $coupon->sale->folio }}
</p>

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
    @foreach($coupon->sale->movements as $movement)
        <tr>
            <td class="text-right">{{ $movement->quantity }}</td>
            <td>{{ $movement->product->barcode}}</td>
            <td>{{ $movement->product->s_description }}</td>
            <td class="text-right">$
                @if($coupon->sale->new_price == 0)
                    {{ $movement->selling_price_without_iva_f }}
                @else
                    {{ $movement->selling_price_w_i_p }}
                @endif
            </td>
            <td class="text-right">$
                @if($coupon->sale->new_price == 0)
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
        <td><strong>Total:</strong></td>
        @if( $coupon->sale->new_price == 0 )
            <td>$ {{ $coupon->sale->total_f }}</td>
        @else
            <td>$ {{ $coupon->sale->total_p }}</td>
        @endif
    </tr>
    </tfoot>
</table>


<div class="barcode">
    {{ DNS1D::getBarcodeHTML($coupon->id, "C128", 1, 20) }}
</div>
<p>
    <strong>Vale: {{ $coupon->folio }}</strong>
</p>


<br/>
<br/>
<br/>
<p>
    <strong>Condiciones:</strong> {{ $coupon->coupon_terms_use }} <br/>
    @if($coupon->last_date)
        Valido hasta {{ $coupon->last_date->format('d/m/Y') }}
    @endif
</p>


<br/>
<br/>
<br/>
<div class="text-center">
    <strong>Horarios: </strong> {{ $company->schedule }}
</div>