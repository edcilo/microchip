@extends('layouts/layout_sist')

@section ('title') / Cotización @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Cotización</h2>
        </div>

        <div class="flo col40 text-right">
            <a href="{{ route('price.index') }}" class="btn-blue">
                <i class="fa fa-list"></i>
                Volver a la lista de cotizaciones
            </a>
        </div>

        <div class="flo col30 text-right">
            {{-- @include('sale/partials/formSearch') --}}
        </div>
    </div>

    <div class="col col100 block description-product left">

        <div class="header">
            <h1>Folio: {{ $price->folio }}</h1>
            <span>({{ $price->status }})</span>

            <a class="btn-blue" title="Imprimir documento" target="_blank" href="{{ route('order.print.generate', [$price->folio, $price->id]) }}">
                <i class="fa fa-print"></i>
            </a>
        </div>

        @include('price/partials/header')

        {{ Form::open(['route'=>['price.to.order', $price->id], 'method'=>'post', 'class'=>'form']) }}

        <div class="col col100">
            <table class="table">
                <thead>
                <tr>
                    <th>Pedir</th>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Cost. unit.</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($price->pas as $pa)
                    @if($pa->productPrice)
                        <tr>
                            <td class="text-center">
                                {{ Form::checkbox('ids[]', $pa->id, false) }}
                            </td>
                            <td class="text-center">
                                {{ Form::text('quantity[]', $pa->quantity_price, ['class'=>'xs-input text-right']) }}
                            </td>
                            <td>{{ $pa->barcode}}</td>
                            <td>{{ $pa->s_description }}</td>
                            <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                            <td class="text-right">$ {{ $pa->total_f }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
                <tfoot class="text-right">
                <tr>
                    <td colspan="4"></td>
                    <td><strong>Total (I.V.A. incluido):</strong></td>
                    <td>$ {{ $price->total_price_f }}</td>
                </tr>
                </tfoot>
            </table>
        </div>

        <hr/>

        @if ( Session::get('message') )
            <aside class="msg_dialog">{{ Session::get('message') }}</aside>
        @endif
        <div class="message-error">
            {{ $errors->first('quantity', '<span>:message</span>') }}
        </div>
        <button class="btn-green">
            <i class="fa fa-file-o"></i>
            Crear orden de pedido
        </button>
        {{ Form::close() }}

    </div>

    <div class="block description-product">
        <p class="subtitle">Observaciones: :</p>

        {{ $price->description }}
    </div>

@stop