@extends ( 'layouts/layout_sist' )

@section ('title') / Clientes @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-group"></i> Clientes</h2>
        </div>

        <div class="flo col40 text-right">
            @include('customer.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('customer.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $customers ) > 0 )

            @include('customer.partials.list_paginate')

            @include('customer.partials.form_trash_float')

        @else

            <p class="title-clear">No hay clientes registrados.</p>

        @endif

    </div>

    @include('customer.partials.form_create_float')

@stop