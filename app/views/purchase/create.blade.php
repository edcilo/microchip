@extends('layouts/layout_sist')

@section ('title') / Registrar factura de compra @stop

@section('scripts')
    {{ HTML::script('js/search_provider.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2>Registrar nueva factura de compra</h2>
        </div>

        <div class="flo col30 text-right">
            @include('purchase.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('purchase.partials.form_search')
        </div>
    </div>

    <div class="block col100 description-product">

        <h2 class="header">Formulario de registro de compra</h2>

        {{ Form::open(['route'=>'purchase.store', 'method'=>'post', 'role'=>'form', 'class'=>'form validate']) }}
        @include('purchase.partials.form_create')

    </div>

@stop
