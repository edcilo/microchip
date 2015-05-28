{{ Form::open(['method'=>'get', 'class'=>'form validate']) }}

{{ Form::hidden('date_init', $d['date_init']) }}
{{ Form::hidden('date_end', $d['date_end']) }}
{{ Form::hidden('total', $total) }}
{{ Form::hidden('calculate', true) }}

<table class="table">
    <thead>
    <tr>
        <th colspan="2"></th>
        <th colspan="2">En caja</th>
        <th colspan="2">Retirar</th>
    </tr>
    <tr>
        <th></th>
        <th>Denominación</th>
        <th>Cantidad</th>
        <th>Suma</th>
        <th>Cantidad</th>
        <th>Suma</th>
    </tr>
    </thead>
    <tbody>
    @foreach(trans('lists.denominations') as $key => $value)
        <tr>
            <td>$</td>
            <td class="text-right">{{ $value }}</td>
            <td class="text-center">
                {{ Form::text('quantity_'.$key, isset($d['quantity_'.$key]) ? $d['quantity_'.$key] : 0, [($key == 1000) ? 'autofocus' : '', 'class'=>'text-right xs-input', 'data-integer'=>'integer', 'autocomplete'=>'off']) }}
            </td>
            <td class="text-right">
                @if (isset($total_denomination['quantity_' . $key]))
                    {{ number_format($total_denomination['quantity_' . $key], 2, '.', ',') }}
                @else
                    $0.00
                @endif
            </td>
            <td class="text-right">
                {{ Form::text('quantity_r_'.$key, isset($d['quantity_r_'.$key]) ? $d['quantity_r_'.$key] : 0, ['class'=>'text-right xs-input', 'data-integer'=>'integer', 'autocomplete'=>'off']) }}
            </td>
            <td class="text-right">
                @if (isset($total_denomination['quantity_r_' . $key]))
                    {{ number_format($total_denomination['quantity_r_' . $key], 2, '.', ',') }}
                @else
                    0.00
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2"></td>
        <td class="text-right">Efectivo: $</td>
        <td class="text-right">{{ number_format($total_calculate, 2, '.', ',') }}</td>
        <td class="text-right">Retiro: $</td>
        <td class="text-right">{{ number_format($total_calculate_r, 2, '.', ',') }}</td>
    </tr>
    </tfoot>
</table>

<div class="text-center">
    <button type="submit" class="btn-blue">
        <i class="fa fa-calculator"></i>
        Calcular efectivo
    </button>
</div>

{{ Form::close() }}