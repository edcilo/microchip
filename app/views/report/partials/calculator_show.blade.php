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
                {{ $d['quantity_'.$key] }}
            </td>
            <td class="text-right">
                {{ number_format($total_denomination['quantity_' . $key], 2, '.', ',') }}
            </td>
            <td class="text-right">
                {{ $d['quantity_r_'.$key] }}
            </td>
            <td class="text-right">
                {{ number_format($total_denomination['quantity_r_' . $key], 2, '.', ',') }}
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