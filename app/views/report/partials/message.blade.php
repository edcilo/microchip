@if (isset($report['total_box']) AND isset($total_calculate))
    @if(number_format($total_calculate, 2) == number_format($report['total_box'], 2))
        <aside class="msg_dialog">Los resultados coinciden</aside>
    @elseif($total_calculate > $report['total_box'])
        <aside class="msg_dialog">Hay mas efectivo en caja</aside>
    @elseif($total_calculate < $report['total_box'])
        <aside class="msg_dialog">Hay menos efectivo en caja</aside>
    @endif
@endif
