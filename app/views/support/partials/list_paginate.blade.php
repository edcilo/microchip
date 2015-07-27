@if (count($products))

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Estado</th>
            <th>Producto</th>
            <th>Descripción</th>
            <th>
                <i class="fa fa-gears"></i>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td class="text-center">{{ $product->id }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->product->barcode }}</td>
                <td>{{ $product->product->s_description }}</td>
                <td class="text-center">
                    @include('support.partials.btn_show')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@else

    <p class="title-clear">No hay productos en soporte.</p>

@endif