@if( p(79) )

    <div class="col col100 block description-product">

        <div class="subtitle">Reajustar total</div>

        {{ Form::model($sale, ['route'=>['sale.adjust.price', $sale->id], 'method'=>'put', 'class'=>'form']) }}

        <div class="col col100">
            <div class="row flo col33 left">
                <strong>Precio de venta IVA incluido:</strong>
                $ {{ $sale->total_f }}
            </div>

            <div class="row flo col33 right">
                <strong>{{ Form::label('new_price', 'Precio de factura:') }}</strong> $
                @if( p(80) AND $sale->status != 'Cancelado' )
                    {{ Form::text('new_price', null, ['class'=>'sm-input text-right', 'data-required'=>'required', 'data-integer-unsigned'=>'integer']) }}
                @else
                    {{ $sale->new_price }}
                @endif
                <div class="message-error">
                    {{ $errors->first('new_price', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row flo col33 right text-right">
                @if( p(80) AND $sale->status != 'Cancelado' )
                    <button type="submit" class="btn-green">
                        <i class="fa fa-save"></i>
                        Guardar ajuste
                    </button>
                @endif
            </div>
        </div>

        {{ Form::close() }}

        @if($sale->new_price != 0)
            <hr/>

            <div class="col col100">
                <div class="row flo col33 left">
                    <strong>Diferencia de I.V.A.:</strong>
                    $ {{ $sale->difference_iva }}
                </div>

                <div class="row flo col33 right">
                    <strong>Total cobrado (PV + DI):</strong>
                    $ {{ $sale->pv_di_f }}
                </div>
            </div>
        @endif
    </div>

@endif