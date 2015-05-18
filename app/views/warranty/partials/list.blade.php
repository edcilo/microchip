<table class="table">
    <thead>
    <tr>
        <th>Folio</th>
        <th>Estado</th>
        <th>Solución</th>
        <th>Producto</th>
        <th>N/S</th>
        <th>Detalles de garantía</th>
        <th>Proveedor</th>
        <th>
            <i class="fa fa-gears"></i> Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($warranties as $warranty)
        <tr>
            <td>{{ $warranty->folio }}</td>
            <td>{{ $warranty->status }}</td>
            <td>{{ trans('lists.warranty_solutions.' . $warranty->solution) }}</td>
            <td>
                <a href="{{ route('product.show', [$warranty->series->product->barcode, $warranty->series->product->id]) }}">
                    {{ $warranty->series->product->barcode }}
                </a>
            </td>
            <td>{{ $warranty->series->ns }}</td>
            <td>{{ $warranty->description }}</td>
            <td>{{ $warranty->purchase->provider->name }}</td>
            <td>
                <nobr>
                    @include('warranty.partials.btn_show')

                    @include('warranty.partials.form_send')

                    @include('warranty.partials.btn_print')

                    @include('purchase.partials.btn_download', ['purchase' => $warranty->purchase])

                    @include('warranty.partials.btn_destroy')
                </nobr>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>