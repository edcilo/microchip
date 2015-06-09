<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Estado</th>
        <th>Fecha de pago</th>
        <th>Monto</th>
        <th>Concepto</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cheques as $cheque)
        <tr>
            <td>{{ $cheque->folio }}</td>
            <td>
                <nobr>{{ $cheque->status }}</nobr>
            </td>
            <td class="text-center">
                <nobr>{{ $cheque->payment_date_f }}</nobr>
            </td>
            <td class="text-right">
                <nobr>$ {{ $cheque->amount }}</nobr>
            </td>
            <td>{{ $cheque->concept }}</td>
            <td class="text-center">
                <nobr>
                    @include('cheque.partials.btn_show')

                    @include('cheque.partials.btn_active')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $cheques->appends($data_strip)->links() }}
