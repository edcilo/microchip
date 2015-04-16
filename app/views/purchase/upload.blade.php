@extends('layouts/layout_sist')

@section ('title') / Registrar factura de compra @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            <a class="btn-blue" href="{{ route('purchase.show', [$purchase->folio, $purchase->id]) }}">
                <i class="fa fa-eye"></i> Volver a la factura {{ $purchase->folio }}
            </a>
        </div>

        <div class="flo col30 text-right">
            @include('purchase.partials.form_search')
        </div>
    </div>

    <div class="block col100">

        <div class="description-product">
            <h2 class="header">Subir factura {{ $purchase->folio }} escaneada.</h2>
        </div>

        @include('purchase/partials/formUpload')

    </div>

@stop