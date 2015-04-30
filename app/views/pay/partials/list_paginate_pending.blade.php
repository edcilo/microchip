<table class="table">
    <thead>
    <tr>
        <th>Monto</th>
        <th>Concepto</th>
        <th>Empleado que recibio</th>
        <th>Empleado que autorizó</th>
        <th>
            <i class="fa fa-gears"></i>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($pending as $pay)
        <tr>
            <td class="text-right">{{ -1 * $pay->amount }}</td>
            <td>{{ $pay->description }}</td>
            <td>{{ $pay->user->profile->full_name }}</td>
            <td>{{ $pay->user_receiving->profile->full_name }}</td>
            <td class="text-center">

                @include('pay.partials.btn_change')

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $pending->links() }}