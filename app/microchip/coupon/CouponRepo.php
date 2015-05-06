<?php

namespace microchip\coupon;

use microchip\base\BaseRepo;

class CouponRepo extends BaseRepo
{
    public function getModel()
    {
        return new Coupon();
    }

    public function newCoupon()
    {
        return $coupon = new Coupon();
    }

    public function search($terms, $request = '', $take = 10)
    {
        $q = Coupon::where('folio', 'like', "%$terms%");

        return ($request == 'ajax') ? $q->take($take)->get() : $q->paginate();
    }
}
