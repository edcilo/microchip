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
            <ul class="unlist">
                <li>
                    <strong>Folio:</strong>
                    {{ $warranty->folio }}
                </li>
                <li>
                    <strong>Fecha:</strong>
                    {{ $warranty->created_at->format('d-m-Y') }}
                </li>
                <li>
                    <strong>Fecha de envio:</strong>
                    {{ date('d-m-Y', time($warranty->sent_at)) }}
                </li>
            </ul>
        </td>
        <td class="text-right">
            <ul class="unlist">
                <li>
                    <strong>Procesa garantía:</strong>
                    {{ $warranty->createdBy->profile->full_name }}
                </li>
                <li>
                    <strong>Envía garantía:</strong>
                    {{ $warranty->sentBy->profile->full_name }}
                </li>
            </ul>
        </td>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>Producto</th>
        <th>Núm. de serie</th>
        <th>Descripción del producto</th>
        <th>Precio (I.V.A. incluido)</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            {{ $warranty->series->product->barcode }}
        </td>
        <td>
            {{ $warranty->series->ns }}
        </td>
        <td>
            {{ $warranty->series->product->s_description }}
        </td>
        <td>
            $ {{ $warranty->series->movement->purchase_price_with_iva_f }}
        </td>
    </tr>
    </tbody>
</table>

<table>
    <tr>
        <td>
            <ul class="unlist">
                <li>
                    <strong>Descripción de falla:</strong>
                    {{ $warranty->description }}
                </li>
            </ul>
        </td>
    </tr>
</table>

<table>
    <tr>
        <td>
            <ul class="unlist">
                <li>
                    <strong>Datos de la compra</strong>
                </li>
                <li>
                    <strong>Folio de compra:</strong>
                    {{ $warranty->purchase->folio }}
                </li>
                <li>
                    <strong>Fecha de compra:</strong>
                    {{ $warranty->purchase->date }}
                </li>
                <li>
                    <strong>Proveedor:</strong>
                    {{ $warranty->purchase->provider->name }}
                </li>
            </ul>
        </td>
    </tr>
</table>

<p>Recibe producto ({{ $warranty->purchase->provider->name }})</p>

<br/>
<br/>
<br/>
<br/>

<div class="line_sign"></div>

Nombre, Fecha y Firma