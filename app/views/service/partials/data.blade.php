<div class="row col col100">

    <div class="flo col33 left">
        <strong>Equipo que deja:</strong> <br/>
        {{ $sale->data->equipment }}, marca: {{ $sale->data->mark }}, modelo: {{ $sale->data->model }}, no. de serie {{ $sale->data->series }} <br/>
        Detalles: {{ $sale->data->details }}
    </div>

    <div class="flo col33 center">
        <strong>Fallos y/o observaciones:</strong> <br/>
        {{ $sale->data->observations }}
    </div>

    <div class="flo col33 right">
        <strong>Observaciones internas:</strong> <br/>
        {{ $sale->data->internal }}
    </div>

</div>

@include('service.partials.warranty_data')
