@extends ( 'layouts/layout_sist' )

@section ('title') / Usuarios @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-user"></i> Empleados</h2>
        </div>

        <div class="flo col40 text-right">
            @include('user.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('user.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $users ) > 0 )

            @include('user.partials.list_paginate')

            @include('user.partials.form_trash_float')

        @else

            <p class="title-clear">No hay usuarios registrados.</p>

        @endif

    </div>

@stop