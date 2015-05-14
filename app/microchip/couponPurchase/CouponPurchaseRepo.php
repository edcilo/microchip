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

}