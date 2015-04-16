<table class="table">
    <thead>
    <tr>
        <th>
            <i class="fa fa-camera"></i>
        </th>
        <th>
            <i class="fa fa-barcode"></i>
        </th>
        <th>
            Tipo
        </th>
        <th>Descripción</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($results as $product)
        <tr>
            <td>
                <img src="{{ asset( $product->image ) }}" alt="{{ $product->name }}"/>
            </td>
            <td>{{ $product->barcode }}</td>
            <td>{{ $product->type }}</td>
            <td>{{ $product->s_description }}</td>
            <td class="text-center">
                <nobr>
                    @include('product.partials.btn_show')

                    @include('product.partials.btn_edit')

                    @include('product.partials.btn_active')

                    @include('product.partials.btn_trash')

                    @include('product.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $results->appends(['terms' => $terms])->links() }}