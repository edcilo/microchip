<table class="table">
    <thead>
    <tr>
        <th>
            <i class="fa fa-camera"></i>
        </th>
        <th>
            <i class="fa fa-barcode"></i>
        </th>
        <th>Descripción</th>
        <th>Publicar en web</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($services as $product)
        <tr>
            <td>
                <img src="{{ asset( $product->image ) }}" alt="{{ $product->barcode }}"/>
            </td>
            <td>{{ $product->barcode }}</td>
            <td>{{ $product->s_description }}</td>
            <td class="text-center">{{ $product->web }}</td>
            <td class="text-center">
                <nobr>
                    @include('product.partials.btn_show')

                    @include('product.partials.btn_edit')

                    @include('product.partials.btn_trash')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $services->links() }}
