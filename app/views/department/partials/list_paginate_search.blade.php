<table class="table">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>
            <i class="fa fa gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ( $results as $department )
        <tr>
            <td>{{ $department->name }}</td>
            <td>{{ $department->description }}</td>
            <td class="text-center">
                <nobr>
                    @include('department.partials.btn_show')

                    @include('department.partials.btn_edit')

                    @include('department.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $results->appends(['terms' => $terms])->links() }}