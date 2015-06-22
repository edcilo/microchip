@extends('layouts/layout_sist')

    @section ('title') / Variables globales @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col60">
            <h2><i class="fa fa-globe"></i> Variables globales</h2>
        </div>

        <div class="flo col40 text-right">
            @include('configuration.partials.btn_edit')
        </div>
    </div>

    <div class="col col100 block description-product">

        <table class="table">
            <thead>
            <tr>
                <th>Variable</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <strong>I.V.A. (%)</strong>
                </td>
                <td class="text-right">{{ $configuration->iva }}</td>
            </tr>
            <tr>
                <td>
                    <strong>Valor del dolar ($):</strong>
                </td>
                <td class="text-right">{{ $configuration->dollar }}</td>
            </tr>
            <tr>
                <td>
                    <strong>Días de vigencia del cupón</strong>
                </td>
                <td class="text-right">{{ $configuration->coupon_effective_days }}</td>
            </tr>
            <tr>
                <td>
                    <strong>Condiciones de uso para el cupón</strong>
                </td>
                <td>{{ $configuration->coupon_terms_use }}</td>
            </tr>
            <tr>
                <td>
                    <strong>Ancho del papel de impresion de codigo de barras</strong>
                </td>
                <td class="text-right">{{ $configuration->width_paper_barcode }} cm.</td>
            </tr>
            <tr>
                <td>
                    <strong>Alto del papel de impresion de codigo de barras</strong>
                </td>
                <td class="text-right">{{ $configuration->height_paper_barcode }} cm.</td>
            </tr>
            <tr>
                <td>
                    <strong>Ancho de la barra del codigo de barras en los documentos (ventas, pedidos, servicios cotizaciones)</strong>
                </td>
                <td class="text-right">{{ $configuration->width_bar_document_barcode }} mm.</td>
            </tr>
            <tr>
                <td>
                    <strong>Alto del codigo de barras en los documentos (ventas, pedidos, servicios cotizaciones)</strong>
                </td>
                <td class="text-right">{{ $configuration->height_document_barcode }} mm.</td>
            </tr>
            <tr>
                <td>
                    <strong>Ancho de la barra del codigo de barras de los productos</strong>
                </td>
                <td class="text-right">{{ $configuration->width_bar_product_barcode }} mm.</td>
            </tr>
            <tr>
                <td>
                    <strong>Alto del codigo de barras de los productos</strong>
                </td>
                <td class="text-right">{{ $configuration->height_product_barcode }} mm.</td>
            </tr>
            <tr>
                <td>
                    <strong>Ancho de la barra del codigo de barras de los números de serie</strong>
                </td>
                <td class="text-right">{{ $configuration->width_bar_series_barcode }} mm.</td>
            </tr>
            <tr>
                <td>
                    <strong>Alto del codigo de barras de los números de serie</strong>
                </td>
                <td class="text-right">{{ $configuration->height_series_barcode }} mm.</td>
            </tr>
            </tbody>
        </table>
    </div>

@stop
