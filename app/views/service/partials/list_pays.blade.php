<table class="table">
    <thead>
    <tr>
        <th>Monto</th>
        <th>Método</th>
        <th>Descripción</th>
        <th>Empleado que registro el movimiento</th>
        <th>Empleado que recibio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sale->payments as $pay)
        <tr>
            <td>{{ $pay->amount }}</td>
            <td>{{ $pay->method }}</td>
            <td>{{ $pay->description }}</td>
            <td>{{ $pay->user->profile->full_name }}</td>
            <td>
                @if( is_object($pay->user_receiving) )
                    {{ $pay->user_receiving->profile->full_name }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>