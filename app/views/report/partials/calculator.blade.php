{{ Form::open(['route'=>'report.money', 'method'=>'get', 'class'=>'form validate']) }}

{{ Form::hidden('date_init', Input::get('date_init')) }}
{{ Form::hidden('date_end', Input::get('date_end')) }}
{{ Form::hidden('total', $total) }}
{{ Form::hidden('calculate', true) }}

<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>Denominación</th>
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
                {{ Form::text('quantity_'.$key, Input::get('quantity_'.$key), [($key == 1000) ? 'autofocus' : '', 'class'=>'text-right xs-input', 'data-numeric'=>'numeric']) }}
            </td>
            <td class="text-right">
                @if (isset($total_denomination['quantity_' . $key]))
                    {{ number_format($total_denomination['quantity_' . $key], 2, '.', ',') }}
                @else
                    $0.00
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2"></td>
        <td class="text-right">Total en efectivo: $</td>
        <td class="text-right">{{ number_format($total_calculate, 2, '.', ',') }}</td>
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