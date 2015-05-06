<table class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Fecha de vencimiento</th>
        <th>Días de vigencia</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <strong>
                <a href="{{ route('customer.show', [$customer->referrer->customer->slug, $customer->referrer->customer->id]) }}">
                    {{ $customer->referrer->customer->name }}
                </a>
            </strong>
        </td>
        <td class="text-center">
            {{ $customer->referrer->expiration_date }}
        </td>
        <td class="text-right">
            {{ $customer->referrer->expiration }} días
        </td>
    </tr>
    </tbody>
</table>
