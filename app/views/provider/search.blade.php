@extends('layouts/layout_sist')

@section ('title') / Buscar proveedor @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-search"></i> Resultados de proveedor</h2>
        </div>

        <div class="flo col40 text-right">
            <a class="btn-blue" href="{{ route('provider.index') }}"><i class="fa fa-list"></i> Volver a la lista de proveedores</a>
        </div>

        <div class="flo col30 text-right">
            @include('provider.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $results ) > 0 )
            <table class="table">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>R.F.C.</th>
                    <th>Clasificación</th>
                    <th>Correo electrónico</th>
                    <th>Teléfono</th>
                    <th>
                        <i class="fa fa-gears"></i>
                        Opciones
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $results as $provider )
                    <tr>
                        <td>{{ $provider->name }}</td>
                        <td>{{ $provider->rfc }}</td>
                        <td>{{ $provider->classification }}</td>
                        <td>{{ $provider->email }}</td>
                        <td>{{ $provider->number }}</td>
                        <td class="text-center">
                            <nobr>
                                <a class="btn-blue" title="Ver detalles" href="{{ route('provider.show', [$provider->slug, $provider->id]) }}"><i class="fa fa-eye"></i></a>
                                @if ( $provider->active == 1 )
                                    <a class="btn-yellow" title="Editar proveedor" href="{{ route('provider.edit', [$provider->slug, $provider->id]) }}"><i class="fa fa-pencil"></i></a>
                                    <a class="btn-red btn-recycle" title="Enviar a la papelera" href="#" data-id="{{ $provider->id }}"><i class="fa fa-trash"></i></a>
                                @else
                                    <a class="btn-green btn-active" title="Devolver proveedor a la lista" href="#" data-id="{{ $provider->id }}"><i class="fa fa-arrow-up"></i></a>
                                    <a class="btn-red btn-delete" title="Eliminar del sistema" href="#" data-id="{{ $provider->id }}"><i class="fa fa-times"></i></a>
                                @endif
                            </nobr>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $results->appends(['terms' => $terms])->links() }}


            <div class="confirm-dialog hide" title="Eliminar proveedor" id="dialogTrash" data-width="400">
                <div class="mesasge text-center">
                    <h3>¿Estas seguro de querer enviar a la papelera al proveedor <span class="data_name"></span>?</h3>
                </div>
            </div>
            <div class="confirm-dialog hide" title="Devolver proveedor" id="dialogRestore" data-width="500">
                <div class="message text-center">
                    <h4>¿Esta seguro de querer devolver al provedor <span class="data_name"></span>?</h4>
                </div>
            </div>
            <div class="confirm-dialog hide" title="Eliminar proveedor" id="dialogConfirm" data-width="500">
                <div class="message text-center">
                    <h4>¿Esta seguro de querer eliminar al provedor <span class="data_name"></span> de forma definitiva?</h4>
                </div>
            </div>
            {{ Form::open(['route' => ['provider.soft.delete', 'PRODUCT_ID'], 'method' => 'POST', 'role' => 'form', 'id' => 'form-recycle']) }}{{ Form::close() }}
            {{ Form::open(['route' => ['provider.restore', 'PRODUCT_ID'], 'method' => 'POST', 'role' => 'form', 'id' => 'form-active']) }}{{ Form::close() }}
            {{ Form::open(['route' => ['provider.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

        @else
            <p class="title-clear">No se obtuvieron resultados.</p>
        @endif

    </div>

@stop
