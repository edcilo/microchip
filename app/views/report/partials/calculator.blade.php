<div class="subtitle_mark">Calculadora de caja.</div>

{{ Form::open(['method'=>'get', 'class'=>'form validate']) }}

{{ Form::hidden('total', 0, ['id' => 'total']) }}

<table class="table text-right">
    <thead class="text-center">
    <tr>
        <th colspan="2"></th>
        <th colspan="2">En caja</th>
        <th colspan="2">Retirar</th>
        <th>Global</th>
    </tr>
    <tr>
        <th></th>
        <th>Denom.</th>
        <th>Cantidad</th>
        <th>Suma</th>
        <th>Cantidad</th>
        <th>Suma</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach(trans('lists.denominations') as $key => $value)
        <?php $name = 'quantity_'.$key; $name_r = 'quantity_r_'.$key ?>
        <tr>
            <td class="text-left">$</td>
            <td>{{ $value }}</td>
            <td>
                {{ Form::text($name, isset($corte) ? $corte->$name : null, ['class'=>'text-right xs-input demon_quantity d_b', 'data-value' => $key, 'data-integer'=>'integer', 'placeholder'=>0, 'autocomplete'=>'off']) }}
            </td>
            <td>
                $ <span class="total_d">0.00</span>
            </td>
            <td>
                {{ Form::text($name_r, isset($corte) ? $corte->$name_r : null, ['class'=>'text-right xs-input demon_quantity d_o', 'data-value' => $key, 'data-integer'=>'integer', 'placeholder'=>0, 'autocomplete'=>'off']) }}
            </td>
            <td>
                $ <span class="total_d">0.00</span>
            </td>
            <td>
                $ <span class="total_g">0.00</span>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2"></td>
        <td>Efectivo: $</td>
        <td class="total_box">0.00</td>
        <td>Retiro: $</td>
        <td class="total_out">0.00</td>
        <th>$ <span class="total_global">0.00</span></th>
    </tr>
    </tfoot>
</table>

{{ Form::close() }}