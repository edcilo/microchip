<div class="block description-product">

    <div class="subtitle">Inf. de contrato</div>

    <ul class="list-description">
        <li>
            <div class="col col100">
                <div class="flo col50 left">
                    <strong>Fecha de contratación:</strong>
                </div>
                <div class="flo col50 right text-right">
                    {{ $user->profile->hired_f }}
                </div>
            </div>
        </li>
        <li>
            <div class="col col100">
                <div class="flo col50 left">
                    <strong>Objetivo de ventas:</strong>
                </div>
                <div class="flo col50 right text-right">
                    $ {{ $user->profile->goal_f }}
                </div>
            </div>
        </li>
        <li>
            <div class="col col100">
                <div class="flo col50 left">
                    <strong>Total de ventas:</strong>
                </div>
                <div class="flo col50 right text-right">
                    $ {{ $user->profile->current_f }}
                </div>
            </div>
        </li>
        <li>
            <div class="col col100">
                <div class="flo col50 left">
                    <strong>Porcentaje de comisión:</strong>
                </div>
                <div class="flo col50 right text-right">
                    {{ $user->profile->commission_f }} %
                </div>
            </div>
        </li>
        <li>
            <hr/>
            <div class="col col100">
                <div class="flo col50 left">
                    <strong>Salario:</strong>
                </div>
                <div class="flo col50 right text-right">
                    $ {{ $user->profile->salary_f }}
                </div>
            </div>
        </li>
        <li>
            <div class="col col100">
                <div class="flo col50 left">
                    <strong>Comisión:</strong>
                </div>
                <div class="flo col50 right text-right">
                    <span>$ {{ $user->commission_t_f  }}</span>
                </div>
            </div>
        </li>
        <li>
            <div class="col col100">
                <div class="flo col50 left">
                    <strong>Total:</strong>
                </div>
                <div class="flo col50 right text-right">
                    <span class="text-green">$ {{ $user->salary_t_f  }}</span>
                </div>
            </div>
        </li>
    </ul>

    <div class="col col100 row text-right">
        <a class="btn-green" href="{{ route('user.pay', [$user->id]) }}">
            <i class="fa fa-money"></i> Pagar
        </a>
    </div>

    @if ( ! $user->active )

        <ul class="list-description">
            <li>
                <strong>Fecha de despido:</strong>
                <ul>
                    <li>{{ $user->profile->fired }}</li>
                </ul>
            </li>
            <li>
                <strong>Motivo:</strong>
                <ul>
                    <li>{{ $user->profile->reason }}</li>
                </ul>
            </li>
        </ul>

    @endif

</div>