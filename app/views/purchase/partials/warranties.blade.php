@if(count($purchase->warranties))
<div class="col col100 block description-product">

    <div class="subtitle">
        Garantias
    </div>

    @include('warranty.partials.list', ['warranties' => $purchase->warranties])

    @include('warranty.partials.form_destroy_float')

</div>
@endif