<div class="col col100">
    <div class="row flo col20 left">
        {{ $sale->classification }}:
        <strong>{{ $sale->type }} {{ $sale->folio }}</strong>
    </div>

    <div class="row flo col20 center">
        Cliente: <strong>{{ $sale->customer->name }}</strong>
    </div>

    <div class="row flo col20 center">
        I.V.A.: <strong>{{ $sale->iva }}</strong>
    </div>

    <div class="row flo col20 center">
        Estado: <strong>{{ $sale->status }}</strong>
    </div>

    <div class="row flo col20 right text-right">
        @include('sale.partials.form_destroy')
    </div>
</div>