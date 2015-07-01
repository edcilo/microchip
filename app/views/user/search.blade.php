@extends ( 'layouts/layout_sist' )

@section ('title') / Buscar usuario @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-search"></i> Buscar usuarios</h2>
    </div>

    <div class="flo col40 text-right">
        @include('user.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('user.partials.form_search')
    </div>
</div>

<div class="col col100">

    @if ( count( $results ) > 0 )

        @include('user.partials.list_paginate_search')

        @include('user.partials.form_trash_float')

        @include('user.partials.form_active')

        @include('user.partials.form_destroy_float')

    @else
    <p class="title-clear">No se obtuvierón resultados.</p>
    @endif


</div>

@stop
