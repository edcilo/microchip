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
    @foreach ($categories as $category)
        <tr>
            <td>
                <img src="{{ asset( $category->image ) }}" alt="{{ $category->name }}"/>
            </td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                <nobr>
                    @include('category.partials.btn_show')

                    @include('category.partials.btn_edit')

                    @include('category.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $categories->links() }}