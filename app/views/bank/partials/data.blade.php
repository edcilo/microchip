<div class="col col100">
    <div class="flo col25 left">
        <h3>Inf. bancaria</h3>
        <hr/>
        <ul class="list-description">
            <li>
                <strong>Nombre del banco:</strong>
                {{ $bank->name }}
            </li>
            <li>
                <strong>Sucursal:</strong>
                {{ $bank->branch }}
            </li>
            <li>
                <strong>Número de cuenta:</strong>
                {{ $bank->number_account }}
            </li>
            <li>
                <strong>CLABE:</strong>
                {{ $bank->clabe }}
            </li>
            <li>
                <strong>Saldo:</strong>
                $ {{ $bank->total }}
            </li>
            @if( p(16) )
                <li>
                    <a href="{{ route('bankCount.index', $bank->id) }}">
                        Estado de cuenta
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <div class="flo col25 center">
        <h3>Terminal</h3>
        <hr/>
        <ul class="list-description">
            <li>
                <strong>¿Cuenta con terminal?</strong>
                {{ ( $bank->terminal_i ) }}
            </li>
            @if ( $bank->terminal )
                <li>
                    <strong>Cargo por tarjeta de débito:</strong>
                    {{ $bank->commission_debit_f }} %
                </li>
                <li>
                    <strong>Cargo por tarjeta de crédito:</strong>
                    {{ $bank->commission_credit_f }} %
                </li>
            @endif
        </ul>
    </div>

    <div class="flo col25 center">
        <h3>Inf. de contacto</h3>
        <hr/>
        <ul class="list-description">
            <li>
                <strong>Teléfono:</strong>
                {{ $bank->phone }}
            </li>
            <li>
                <strong>Nombre de ejecutivo:</strong>
                {{ $bank->executive_name }}
            </li>
        </ul>
    </div>

    <div class="flo col25 right">
        <h3>Ubicación</h3>
        <hr/>
        <ul class="list-description">
            <li>
                <strong>Pais: </strong>
                {{ $bank->country }}
            </li>
            <li>
                <strong>Estado: </strong>
                {{ $bank->state }}
            </li>
            <li>
                <strong>Ciudad: </strong>
                {{ $bank->city }}
            </li>
            <li>
                <strong>Código postal: </strong>
                {{ $bank->postcode }}
            </li>
            <li>
                <strong>Colonia: </strong>
                {{ $bank->colony }}
            </li>
            <li>
                <strong>Dirección: </strong>
                {{ $bank->address }}
            </li>
        </ul>
    </div>
</div>
