<div class="col col100 block description-product">
    <div class="header">Movimientos pendientes</div>

    <table class="table">
        <thead>
        <tr>
            <th>Folio</th>
            <th>Estado</th>
            <th>Fecha de pago</th>
            <th>Monto</th>
            <th>Concepto</th>
            <th>
                <i class="fa fa-gears"></i>
                Opciones
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($bank->cheques as $cheque)
            @if($cheque->bank_count_id == 0 AND $cheque->amount != 0)
                <tr>
                    <td>{{ $cheque->folio }}</td>
                    <td>{{ $cheque->status }}</td>
                    <td class="text-center">{{ $cheque->payment_date }}</td>
                    <td class="text-right">$ {{ $cheque->amount }}</td>
                    <td>{{ $cheque->concept }}</td>
                    <td class="text-center">
                        {{ Form::open(['route'=>['cheque.count', $cheque->id], 'method'=>'post']) }}
                        <button type="submit" class="btn-green">Crear movimiento</button>
                        {{ Form::close() }}
                    </td>
                </tr>
            @endif
        @endforeach
        @if(count($c_credit))
            <tr>
                <td colspan="6"><strong>Pagos del cliente con tarjeta de crédito/débito</strong></td>
            </tr>
        @endif
        @foreach($c_credit as $cheque)
            <tr>
                <td>{{ $cheque->reference }}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{ $cheque->amount }}</td>
                <td>{{ $cheque->description }}</td>
                <td class="text-center">
                    crear movimiento
                </td>
            </tr>
        @endforeach
        @if(count($c_cheques))
            <tr>
                <td colspan="6"><strong>Cheques de clientes</strong></td>
            </tr>
        @endif
        @foreach($c_cheques as $cheque)
            <tr>
                <td>{{ $cheque->reference }}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{ $cheque->amount }}</td>
                <td>{{ $cheque->description }}</td>
                <td class="text-center">
                    crear movimiento
                </td>
            </tr>
        @endforeach
        @if(count($c_transfer))
            <tr>
                <td colspan="6"><strong>Transferencias</strong></td>
            </tr>
        @endif
        @foreach($c_transfer as $cheque)
            <tr>
                <td>{{ $cheque->reference }}</td>
                <td></td>
                <td></td>
                <td class="text-right">{{ $cheque->amount }}</td>
                <td>{{ $cheque->description }}</td>
                <td class="text-center">
                    crear movimiento
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
