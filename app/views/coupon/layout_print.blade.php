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

@if ($coupon->sale->classification == 'Venta')

    @include('coupon.partials.list_movements')

@else

    @include('coupon.partials.list_products_order')

@endif

<div class="barcode">
    {{ DNS1D::getBarcodeHTML($coupon->id, "C128", 1, 20) }}
</div>
<p>
    <strong>Vale: {{ $coupon->folio }}</strong>
</p>


<br/>
<br/>
<br/>
<table class="text-center">
    <tr>
        <td>
            <strong>Atendido por:</strong> <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="line_sign"></div>
            {{ Auth::user()->profile->name }}
            {{ Auth::user()->profile->f_last_name }}
            {{ Auth::user()->profile->s_last_name }}
        </td>
        <td>
            <strong>Recibe:</strong> <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="line_sign"></div>
            {{ $coupon->sale->customer->name }}
        </td>
    </tr>
</table>


<br/>
<br/>
<br/>
<p>
    @if($coupon->coupon_terms_use)
        <strong>Condiciones:</strong> {{ $coupon->coupon_terms_use }} <br/>
    @endif
    @if($coupon->last_date)
        Valido hasta {{ $coupon->last_date->format('d/m/Y') }}
    @endif
</p>


<div class="text-center footer">
    <strong>Horarios: </strong> {{ $company->schedule }}
</div>
