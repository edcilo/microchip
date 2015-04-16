@if( p(90) AND $movement->product->p_description )

    @if($movement->product->p_description->have_series)
        <a href="{{ route('series.create.separate', [$movement->id]) }}" class="btn-green">N/S</a>
    @endif

@endif