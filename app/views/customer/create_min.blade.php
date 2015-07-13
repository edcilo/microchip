@extends('layouts.layout_min')

@section('scripts')
    {{ HTML::script('js/search_customer.js') }}
    {{ HTML::script('js/customer.js') }}
@stop

@section('content')

    <div class="col col100 block description-product">

        <h2 class="header">Formulario de registro de cliente</h2>

        {{ Form::open(['route'=>'customer.store', 'method'=>'post', 'role'=>'form', 'class'=>'form validate send-close']) }}
        {{ Form::hidden('close', 1) }}
        @include('customer.partials.form_create')

    </div>

@stop