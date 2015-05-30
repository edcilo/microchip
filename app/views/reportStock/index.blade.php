@extends('layouts/layout_sist')

@section ('title') / Reorte de inventario @stop

@section ('content')

    <table class="table">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad en stock</th>
            <th>Minimo en stock</th>
            <th>Maximo en stock</th>
            <th>Total a comprar</th>
            <th>Ultima compra</th>
            <th>Ultima venta</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->barcode }}</td>
                <td>{{ $product->s_description }}</td>
                <td class="text-right">{{ $product->total_stock }}</td>
                <td class="text-right">{{ $product->stock_min }}</td>
                <td class="text-right">{{ $product->stock_max }}</td>
                <td class="text-right">{{ $product->quantity_to_purchase }}</td>
                <td class="text-center">{{ $product->last_purchase }}</td>
                <td class="text-center">{{ $product->last_sale }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

@stop
