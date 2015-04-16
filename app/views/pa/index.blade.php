@extends('layouts/layout_sist')

@section ('title') / PAs @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Productos ordenados</h2>
        </div>

        <div class="flo col30 text-right">
            &nbsp;
        </div>

        <div class="flo col40 text-right">
            {{-- @include('sale/partials/formSearch') --}}
        </div>
    </div>

    <div class="col col100">

        @if( count($pas) )

            <table class="table">
                <thead>
                <tr>
                    <th>Folio doc.</th>
                    <th>Código de barras</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>
                        <i class="fa fa-gears"></i>
                        Opciones
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($pas as $pa)
                    @if($pa->status != 'Surtido')
                        <tr>
                            <td>
                                <a href="{{ route('sale.show', [$pa->sale->folio, $pa->sale->id]) }}">
                                    {{ $pa->sale->folio }}
                                </a>
                            </td>
                            <td>{{ $pa->barcode }}</td>
                            <td>{{ $pa->s_description }}</td>
                            <td class="text-right">{{ $pa->quantity }}</td>
                            <td class="text-center">
                                <nobr>
                                    <a href="{{ route('pas.show', [$pa->id]) }}" class="btn-blue" title="Ver detalles">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </nobr>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>

        @else

            <p class="title-clear">No hay PAs registrados.</p>

        @endif

    </div>

@stop