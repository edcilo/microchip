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
                <td>{{ $configuration->iva }}</td>
            </tr>
            <tr>
                <td>
                    <strong>Valor del dolar ($):</strong>
                </td>
                <td>{{ $configuration->dollar }}</td>
            </tr>
            <tr>
                <td>
                    <strong>Días de vigencia del cupón</strong>
                </td>
                <td>{{ $configuration->coupon_effective_days }}</td>
            </tr>
            <tr>
                <td>
                    <strong>Condiciones de uso para el cupón</strong>
                </td>
                <td>{{ $configuration->coupon_terms_use }}</td>
            </tr>
            </tbody>
        </table>
    </div>

@stop