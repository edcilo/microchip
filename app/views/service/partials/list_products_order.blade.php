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
                    @if( p(102) )
                        <a href="{{ route('pas.show', $pa->id) }}" class="btn-green" title="Surtir producto">
                            <i class="fa fa-check"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

    @endif

@endforeach