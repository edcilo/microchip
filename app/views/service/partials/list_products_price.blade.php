@foreach($sale->pas as $pa)

    @if(!$pa->productOrder)

        <div class="tr">
            @if( p(101) )
                {{ Form::open(['route'=>['price.to.order.one', $pa->id], 'method'=>'post', 'class'=>'form validate']) }}
            @endif
            <div class="flo col40">
                <div class="flo col10 left text-right">
                    @if( p(101) )
                        {{ Form::text('quantity', $pa->quantity, ['class'=>'xs-input text-right', 'data-required'=>'data-required', 'data-integer'=>'integer']) }}
                    @else
                        {{ $pa->quantity }}
                    @endif
                </div>
                <div class="flo col40 center">
                    {{ $pa->barcode }}
                </div>
                <div class="flo col50 center">
                    {{ $pa->s_description }}
                </div>
            </div>
            <div class="flo col10 text-right center">
                <nobr>$ {{ $pa->selling_price_f }}</nobr>
            </div>
            <div class="flo col10 text-right center">
                <nobr>$ {{ $pa->total_f }}</nobr>
            </div>
            <div class="flo col40 right">
                <div class="flo col20 text-center center">
                    <i class="fa fa-check"></i>
                </div>
                <div class="flo col20 text-center right">
                    @if( p(101) )
                        <button type="submit" class="btn-green" title="Enviar a pedido">
                            <i class="fa fa-check"></i>
                        </button>
                    @endif
                </div>
            </div>
            @if( p(101) )
                {{ Form::close() }}
            @endif
        </div>

    @endif

@endforeach