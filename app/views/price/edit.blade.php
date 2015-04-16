@extends('layouts/layout_sales')

@section ('title') / Cotización @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100 block description-product left">

        <div class="col col100">
            <div class="row flo col20">
                {{ $sale->classification }}:
                <strong>{{ $sale->folio }}</strong>
            </div>

            <div class="row flo col40">
                Cliente: <strong>{{ $sale->customer->name }}</strong>
            </div>

            <div class="row flo col20">
                I.V.A.: <strong>{{ $sale->iva }}</strong>
            </div>

            <div class="row flo col20 text-right">
                {{ Form::open(['route'=>['sale.destroy', $sale->id], 'method'=>'delete']) }}
                <button class="btn-red" type="submit" title="Eliminar cotización">
                    <i class="fa fa-times"></i>
                    Borrar cotización
                </button>
                {{ Form::close() }}
            </div>
        </div>

        <hr/>

        <div class="subtitle">

            {{ Form::open(['route'=>'pas.order.store', 'method'=>'post', 'class'=>'form validate']) }}
            @include('movement.partials.form_create_sale')

        </div>

        <div class="col col100">

            @if ( count($sale->movements) OR count($sale->pas) )

                <table class="table">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Total</th>
                        <th><i class="fa fa-gears"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sale->pas as $pa)
                        @if($pa->productPrice)
                        <tr>
                            <td>{{ $pa->barcode }}</td>
                            <td>{{ $pa->s_description }}</td>
                            <td class="text-right">{{ $pa->quantity }}</td>
                            <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                            <td class="text-right">$ {{ $pa->total_f }}</td>
                            <td class="text-right">
                                {{ Form::open(['route'=>['pas.destroy', $pa->id], 'method'=>'delete', 'class'=>'inline']) }}
                                <button type="submit" class="btn-red" title="Borrar producto">
                                    <i class="fa fa-times"></i>
                                </button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endif
                    @endforeach()
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td>Total:</td>
                        <td class="text-right">$ {{ $sale->total_price_f }}</td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>

                <div class="col col100 row">
                    <div class="flo col50">
                        <a href="{{ route('price.clone', [$sale->id]) }}" class="btn-blue" target="_blank">
                            <i class="fa fa-copy"></i>
                            Clonar cotización
                        </a>
                    </div>
                    @if( ! $sale->movements_end )
                        <div class="flo col50 text-right">
                            @if( $sale->series_end )
                                    <a href="{{ route('sale.stop', [$sale->id]) }}" class="btn-green">
                                        <i class="fa fa-arrow-right"></i>
                                        Siguiente
                                    </a>
                            @else
                                <p class="text-right">Falta capturar números de serie...</p>
                            @endif
                        </div>
                    @endif
                </div>

            @endif

        </div>

    </div>

    @if ( $sale->movements_end )
        <div class="col col100 block description-product">

            <div class="subtitle">
                <h3>Cliente</h3>
            </div>

            {{ Form::model($sale, ['route'=>['price.update', $sale->id], 'method'=>'put', 'class'=>'form validate']) }}

            <div class="col col100">
                <div class="row flo col25 left">
                    {{ Form::label('customer_id', 'Cliente: ') }} <br/>
                    {{ Form::text('customer_id', null, ['data-required'=>'required', 'title'=>'Este campo es obligatorio.']) }}
                    <div class="message-error">
                        {{ $errors->first('customer_id', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="row flo col25 center">
                    {{ Form::label('description', 'Observaciones:') }} <br/>
                    {{ Form::textarea('description', null, ['class'=>'xb-input', 'rows'=>3]) }} <br/>
                    <div class="message-error">
                        {{ $errors->first('description', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="row flo col25 right">
                    <br/>
                    <button type="submit" class="btn-green">
                        <i class="fa fa-save"></i>
                        Guardar
                    </button>
                </div>
            </div>

            {{ Form::close() }}

        </div>
    @endif

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop