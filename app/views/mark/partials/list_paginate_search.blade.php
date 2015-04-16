<table class="table">
    <thead>
    <tr>
        <th>
            <i class="fa fa-camera"></i>
        </th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($results as $mark)
        <tr>
            <td>
                <img src="{{ asset( $mark->image ) }}" alt="{{ $mark->name }}"/>
            </td>
            <td>{{ $mark->name }}</td>
            <td>{{ $mark->description }}</td>
            <td>
                <nobr>
                    @include('mark.partials.btn_show')

                    @include('mark.partials.btn_edit')

                    @include('mark.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $results->appends(['terms' => $terms])->links() }}