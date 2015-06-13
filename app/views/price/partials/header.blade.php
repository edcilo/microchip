<div class="col col100">
    <div class="flo col50">
        <ul>
            <li>
                <strong>C.T.</strong>
                {{ $sale->customer->id }}
            </li>
            <li>
                <strong>Razón Social:</strong>
                <a href="{{ route('customer.show', [$sale->customer->slug, $sale->customer->id]) }}">
                    {{ $sale->customer->prefix }}
                    {{ $sale->customer->name }}
                </a>
            </li>
            <li>
                <strong>Telefono(s):</strong>
                {{ $sale->customer->phone }} - {{ $sale->customer->cellphone }}
            </li>
            <li>
                <strong>E-mail:</strong>
                {{ $sale->customer->email }}
            </li>
        </ul>
    </div>

    <div class="flo col50 text-right">
        <ul>
            <li>
                <strong>Folio:</strong>
                {{ $sale->folio }}
            </li>
            <li>
                <strong>Fecha:</strong>
                {{ date( 'd/M/Y', time($sale->created_at)) }}
            </li>
            <li>
                <strong>Vend.</strong>
                {{ $sale->user->id }}
            </li>
            <li>
                <strong>Nombre:</strong>
                {{ $sale->user->profile->name }} {{ $sale->user->profile->f_last_name }} {{ $sale->user->profile->s_last_name }}
            </li>
        </ul>
    </div>
</div>
