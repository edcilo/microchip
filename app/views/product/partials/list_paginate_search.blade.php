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
        @if($type == 'product')
            <th>Categoría</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Exist.</th>
        @endif
        <th>Precios</th>
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
            <td>{{ $product->s_description }}</td>
            @if($product->type == 'Producto')
                <td>{{ $product->p_description->category->name }}</td>
                <td>{{ $product->p_description->model }}</td>
                <td>{{ $product->p_description->mark->name }}</td>
                <td class="text-right">{{ $product->stock }}</td>
            @endif
            <td class="text-center">
                <nobr>
                    $ {{ Form::select('prices', $product->arrayPrices) }}
                </nobr>
            </td>
            <td class="text-center">
                <nobr>
                    @include('product.partials.btn_show_float')

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
