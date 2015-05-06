@extends('layouts/layout_sist')

@section ('title') / Factura de compra {{ $purchase->folio }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('purchase.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('purchase.partials.form_search')
        </div>
    </div>

    @include('purchase.partials.data_tasks')

    @include('purchase.partials.data')

    <div class="col col100 block description-product">

        <div class="subtitle">
            Productos
        </div>

        @if ( Session::get('msg') )
            <aside class="msg_dialog">{{ Session::get('msg') }}</aside>
        @endif

        @if ( $purchase->progress_4 AND p(61) )

            @include('movement.partials.form_create_purchase')

            <hr/>

        @endif

        @if( count($purchase->movements) )

            @include('purchase.partials.list_products')

        @else

            <p class="title-clear">Aún no se registran productos.</p>

        @endif

        @if( $purchase->progress_4 AND p(61))
            <hr/>

            @include('purchase.partials.form_stop_products')
        @endif

    </div>

    <div class="col col100 block description-product">

        <div class="subtitle">
            Pago
        </div>


        @if ( !count($purchase->payment) AND p(61) )

            @include('purchasePayment\partials\formCreate')

        @endif

        @if( count($purchase->payment) )

            @include('purchase.partials.data_pay')

        @else

            <p class="title-clear">Aún no se registra un método de pago.</p>

        @endif

    </div>


    @if( p(61) )
        <div class="description-product" title="Subir factura escaneada" id="dialogRegister" data-width="500">

            @include('purchase/partials/formUpload')

        </div>
    @endif

@stop
