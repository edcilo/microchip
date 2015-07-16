{{ Form::open(['method'=>'get', 'class'=>'form validate']) }}

{{ Form::hidden('total', 0, ['id' => 'total']) }}

<table class="table">
    <thead>
    <tr>
        <th colspan="2"></th>
        <th colspan="2">En caja</th>
        <th colspan="2">Retirar</th>
    </tr>
    <tr>
        <th></th>
        <th>Denom.</th>
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
                {{ Form::text('quantity_'.$key, null, ['class'=>'text-right xs-input demon_quantity d_b', 'data-value' => $key, 'data-integer'=>'integer', 'placeholder'=>0, 'autocomplete'=>'off']) }}
            </td>
            <td class="text-right">
                $ <span class="total_d">0.00</span>
            </td>
            <td class="text-right">
                {{ Form::text('quantity_r_'.$key, null, ['class'=>'text-right xs-input demon_quantity d_o', 'data-value' => $key, 'data-integer'=>'integer', 'placeholder'=>0, 'autocomplete'=>'off']) }}
            </td>
            <td class="text-right">
                $ <span class="total_d">0.00</span>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2"></td>
        <td class="text-right">Efectivo: $</td>
        <td class="text-right total_box">0.00</td>
        <td class="text-right">Retiro: $</td>
        <td class="text-right total_out">0.00</td>
    </tr>
    </tfoot>
</table>

{{ Form::close() }}