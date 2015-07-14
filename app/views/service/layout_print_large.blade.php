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


<table class="border">
    <tr>
        <td>
            <strong>Folio:</strong>
            {{ $service->folio }}
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
                    <strong>Con atención a:</strong>
                    {{ $service->customer->prefix }}
                    {{ $service->customer->name }}
                </li>
                <li>
                    <strong>No. Cte:</strong>
                    {{ $service->customer->id }}
                </li>
                <li>
                    <strong>Telefono(s):</strong>
                    {{ $service->customer->phone }} - {{ $service->customer->cellphone }}
                </li>
                <li>
                    <strong>E-mail:</strong>
                    {{ $service->customer->email }}
                </li>
            </ul>
        </td>
        <td>
            <ul class="text-right unlist">
                <li>
                    <strong>Vend.</strong>
                    {{ $service->user->id }}
                </li>
            </ul>
        </td>
    </tr>
</table>


<table class="border">
    <tr>
        <td>
            <strong>Equipo que deja:</strong>
            {{ $service->data->equipment }}, {{ $service->data->mark }}, {{ $service->data->model }}
            {{ $service->data->series }}; {{ $service->data->details }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>Fallos y/o observaciones:</strong>
            {{ $service->data->observations }}
        </td>
    </tr>
    <tr>
        <td>
            <strong>Fecha y hora estimada de entrega:</strong>
            {{ $service->delivery_date }}; {{ $service->delivery_time }}
        </td>
    </tr>
</table>

<h2>
    Presupuesto
</h2>

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
    @foreach($service->pas as $pa)
        @if($pa->productPrice)
            <tr>
                <td class="text-center">
                    @if ($pa->product)
                        <img src="{{ asset($pa->product->image) }}" width="40px" alt="imagen">
                    @else
                        <img src="{{ asset($pa->image_link) }}" width="40px" alt="imagen">
                    @endif
                </td>
                <td class="text-center">{{ $pa->quantity }}</td>
                <td>{{ $pa->barcode}}</td>
                <td>
                    {{ $pa->s_description }}
                    @if ($pa->product)
                        <p>{{ $pa->product->description }}</p>
                    @else
                        <p>{{ $pa->l_description }}</p>
                    @endif
                </td>
                <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                <td class="text-right">$ {{ $pa->total_f }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
    <tfoot class="text-right">
    <tr>
        <td colspan="3"></td>
        <td><strong>Total (I.V.A. incluido):</strong></td>
        <td>$ {{ $service->total_price_f }}</td>
    </tr>
    </tfoot>
</table>


<div class="barcode">
    {{ DNS1D::getBarcodeHTML($service->folio, "C128", $configuration->width_real_bar_document_barcode, $configuration->height_real_document_barcode) }}
</div>

<br/>
<br/>
<br/>
<p class="text-center">
    <strong>Atendido por:</strong> <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    {{ $service->user->profile->name }} {{ $service->user->profile->f_last_name }} {{ $service->user->profile->s_last_name }}
</p>


<div class="text-center footer">
    <strong>Horarios: </strong> {{ $company->schedule }}
</div>
