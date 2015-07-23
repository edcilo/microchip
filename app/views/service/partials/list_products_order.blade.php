@foreach($sale->pas as $pa)

    @if($pa->status != 'Surtido' AND $pa->productOrder AND !$pa->soft_delete)

        <div class="tr yellow">
            <div class="flo col40">
                <div class="flo col10 left text-right">
                    {{ $pa->quantity }}
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
                <div class="flo col20 text-center center">
                    <i class="fa fa-check"></i>
                </div>
                <div class="flo col20 text-center right">
                    @if( p(102) AND $sale->status != 'Cancelado' AND !$sale->trash )
                        <a href="{{ route('pas.show', $pa->id) }}" class="btn-yellow" title="Surtir producto">
                            <i class="fa fa-pencil"></i>
                        </a>
                    @else
                        &nbsp;
                    @endif
                </div>
                <div class="flo col20">&nbsp;</div>
                <div class="flo col20 text-center right">
                    {{ Form::open(['route'=>['price.disorder.one', $pa->id], 'method'=>'delete', 'class'=>'form validate inline']) }}
                    <button type="submit" class="btn-red form_confirm" data-confirm="disorder_confirm_{{ $pa->id }}">
                        <i class="fa fa-times"></i>
                    </button>
                    {{ Form::close() }}

                    <div class="confirm-dialog hide" title="Regresar producto a cotizado" id="disorder_confirm_{{ $pa->id }}" data-width="400">
                        <div class="mesasge text-center">
                            <h3>¿Estas seguro de querer devolver el producto {{ $pa->barcode }} a cotizado?</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endforeach
