<table class="table">
    <thead>
    <tr>
        <th>Monto</th>
        <th>Método</th>
        <th>No. de tarjeta/No. de cheque/Folio/Referencia</th>
        <th>Banco/IFE</th>
        <th>Descripción</th>
        <th>Fecha de pago</th>
        <th>
            <i class="fa fa-gears"></i>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($sale->payments as $pay)
        <tr>
            <td class="text-right">$ {{ $pay->amount - $pay->change }}</td>
            <td>{{ $pay->method }}</td>
            <td>{{ $pay->reference }}</td>
            <td>{{ $pay->entity }}</td>
            <td>{{ $pay->description }}</td>
            <td class="text-center">{{ $pay->date }}</td>
            <td class="text-center">
                @include('pay.partials.btn_edit')

                @include('pay.partials.btn_destroy')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
