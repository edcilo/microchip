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
        @if ( ! $user->active )
            <li>
                <div class="col col100">
                    <div class="flo col50 left">
                        <strong>Fecha de eliminación:</strong>
                    </div>
                    <div class="flo col50 right text-right">
                        {{ $user->profile->fired_f }}
                    </div>
                </div>
            </li>
        @endif
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

    @if ($user->active)
        <div class="col col100 row text-right">
            @include('user.partials.form_pay')
        </div>
    @endif

</div>
