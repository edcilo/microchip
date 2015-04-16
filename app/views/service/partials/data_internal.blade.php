<div class="col col100">
    <div class="flo col50 left">
        <ul>
            <li>
                <strong>Equipo(s) que deja:</strong>
                {{ $sale->data->equipment }}, {{ $sale->data->mark }}, {{ $sale->data->model }},
                {{ $sale->data->series }}; <br/>
                {{ $sale->data->details }}
            </li>
            <li>
                <strong>Fallos y/o observaciones:</strong>
                {{ $sale->data->observations }}
            </li>
        </ul>
    </div>

    <div class="flo col50 right">
        <ul>
            <li>
                <strong>Fecha y hora de entrega:</strong>
                {{ $sale->delivery_date }}; {{ $sale->delivery_time }}
            </li>
            @if( $sale->description )
                <li>
                    <strong>Observaciones del servicio:</strong>
                    {{ $sale->description }}
                </li>
            @endif
            <li>
                <strong>Datos internos:</strong>
                {{ $sale->data->internal }}
            </li>
        </ul>
    </div>
</div>