@if( count($customer->contacts) > 0 )

    <table class="table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Celular</th>
            <th>Correo</th>
            <th><i class="fa fa-gears"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach($customer->contacts as $contact)
            <tr>
                <td>{{ $contact->dataContact->name }}</td>
                <td>{{ $contact->dataContact->phone }}</td>
                <td>{{ $contact->dataContact->cellphone }}</td>
                <td>{{ $contact->dataContact->email }}</td>
                <td class="text-center">
                    <nobr>
                        @include('customerContact.partials.btn_show')

                        @include('customerContact.partials.btn_edit')

                        @include('customerContact.partials.form_destroy')
                    </nobr>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@else

    <p class="title-clear">No hay contactos registrados.</p>

@endif
