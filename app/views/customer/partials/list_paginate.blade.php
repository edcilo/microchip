<table class="table">
    <thead>
    <tr>
        <th>R.F.C.</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>
            <i class="fa fa gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $customers as $customer )
        <tr>
            <td>{{ $customer->rfc }}</td>
            <td>{{ $customer->prefix }} {{ $customer->name }}</td>
            <td>
                @if ( $customer->phone != '') <i class="fa fa-phone"></i> {{ $customer->phone }} <br/> @endif
                @if ( $customer->cellphone != '' ) <i class="fa fa-mobile-phone"></i> {{ $customer->cellphone }} @endif
            </td>
            <td>{{ $customer->email }}</td>
            <td class="text-center">
                <nobr>
                    @include('customer.partials.btn_show')

                    @include('customer.partials.btn_edit')

                    @include('customer.partials.btn_trash')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $customers->links() }}
