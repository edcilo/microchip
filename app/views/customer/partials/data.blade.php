<div class="flo col33 left">

    <ul class="list-description">
        <li>
            <strong>Clasificación:</strong>
            {{ $customer->classification }}
        </li>
        <li>
            <strong>Nombre:</strong>
            {{ $customer->prefix }} {{ $customer->name }}
        </li>
        <li>
            <strong>R.F.C. ({{ $customer->legal_concept }}):</strong>
            {{ $customer->rfc }}
        </li>
        <li>
            <strong>Teléfonos:</strong>
            <ul>
                <li>{{ $customer->phone }}</li>
                <li>{{ $customer->cellphone }}</li>
            </ul>
        </li>
        <li>
            <strong>Correo electrónico:</strong>
            {{ $customer->email }}
        </li>
    </ul>

</div>

<div class="flo col33 center">

    <ul class="list-description">
        <li>
            <strong>País:</strong> {{ $customer->country }}
        </li>
        <li>
            <strong>Estado:</strong> {{ $customer->state }}
        </li>
        <li>
            <strong>Ciudad:</strong> {{ $customer->city }}
        </li>
        <li>
            <strong>C.P.:</strong> {{ $customer->postcode }}
        </li>
        <li>
            <strong>Colonia:</strong> {{ $customer->colony }}
        </li>
        <li>
            <strong>Dirección:</strong> {{ $customer->address }}
        </li>
        <li>
            <strong>Dirección de envios:</strong> {{ $customer->shipping_address }}
        </li>
    </ul>

</div>

<div class="flo col33 right">

    <ul class="list-description">
        <li>
            <strong>Limite de crédito:</strong>
            $ {{ number_format($customer->credit_limit, 2) }}
        </li>
        <li>
            <strong>Días de crédito:</strong>
            {{ $customer->credit_days }}
        </li>
    </ul>

    <hr/>

    <div class="flo col100">
        @if ( $customer->card_id != '' )

            @include('customer.partials.btn_card_edit')

            <ul class="list-description">
                <li>
                    <strong>No. de tarjeta:</strong>
                    {{ $customer->card_id }}
                </li>
                <li>
                    <strong>Pesos:</strong>
                    $ {{ number_format( $customer->points , 2 ) }}
                </li>
                <li>
                    <strong>Fecha de vencimiento:</strong>
                    {{ $customer->expiration_date }}
                </li>
            </ul>

        @else

            @include('customer.partials.btn_card')

        @endif
    </div>

</div>