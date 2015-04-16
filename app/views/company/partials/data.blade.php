<div class="col col100">

    <figure class="flo col25 left">
        <img src="{{ asset($company->photo) }}" alt="{{ $company->name }}"/>
    </figure>

    <div class="flo col75 right">

        <ul>
            <li>
                <strong>Nombre de la empresa:</strong>
                {{ $company->name }}
            </li>
            <li>
                <strong>Nombre del representante:</strong>
                {{ $company->owner }}
            </li>
            <li>
                <strong>R.F.C.:</strong>
                {{ $company->rfc }}
            </li>
        </ul>

    </div>

</div>

<div class="col col100">
    <hr/>

    <div class="flo col50 left">
        <ul>
            <li>
                <strong>Dirección:</strong>
                {{ $company->address }}, {{ $company->colony }}, {{ $company->city }}, {{ $company->entity }}.
            </li>
            <li>
                <strong>Teléfonos:</strong>
                <ul>
                    <li>{{ $company->phone_1 }}</li>
                    <li>{{ $company->phone_2 }}</li>
                    <li>{{ $company->phone_3 }}</li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="flo col50 right">
        <ul>
            <li>
                <strong>Correo electronico:</strong>
                {{ $company->email }}
            </li>
            <li>
                <strong>Página web:</strong>
                {{ $company->web }}
            </li>
        </ul>
    </div>
</div>

<div class="col col100">
    <hr/>

    <div class="flo col50">
        <ul>
            <li><strong>Servicios:</strong>
                <ul>
                    @foreach( $services as $service )
                        <li>{{ $service }}</li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>

    <div class="flo col50">
        <ul>
            <li>
                <strong>Horarios:</strong>
                {{ $company->schedule }}
            </li>
            <li>
                <strong>Notas:</strong>
                {{ $company->note }}
            </li>
        </ul>
    </div>
</div>