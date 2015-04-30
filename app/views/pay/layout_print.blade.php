<p>{{ $company->name }}</p>

<ul class="unlist">
    <li>{{ $company->owner }}</li>
    <li>{{ $company->rfc }}</li>
    <li>{{ $company->address }}, {{ $company->colony }}</li>
    <li>{{ $company->city }}, {{ $company->state }}</li>
    <li>Tel. {{ $company->phone_1 }} y {{ $company->phone_2 }}</li>
    <li>{{ $company->web }}</li>
</ul>

@include('layouts.partials.style_print')

<p>
    Recibi la cantidad de $ {{ $sale->user_total_pay_f }} pesos ({{ $sale->total_text }}), por concepto de:
</p>

<p>{{ $concept }}</p>

<p>RECIBI</p>

<br/>
<br/>
<br/>

<div class="line_sign"></div>

@if( $sale->customer->id == 1 )
    Nombre y firma del cliente
@else
    {{ $sale->customer->name }}
@endif
