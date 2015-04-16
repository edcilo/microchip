@extends ( 'layouts/layout_sist' )

@section ('title') / Agregar monedero @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('customer.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('customer.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <div class="header">
                <h2><i class="fa fa-credit-card"></i> Asignar monedero al cliente</h2>

                @include('customer.partials.btn_show')
            </div>

            @include('customer.partials.form_create_card')

        </div>

    </div>

@stop