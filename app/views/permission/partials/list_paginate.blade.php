<table class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>
            <i class="fa fa-gears"></i>
            Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->description }}</td>
            <td class="text-center">
                @include('permission.partials.btn_show')

                @include('permission.partials.btn_edit')
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $permissions->links() }}