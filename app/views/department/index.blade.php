@extends ( 'layouts/layout_sist' )

@section ('title') / Departamentos @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Departamentos</h2>
        </div>

        <div class="flo col40 text-right">
            @include('department.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('department.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $departments ) > 0 )

            @include('department.partials.list_paginate')

            @include('department.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay departamentos registrados.</p>

        @endif

    </div>

    @include('department.partials.form_create_float')

@stop