@extends('layouts/layout_sist')

@section ('title') / Cotizaciones @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Cotizaciones</h2>
        </div>

        <div class="flo col30 text-right">
            &nbsp;
        </div>

        <div class="flo col40 text-right">
            {{-- @include('sale/partials/formSearch') --}}
        </div>
    </div>

    <div class="col col100">

        @include('price/partials/listPaginate')

    </div>

@stop