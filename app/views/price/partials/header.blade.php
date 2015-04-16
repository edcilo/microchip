<div class="col col100">
    <ul class="text-right">
        <li>
            <strong>Folio:</strong>
            {{ $price->folio }}
        </li>
        <li>
            <strong>Fecha:</strong>
            {{ date( 'd/M/Y', time($price->created_at)) }}
        </li>
    </ul>
</div>

<div class="col col100">
    <div class="flo col50">
        <ul>
            <li>
                <strong>C.T.</strong>
                {{ $price->customer->id }}
            </li>
            <li>
                <strong>Razón Social:</strong>
                {{ $price->customer->prefix }}
                {{ $price->customer->name }}
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
    </div>

    <div class="flo col50 text-right">
        <ul>
            <li>
                <strong>Vend.</strong>
                {{ $price->user->id }}
            </li>
            <li>
                <strong>Nombre:</strong>
                {{ $price->user->profile->name }} {{ $price->user->profile->f_last_name }} {{ $price->user->profile->s_last_name }}
            </li>
        </ul>
    </div>
</div>