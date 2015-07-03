@extends('layouts.layout_min')

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="form">
        <div class="message-error">
            <span>El usuario {{ $customer->prefix }} {{ $customer->name }} se registro correctamente.</span>
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $customer->prefix }} {{ $customer->name }}</h1>
        </div>

        <div class="col col100">

            @include('customer.partials.data')

        </div>

    </div>

    @include('customer.partials.form_create_card')

@stop