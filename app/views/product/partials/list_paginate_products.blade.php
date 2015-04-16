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
        <th>Marca</th>
        <th>Descripción</th>
        <th>Exist.</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr>
            <td>
                <img src="{{ asset( $product->image ) }}" alt="{{ $product->barcode }}"/>
            </td>
            <td>{{ $product->barcode }}</td>
            <td>@if (is_object($product->p_description)) {{ $product->p_description->category->name }}@endif</td>
            <td>@if (is_object($product->p_description)) {{ $product->p_description->model }}@endif</td>
            <td>@if (is_object($product->p_description)) {{ $product->p_description->mark->name }}@endif</td>
            <td>{{ $product->s_description }}</td>
            <td class="text-right">{{ $product->stock }}</td>
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

{{ $products->links() }}