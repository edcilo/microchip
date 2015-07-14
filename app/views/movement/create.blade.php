@extends('layouts/layout_sist')

@section ('title') / Registrar movimiento de inventario @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/search_product.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col50">
            <h2><i class="fa fa-refresh"></i> Registrar movimiento de inventario</h2>
        </div>

        <div class="flo col50 text-right">
            <a class="btn-blue" href="{{ route('movement.index') }}">
                <i class="fa fa-list"></i> Volver a la lista de movimientos
            </a>
        </div>
    </div>

    @if ( Session::get('msg') )
        <aside class="msg_dialog">{{ Session::get('msg') }}</aside>
    @endif

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Formulario de registro de movimiento</h2>

            @include('movement/partials/formCreate')

        </div>

    </div>

@stop
