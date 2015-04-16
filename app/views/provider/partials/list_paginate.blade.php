<table class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>R.F.C.</th>
        <th>Clasificación</th>
        <th>Correo electrónico</th>
        <th>Teléfono</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($providers as $provider)
        <tr>
            <td>{{ $provider->name }}</td>
            <td>{{ $provider->rfc }}</td>
            <td>{{ $provider->classification }}</td>
            <td>{{ $provider->email }}</td>
            <td>{{ $provider->number }}</td>
            <td class="text-center">
                <nobr>
                    @include('provider.partials.btn_show')

                    @include('provider.partials.btn_edit')

                    @include('provider.partials.btn_trash')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $providers->links() }}