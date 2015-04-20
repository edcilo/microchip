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
        @include('price.partials.form_destroy')
    </div>
</div>