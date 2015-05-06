@extends('layouts/layout_sist')

@section ('title') / Garantías @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-truck"></i> Garantías</h2>
        </div>

        <div class="flo col40 text-right">
            <a class="btn-green openDialog" href="{{ route('warranty.create') }}">
                <i class="fa fa-sign-in"></i> Registrar nueva garantía
            </a>
        </div>

        <div class="flo col30 text-right">
            @include('warranty/partials/formSearch')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $warranties ) > 0 )
            <table class="table">
                <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Proveedor</th>
                    <th>N/S</th>
                    <th>Venta</th>
                    <th>
                        <i class="fa fa-gears"></i> Opciones
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($warranties as $warranty)
                    <tr>
                        <td>{{ $warranty->quantity }}</td>
                        <td>{{ $warranty->product->barcode }}</td>
                        <td>{{ $warranty->provider->name }}</td>
                        <td>{{-- $warranty->series->ns --}}</td>
                        <td>{{ $warranty->sale->folio }}</td>
                        <td>
                            <nobr>
                            </nobr>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $warranties->links() }}

            <div class="confirm-dialog hide" title="Eliminar categoría" id="dialogConfirm" data-width="400">
                <div class="mesasge text-center">
                    <h3>¿Estas seguro de querer eliminar la categoría <span class="data_name"></span>?</h3>
                </div>
            </div>
            {{ Form::open(['route' => ['category.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

        @else
            <p class="title-clear">No hay garantías registradas.</p>
        @endif

    </div>

    <div title="Registrar garantía" id="dialogRegister" data-width="500">

        @include('warranty/partials/formCreate')

    </div>

@stop
