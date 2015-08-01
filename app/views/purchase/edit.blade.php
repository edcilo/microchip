@extends('layouts/layout_sist')

@section ('title') / Modificar datos de factura de compra @stop

@section('scripts')
    {{ HTML::script('js/search_provider.js') }}
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2>Modificar datos de la factura de compra</h2>
        </div>

        <div class="flo col30 text-right">
            @include('purchase.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('purchase.partials.form_search')
        </div>
    </div>

    <div class="block col100 description-product">

        <div class="header">
            <h2>Modificar compra {{ $purchase->folio }} con {{ $purchase->provider->name }}</h2>
        </div>

        {{ Form::model($purchase, ['route'=>['purchase.update', $purchase->id], 'method'=>'put', 'role'=>'form', 'class'=>'form validate']) }}
        @include('purchase.partials.form_create')

    </div>

    @include('provider.partials.form_create_float')

@stop
