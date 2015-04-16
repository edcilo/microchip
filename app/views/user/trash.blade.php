@extends ( 'layouts/layout_sist' )

@section ('title') / Usuarios despedidos @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-group"></i> Empleados eliminados</h2>
    </div>

    <div class="flo col40 text-right">
        @include('user.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('user.partials.form_search')
    </div>
</div>

<div class="col col100">

    @if ( count( $users ) > 0 )

        @include('user.partials.list_paginate_trash')

        @include('user.partials.form_active')

        @include('user.partials.form_destroy')

    @else

        <p class="title-clear">No hay empleados eliminados.</p>

    @endif

</div>

@stop