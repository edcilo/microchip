@extends('layouts/layout_sist')

@section ('title') / Pagos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    @if( count($pending) )

        <div class="col col100">

            <h2>
                <i class="fa fa-clock-o"></i>
                Cambios pendientes
            </h2>

            @include('pay.partials.list_paginate_pending')

        </div>

    @endif

    <div class="col col100">

        <h2>
            <i class="fa fa-money"></i>
            Pagos
        </h2>

        @if ( count( $pays ) > 0 )

            @include('pay.partials.list_paginate_pays')

            @include('pay.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay pagos registrados.</p>

        @endif

    </div>

@stop
