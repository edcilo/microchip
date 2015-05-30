<table class="table">
    <tbody>
    <tr>
        <td>Total global de compras</td>
        <td class="text-right">$ {{ $sale_global['total_purchase'] }}</td>
    </tr>
    <tr>
        <td>Total global de ventas</td>
        <td class="text-right">$ {{ $sale_global['total_sale'] }}</td>
    </tr>
    <tr>
        <td>Total global de utilidades</td>
        <td class="text-right">$ {{ $sale_global['total_utility'] }}</td>
    </tr>
    <tr>
        <td>Porcentaje global de utilidad</td>
        <td class="text-right">{{ $sale_global['total_u_percentage'] }} %</td>
    </tr>
    </tbody>
</table>