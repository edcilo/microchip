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
            {{ $price->folio }}
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
                    {{ $price->customer->prefix }}
                    {{ $price->customer->name }}
                </li>
                <li>
                    <strong>No. Cte:</strong>
                    {{ $price->customer->id }}
                </li>
                <li>
                    <strong>Telefono(s):</strong>
                    {{ $price->customer->phone }} - {{ $price->customer->cellphone }}
                </li>
                <li>
                    <strong>E-mail:</strong>
                    {{ $price->customer->email }}
                </li>
            </ul>
        </td>
        <td>
            <ul class="text-right unlist">
                <li>
                    <strong>Vend.</strong>
                    {{ $price->user->id }}
                </li>
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
    @foreach($price->pas as $pa)
        @if($pa->productPrice)
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
        <td>$ {{ $price->total_price_f }}</td>
    </tr>
    </tfoot>
</table>


<div class="barcode">
    {{ DNS1D::getBarcodeHTML($price->folio, "C128", 1, 20) }}
</div>

<br/>
<br/>
<br/>
<p>
    <strong>Atendido por:</strong> <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    {{ $price->user->profile->name }} {{ $price->user->profile->f_last_name }} {{ $price->user->profile->s_last_name }}
</p>

<div id="footer" class="text-center">
    <strong>Horarios: </strong> {{ $company->schedule }}
</div>