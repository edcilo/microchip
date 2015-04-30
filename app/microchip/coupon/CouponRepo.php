<?php namespace microchip\coupon;

use microchip\base\BaseRepo;

class CouponRepo extends BaseRepo {

    public function getModel()
    {
        return new Coupon();
    }

    public function newCoupon()
    {
        return $coupon = new Coupon();
    }

}