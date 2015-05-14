@if(count($purchase->coupons))
    <div class="block description-product">

        <div class="subtitle">Notas de crédito</div>

        <div class="text-center">
            @include('couponPurchase.partials.list_coupons', ['coupons' => $purchase->coupons])
        </div>

    </div>
@endif