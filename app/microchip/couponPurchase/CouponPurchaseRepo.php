<?php

namespace microchip\couponPurchase;

use microchip\base\BaseRepo;

class CouponPurchaseRepo extends BaseRepo {

    public function getModel()
    {
        return new CouponPurchase();
    }

    public function newCoupon()
    {
        return $coupon = new CouponPurchase();
    }

    public function getByFolio($folio)
    {
        return CouponPurchase::where('folio', $folio)->first();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = CouponPurchase::where('folio', 'like', "%$terms%")
            ->orwhere('value', 'like', "%$terms%")
            ->orwhere('observations', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }

}