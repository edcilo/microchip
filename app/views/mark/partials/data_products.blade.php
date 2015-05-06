@if ( count($products) )
    <div class="col col100 block description-product">

        <h3 class="subtitle">Productos</h3>

        <table class="table">
            <thead>
            <tr>
                <th>
                    <i class="fa fa-camera"></i>
                </th>
                <th>
                    <i class="fa fa-barcode"></i>
                </th>
                <th>Categoría</th>
                <th>Modelo</th>
                <th>Descripción</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $products as $product )
                <tr>
                    <td class="text-center">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->barcode }}"/>
                    </td>
                    <td>
                        <a href="{{ route('product.show', [$product->slug, $product->id]) }}">
                            {{ $product->barcode }}
                        </a>
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->model }}</td>
                    <td>{{ $product->s_description }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $products->links() }}

    </div>
@endif
