@extends ( 'layouts/layout_sist' )

@section ('title') / {{ $customer->name }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('customer.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('customer.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <div class="header">
                <h1>{{ $customer->prefix }} {{ $customer->name }}</h1>

                @include('customer.partials.btn_edit')
            </div>

            <div class="col col100">

                @include('customer.partials.data')

            </div>

            @include('customer.partials.form_trash')

            @include('customer.partials.form_active')

        </div>

    </div>

    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            Contactos
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="table edc-hide-show-element hide">

            @include('customerContact.partials.list')

            @include('customerContact.partials.form_create')

        </div>

    </div>

    @include('customer.partials.data_referred')

    @include('customer.partials.list_paginate_sales')

    @include('customer.partials.form_create_card')

@stop