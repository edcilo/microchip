@extends('layouts/layout_sist')

@section ('title') / {{ $warranty->folio }} @stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('warranty.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('warranty.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $warranty->folio }}</h1>
        </div>

        <div class="col col100 text-right">
            @include('warranty.partials.form_send')

            @include('warranty.partials.btn_print')

            @include('purchase.partials.btn_download', ['purchase' => $warranty->purchase])
        </div>

        <hr/>

        <div class="col col100">
            <figure class="flo col20 left">
                <img src="{{ asset($warranty->series->product->image) }}" alt="{{ $warranty->series->ns }}"/>
            </figure>

            <div class="flo col80 center">
                <div class="col col100">
                    <div class="flo col50 left">
                        <ul>
                            <li>
                                <strong>Folio de garantía: </strong>
                                {{ $warranty->folio }}
                            </li>
                            <li>
                                <strong>Estado de garantía:</strong>
                                {{ $warranty->status}}
                            </li>
                            <li>
                                <strong>Fecha:</strong>
                                {{ $warranty->created_at->format('d-m-Y H:i:s a') }}
                            </li>
                            @if($warranty->sent_at)
                                <li>
                                    <strong>Fecha de envío:</strong>
                                    {{ date('d-m-Y H:i:s a', time($warranty->sent_at)) }}
                                </li>
                            @endif
                            <li>
                                <strong>Producto: </strong>
                                <ul>
                                    <li title="Código de barras">
                                        <i class="fa fa-barcode"></i>
                                        <a href="{{ route('product.show', [$warranty->series->product->barcode, $warranty->series->product->id]) }}">
                                            {{ $warranty->series->product->barcode }}
                                        </a>
                                    </li>
                                    <li>
                                        n/s:
                                        <a href="{{ route('series.show', [$warranty->series->ns, $warranty->series->id]) }}">
                                            {{ $warranty->series->ns }}
                                        </a>
                                    </li>
                                    <li>
                                        Descripción:
                                        {{ $warranty->series->product->s_description }}
                                    </li>
                                    <li>
                                        Detalles de fallos:
                                        {{ $warranty->description }}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="flo col50 right">
                        <ul>
                            <li>
                                <strong>Compra:</strong>
                                <a href="{{ route('purchase.show', [$warranty->purchase->folio, $warranty->purchase->id]) }}">
                                    {{ $warranty->purchase->folio }}
                                </a>
                            </li>
                            <li>
                                <strong>Fecha de compra:</strong>
                                {{ date('d-m-Y', time($warranty->purchase->date)) }}
                            </li>
                            <li>
                                <strong>Proveedor:</strong>
                                {{ $warranty->purchase->provider->name }}
                            </li>
                        </ul>

                        @if($warranty->sale)
                            <hr/>

                            <ul>
                                <li>
                                    <strong>Cliente:</strong>
                                </li>
                            </ul>
                        @endif

                        <hr/>

                        <ul>
                            <li>
                                <strong>Procesa garantía:</strong>
                                {{ $warranty->createdBy->profile->full_name }}
                            </li>
                            @if($warranty->sentBy)
                                <li>
                                    <strong>Envía garantía:</strong>
                                    {{ $warranty->sentBy->profile->full_name }}
                                </li>
                            @endif
                        </ul>

                        <hr/>

                        <ul>
                            <li>
                                <strong>Solución de garantía: </strong>
                                {{ trans('lists.warranty_solutions.' . $warranty->solution) }}
                            </li>
                            <li>
                                <strong>Observaciones:</strong>
                                {{ $warranty->observations }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if($warranty->status == 'Enviado')
        <div class="block description-product">

            <div class="header">
                Resolución de garantía
            </div>

            @include('warranty.partials.form_solution')

        </div>
    @endif

    @if($warranty->status != 'Terminado')
        <div class="block description-product">

            <div class="subtitle">Eliminar garantía</div>

            <div class="text-center">
                @include('warranty.partials.form_destroy')
            </div>

        </div>
    @endif

    @if($warranty->movement_in)
        <div class="block description-product">

            <div class="subtitle">Producto recibido por garantía</div>

            <div class="text-center">
                <table class="table">
                    <thead>
                    <tr>
                        <th><i class="fa fa-barcode"></i></th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <a href="{{ route('product.show', [$warranty->movementIn->product->slug, $warranty->movementIn->product->id]) }}">
                                {{ $warranty->movementIn->product->barcode }}
                            </a>
                        </td>
                        <td>
                            {{ $warranty->movementIn->product->s_description }}
                        </td>
                        <td class="text-right">
                            {{ $warranty->movementIn->quantity }}
                        </td>
                        <td class="text-right">
                            $ {{ $warranty->movementIn->getPurchasePriceWithIvaFAttribute() }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    @endif

@stop
