@extends ( 'layouts/layout_sist' )

@section ('title') / Buscar departamento @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col40">
        <h2><i class="fa fa-search"></i> Resultados de departamentos</h2>
    </div>

    <div class="flo col30 text-right">
        @include('department.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('department.partials.form_search')
    </div>
</div>

<div class="col col100">

    @if ( count( $terms ) > 0 )

        @include('department.partials.list_paginate_search')

        @include('department.partials.form_destroy_float')

    @else

        <p class="title-clear">No se obtuvierón resultados.</p>

    @endif

</div>

@stop
