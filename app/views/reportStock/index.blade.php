@extends('layouts/layout_sist')

@section ('title') / Reorte de inventario @stop

@section ('content')

    <div class="text-right">
        {{ Form::open(['method'=>'get', 'class'=>'form validate']) }}

        {{ Form::label('days', 'Días para obtener el total vendido:') }}
        {{ Form::text('days', $days, ['class'=>'sm-input text-right', 'data-integer'=>'integer']) }}

        <button type="submit" class="btn-green">
            <i class="fa fa-refresh"></i>
            Actualizar
        </button>

        {{ Form::close() }}
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Descripción</th>
            <th>Cantidad en stock</th>
            <th>Minimo en stock</th>
            <th>Maximo en stock</th>
            <th>Total a comprar</th>
            <th>Vendidos</th>
            <th>Ultima compra</th>
            <th>Ultima venta</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    <a href="{{ route('product.description.edit', [$product->slug, $product->p_description->id]) }}" target="_blank">
                        {{ $product->barcode }}
                    </a>
                </td>
                <td>{{ $product->s_description }}</td>
                <td class="text-right">{{ $product->total_stock }}</td>
                <td class="text-right">{{ $product->stock_min }}</td>
                <td class="text-right">{{ $product->stock_max }}</td>
                <td class="text-right">{{ $product->quantity_to_purchase }}</td>
                <td class="text-right">{{ $product->quantity_sold }}</td>
                <td class="text-center">{{ $product->last_purchase->format('d-m-Y') }}</td>
                <td class="text-center">{{ $product->last_sale->format('d-m-Y') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

@stop
