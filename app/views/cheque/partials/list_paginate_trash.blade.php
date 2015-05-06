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
            <td>{{ $cheque->status }}</td>
            <td>{{ $cheque->payment_date }}</td>
            <td class="text-right">$ {{ $cheque->amount }}</td>
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
