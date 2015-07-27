@extends('layouts/layout_sist')

@section ('title') / Productos en soporte @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Productos en soporte</h2>
        </div>

        <div class="flo col40 text-right">
            @include('support.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('support.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <h2 class="header">
            {{ $product->product->barcode }}
        </h2>

        <div class="col col100">

            <div class="flo col50 left">
                <ul>
                    <li>
                        <strong>Estado:</strong>
                        {{ $product->status }}
                    </li>
                    <li>
                        <strong>Producto:</strong>
                        {{ $product->product->barcode }}
                    </li>
                    <li>
                        <strong>Descripción corta del producto:</strong>
                        {{ $product->product->s_description }}
                    </li>
                    <li>
                        <strong>Movimientos:</strong>
                    </li>
                </ul>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Costo de entrada</th>
                        <th>Costo de salida</th>
                        <th>
                            <i class="fa fa-gears"></i>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($product->movements as $movement)
                        <tr class="{{ $movement->class_row_series }}">
                            <td>{{ $movement->quantity }} {{ $movement->class_row_series }}</td>
                            <td>$ {{ $movement->purchase_price }}</td>
                            <td>$ {{ $movement->selling_price }}</td>
                            <td class="text-center">
                                @if($movement->product->p_description->have_series)
                                    <a href="{{ route('support.series.create', [$product->id, $movement->id]) }}" class="btn-green" title="Números de serie">N/S</a>
                                @endif

                                @include('movement.partials.btn_print')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flo col50 right">
                <ul>
                    <li>
                        <strong>Observaciones:</strong>
                        {{ $product->observations }}
                    </li>
                    <li>
                        <strong>Registrado el</strong>
                        {{ $product->created_at->format('h:i A d-m-Y') }}
                    </li>
                </ul>

                @if(empty($movement->class_row_series))

                    @if($product->authorized_by)

                        <ul>
                            <li>
                                <strong>Entregado por:</strong>
                                {{ $product->givenBy->profile->full_name }}
                            </li>
                            <li>
                                <strong>Recibido por:</strong>
                                {{ $product->receivedBy->profile->full_name }}
                            </li>
                            <li>
                                <strong>Autorizado por:</strong>
                                {{ $product->authorizedBy->profile->full_name }}
                            </li>
                        </ul>

                    @else

                        {{ Form::open(['route'=>['support.authorize', $product->id], 'class'=>'form validate']) }}

                        <div class="subtitle_mark">
                            Autorizar
                        </div>

                        @include('support.partials.form_authorization')

                        <div class="text-center">
                            <button type="submit" class="btn-blue">
                                Autorizar
                            </button>
                        </div>

                        {{ Form::close() }}

                    @endif

                @else
                    <p class="title-clear">
                        Para autorizar este movimiento es necesario registrar los números de serie.
                    </p>
                @endif
            </div>

        </div>

    </div>

    <div class="col col100 block description-product">

        <div class="subtitle">
            Eliminar producto en soporte
        </div>

        <div class="text-center">
            @include('support.partials.form_destroy')
        </div>

    </div>

@stop
