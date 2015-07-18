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
                {{ Form::text($name, isset($report_money) ? $report_money->$name : null, ['class'=>'text-right xs-input demon_quantity d_b', 'data-value' => $key, 'data-integer'=>'integer', 'placeholder'=>0, 'autocomplete'=>'off']) }}
            </td>
            <td>
                $ <span class="total_d">0.00</span>
            </td>
            <td>
                {{ Form::text($name_r, isset($report_money) ? $report_money->$name_r : null, ['class'=>'text-right xs-input demon_quantity d_o', 'data-value' => $key, 'data-integer'=>'integer', 'placeholder'=>0, 'autocomplete'=>'off']) }}
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

{{--
{{ Form::hidden('quantity_1000', $data['quantity_1000']) }}
{{ Form::hidden('quantity_500', $data['quantity_500']) }}
{{ Form::hidden('quantity_200', $data['quantity_200']) }}
{{ Form::hidden('quantity_100', $data['quantity_100']) }}
{{ Form::hidden('quantity_50', $data['quantity_50']) }}
{{ Form::hidden('quantity_20', $data['quantity_20']) }}
{{ Form::hidden('quantity_10', $data['quantity_10']) }}
{{ Form::hidden('quantity_5', $data['quantity_5']) }}
{{ Form::hidden('quantity_2', $data['quantity_2']) }}
{{ Form::hidden('quantity_1', $data['quantity_1']) }}
{{ Form::hidden('quantity_05', $data['quantity_05']) }}

{{ Form::hidden('quantity_r_1000', $data['quantity_r_1000']) }}
{{ Form::hidden('quantity_r_500', $data['quantity_r_500']) }}
{{ Form::hidden('quantity_r_200', $data['quantity_r_200']) }}
{{ Form::hidden('quantity_r_100', $data['quantity_r_100']) }}
{{ Form::hidden('quantity_r_50', $data['quantity_r_50']) }}
{{ Form::hidden('quantity_r_20', $data['quantity_r_20']) }}
{{ Form::hidden('quantity_r_10', $data['quantity_r_10']) }}
{{ Form::hidden('quantity_r_5', $data['quantity_r_5']) }}
{{ Form::hidden('quantity_r_2', $data['quantity_r_2']) }}
{{ Form::hidden('quantity_r_1', $data['quantity_r_1']) }}
{{ Form::hidden('quantity_r_05', $data['quantity_r_05']) }}
--}}