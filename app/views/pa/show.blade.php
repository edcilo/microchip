@extends('layouts/layout_sist')

@section('title') / {{ $pa->barcode }} @stop

@section('scripts')
    {{-- HTML::script('js/aps.js') --}}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Porducto ordenado</h2>
        </div>

        <div class="flo col40 text-right">
            <a class="btn-blue" href="{{ route('pas.index') }}">
                <i class="fa fa-list"></i> Volver a la lista de productos ordenados
            </a>
        </div>

        <div class="flo col30 text-right">
            @include('pa/partials/formSearch')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $pa->barcode }} ({{ $pa->status }})</h1>
        </div>

        <div class="col col100">

            <figure class="flo col20 left">
                @if($pa->registered)
                    <img src="{{ asset($pa->product->image) }}" alt="{{ $pa->barcode }}"/>
                @elseif($pa->image_link == 'images/product/default.png')
                    <img src="{{ asset($pa->image_link) }}" alt="{{ $pa->barcode }}"/>
                @else
                    <img src="{{ $pa->image_link }}" alt="{{ $pa->barcode }}"/>
                @endif

                @if(!$pa->registered)
                    <p>
                        <strong>
                            <a href="{{ $pa->provider_link }}">
                                <i class="fa fa-link"></i>
                                Enlace con el proveedor
                            </a>
                        </strong>
                    </p>
                @endif
            </figure>

            <div class="flo col80 right">
                <div class="col col100 row">
                    <div class="flo col20 left">
                        <strong>Folio de documento:</strong> <br/>
                        <a href="
                        @if($pa->sale->classification == 'Venta')
                            {{ route('sale.show', [$pa->sale->folio, $pa->sale->id]) }}
                        @elseif($pa->sale->classification == 'Pedido')
                            {{ route('order.show', [$pa->sale->folio, $pa->sale->id]) }}
                        @elseif($pa->sale->classification == 'Cotización')
                            {{ route('price.show', [$pa->sale->folio, $pa->sale->id]) }}
                        @else
                            {{ route('service.show', [$pa->sale->id]) }}
                        @endif
                            ">
                            {{ $pa->sale->folio }}
                        </a>
                    </div>

                    <div class="flo col20 center">
                        <strong>Codigo de barras:</strong> <br/>
                        @if($pa->registered)
                        <a href="{{ route('product.show', [$pa->barcode, $pa->product_id]) }}">
                            {{ $pa->barcode }}
                        </a>
                        @else
                            {{ $pa->barcode }}
                        @endif
                    </div>

                    <div class="flo col20">
                        <strong>Cantidad:</strong> <br/>
                        <span id="series_quantity">{{ $pa->quantity }}</span>
                    </div>

                    <div class="flo col20">
                        <strong>Precio de venta:</strong> <br/>
                        $ {{ $pa->total_f }}
                    </div>

                    @if(!$pa->registered)
                        <div class="flo col20">
                            <strong>Costo de envio:</strong> <br/>
                            $ {{ $pa->shipping }}
                        </div>
                    @endif
                </div>

                <div class="col col100 row">
                    <div class="flo col30 left">
                        <strong>Descripción corta:</strong> <br/>
                        {{ $pa->s_description }}
                    </div>

                    <div class="flo col70 right">
                        <strong>Descripción larga</strong> <br/>
                        @if($pa->registered)
                            {{ $pa->product->description }}
                        @else
                            {{ $pa->l_description }}
                        @endif
                    </div>
                </div>

                <div class="col col100 row">
                    <div class="flo col30 left">
                        <strong>Surtidos:</strong>
                        {{ $pa->orders_total }}
                    </div>

                    <div class="flo col30 center">
                        <strong>Faltan por surtir:</strong>
                        {{ $pa->orders_rest }}
                    </div>
                </div>
            </div>

        </div>

    </div>

    @if($pa->status != 'Surtido')
        <div class="col col100 block description-product">
            <h3 class="header">Archivar PA</h3>

            @if ( Session::get('message') )
                <aside class="msg_dialog">{{ Session::get('message') }}</aside>
            @endif

            {{ Form::open(['route'=>['order.product.store'], 'method'=>'post', 'class'=>'form validate']) }}
            {{ Form::hidden('pa_id', $pa->id) }}

            <div class="message-error">
                {{ $errors->first('selling_price', '<span>:message</span>') }}
            </div>

            <div class="row col col100 text-center">

                <div class="flo col33 left">
                    {{ Form::label('product_id', 'Código de barras:') }}
                    {{ Form::text('product_id', null, ['class'=>'', 'autofocus', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('product_id', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="flo col33 center">
                    {{ Form::label('quantity', 'Cantidad:') }}
                    {{ Form::text('quantity', $pa->orders_rest, ['class'=>'xs-input', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('quantity', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="flo col33 right">
                    <button type="submit" class="btn-green inline">
                        <i class="fa fa-archive"></i>
                        Asignar producto
                    </button>
                </div>
            </div>

            {{ Form::close() }}
        </div>
    @endif

    @if(count($pa->orders))
        @foreach($pa->orders as $order)
            <div class="col col100 block description-product">
                <h3 class="header">Sustituido por:</h3>

                @if ( Session::get('message') )
                    <aside class="msg_dialog">{{ Session::get('message') }}</aside>
                @endif

                <div class="col col100">
                    <figure class="flo col10 left">
                        <img src="{{ asset($order->product->image) }}" alt="{{ $order->product->barcode }}"/>
                    </figure>
                    <div class="flo col20 center">
                        <strong>Producto:</strong> <br/>
                        <a href="{{ route('product.show', [$order->product->slug, $order->product->id]) }}">
                            {{ $order->product->barcode }}
                        </a>
                    </div>
                    <div class="flo col20 center">
                        <strong>Cantidad:</strong> <br/>
                        {{ $order->quantity }}
                    </div>
                    <div class="flo col50 right">
                        <strong>Descripción corta:</strong>
                        {{ $order->product->s_description }}
                    </div>
                </div>

                @if($order->order->classification != 'Venta')
                    {{ Form::open(['route'=>['order.product.destroy', $order->id], 'method'=>'delete', 'class'=>'form']) }}
                    <hr/>

                    <div class="col col100">

                        <div class="flo col75 left text-right">
                            @if($order->product->type == 'Producto')
                                @if($order->product->p_description->have_series)

                                    @if($order->order->classification == 'Pedido')
                                        <a href="{{ route('series.create.separate', [$order->id]) }}" class="btn-green">N/S</a>
                                    @else
                                        <a href="{{ route('series.create.price', [$order->id]) }}" class="btn-green">N/S</a>
                                    @endif
                                    <div class="text-left">
                                    <ul>
                                    @foreach($order->series as $series)
                                        <li>
                                            {{ Form::checkbox('ns[]', $series->id, null, ['id'=>'ns'.$series->id]) }}
                                            {{ Form::label('ns'.$series->id, $series->ns) }}
                                        </li>
                                    @endforeach
                                    </ul>
                                    </div>
                                @else
                                    {{ Form::text('quantity', 0, ['class'=>'xs-input text-right', 'autocomplete'=>'off', 'data-required'=>'required', 'data-integer-unsigned'=>'integer', 'title'=>'Este campo es obligatorio.']) }}
                                @endif
                            @else
                                {{ Form::text('quantity', 0, ['class'=>'xs-input text-right', 'autocomplete'=>'off', 'data-required'=>'required', 'data-integer-unsigned'=>'integer', 'title'=>'Este campo es obligatorio.']) }}
                            @endif

                        </div>

                        <div class="flo col25 right">
                            <button type="submit" class="btn-red">
                                <i class="fa fa-times"></i> Desapartar
                            </button>
                        </div>

                    </div>
                    {{ Form::close() }}
                @endif
            </div>
        @endforeach
    @endif

@stop