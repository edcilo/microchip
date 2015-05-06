@if( $product->p_description )
    @if ( $product->p_description->have_series )
        <div class="col col100 block description-product">

            <h3 class="subtitle">Números de serie:</h3>

            @include('series/partials/listPaginate')
        </div>
    @endif
@endif
