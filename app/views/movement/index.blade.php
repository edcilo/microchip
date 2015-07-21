@extends('layouts/layout_sist')

@section ('title') / Movimientos de inventario @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/search_product.js') }}
    {{ HTML::script('js/movement_out.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col50">
            <h2><i class="fa fa-refresh"></i> Movimientos de inventario</h2>
        </div>

        <div class="flo col50 text-right">
            @include('movement.partials.btn_create')

            @include('movement.partials.form_create_float')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $movements ) > 0 )
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                    <th>Cantidad</th>
                    <th>
                        <i class="fa fa-barcode"></i>
                    </th>
                    <th>Costo de entrada</th>
                    <th>Costo de salida</th>
                    <th>Descripción</th>
                    <th>Costeo</th>
                    <th>N/S</th>
                    <th>
                        <i class="fa fa-gears"></i>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($movements as $movement)
                    <tr class="{{ $movement->class_row_series }}">
                        <td>{{ $movement->id }}</td>
                        <td class="text-center">{{ $movement->created_at->format('h:i:s A / d-m-Y') }}</td>
                        <td class="text-center">
                            @if ( $movement->status == 'in' )
                                <i class="fa fa-arrow-right color-success" title="Entrada al inventario"></i>
                            @else
                                <i class="fa fa-arrow-left color-danger" title="Salida del inventario"></i>
                            @endif
                        </td>
                        <td class="text-right">{{ $movement->quantity }}</td>
                        <td>
                            <a href="{{ route('product.show', [$movement->product->slug, $movement->product->id]) }}">
                                {{ $movement->product->barcode }}
                            </a>
                        </td>
                        <td class="text-right">$ {{ $movement->purchase_price_f }}</td>
                        <td class="text-right">$ {{ $movement->selling_price_f }}</td>
                        <td>{{ $movement->description }}</td>
                        <td class="text-right">{{ $movement->in_stock }}</td>
                        <td class="text-center">
                            @if($movement->product->type == 'Producto')
                                @if( $movement->product->p_description->have_series )
                                    <a href="{{ route('series.create', [$movement->id]) }}" class="btn-green">
                                        N/S
                                    </a>
                                @endif
                            @endif

                            @if( !count($movement->sales) AND !count($movement->purchases) )
                                @include('movement.partials.btn_destroy')
                            @endif
                        </td>
                        <td class="text-center">
                            @include('movement.partials.btn_print')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $movements->links() }}

            @include('movement.partials.form_destroy_float')

        @else
            <p class="title-clear">No hay movimientos registrados.</p>
        @endif

    </div>

@stop
