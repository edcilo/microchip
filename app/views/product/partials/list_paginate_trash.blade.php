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
        <th>
            <i class="fa fa-gears"></i>
            Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td class="text-center">
                <img src="{{ asset($product->image) }}" alt="{{ $product->barcode }}"/>
            </td>
            <td>{{ $product->barcode }}</td>
            <td>{{ $product->s_description }}</td>
            <td class="text-center">
                <nobr>
                    @include('product.partials.btn_show')

                    @include('product.partials.btn_active')

                    @include('product.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $products->links() }}
