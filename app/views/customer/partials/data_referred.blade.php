@if($customer->referrer OR count($customer->referenced) )
    <div class="col col100 block description-product edc-hide-show">

        <div class="subtitle">
            Lista de referidos
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="table hide edc-hide-show-element col col100">

            @if ( $customer->referrer )
                <div class="flo col50 left">

                    <p>Recomendado por:</p>

                    @include('customerReferrer.partials.list_referrer')

                </div>
            @endif

            @if( count($customer->referenced) )
                <div class="flo col50 right">

                    <p>{{ $customer->name }} ha recomendado ha:</p>

                    @include('customerReferrer.partials.list_referenced')

                </div>
            @endif

        </div>

    </div>
@endif