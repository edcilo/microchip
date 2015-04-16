<div class="col col100">
    <div class="row flo col20">
        <strong>
            {{ $sale->classification }}
        </strong>
    </div>

    <div class="row flo col40"></div>

    <div class="row flo col20">
        I.V.A.: <strong>{{ $sale->iva }}</strong>
    </div>

    <div class="row flo col20 text-right">
        @include('order.partials.form_destroy')
    </div>
</div>