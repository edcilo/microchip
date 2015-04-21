<table class="table">
    <thead>
    <tr>
        <th>Monto</th>
        <th>Método</th>
        <th>Descripción</th>
        <th>Empleado que dio</th>
        <th>Empleado que recibio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sale->payments as $pay)
        <tr>
            <td>{{ $pay->amount }}</td>
            <td>{{ $pay->method }}</td>
            <td>{{ $pay->description }}</td>
            <td>{{ $pay->user_receiving }}</td>
            <td>{{ $pay->user->profile->full_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>