<table class="table">
    <thead>
    <tr>
        <th>Banco</th>
        <th>Sucursal</th>
        <th>Númreo de cuenta</th>
        <th>CLABE</th>
        <th>Teléfono</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($banks as $bank)
        <tr>
            <td>{{ $bank->name }}</td>
            <td>{{ $bank->branch }}</td>
            <td class="text-right">{{ $bank->number_account }}</td>
            <td class="text-right">{{ $bank->clabe }}</td>
            <td class="text-right">{{ $bank->phone }}</td>
            <td class="text-center">{{ $bank->terminal_i }}</td>
            <td class="text-center">
                <nobr>
                    @include('bank.partials.btn_show')

                    @include('bank.partials.btn_active')

                    @include('bank.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


{{ $banks->links() }}