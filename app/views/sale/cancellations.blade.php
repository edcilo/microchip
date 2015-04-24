@extends('layouts/layout_sist')

@section ('title') / Cancelaciones @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col50">
            <h2>
                <i class="fa fa-ban"></i>
                Cancelaciones
            </h2>
        </div>

        <div class="flo col50 text-right">
            @include('sale.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $sales ) > 0 )

            @include('sale.partials.list_cancellations')

        @else

            <p class="title-clear">No hay cancelaciones.</p>

        @endif

    </div>

@stop