<?php

use microchip\couponPurchase\CouponPurchaseRepo;

class CouponPurchaseController extends \BaseController {

    protected $couponRepo;

    public function __construct(CouponPurchaseRepo $couponPurchaseRepo)
    {
        $this->couponRepo = $couponPurchaseRepo;
    }

	public function index()
	{
        if (Request::ajax()) {
            return $this->couponRepo->getAll('all', 'folio', 'asc');
        }

        $coupons = $this->couponRepo->getAll('paginate', 'folio', 'desc');

        return View::make('couponPurchase/index', compact('coupons'));
	}

	public function show($id)
	{
        $coupon = $this->couponRepo->find($id);
        $this->notFoundUnless($coupon);

        if (Request::ajax()) {
            return Response::json($coupon);
        }

        return View::make('couponPurchase/show', compact('coupon'));
	}

    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            $results = $this->couponRepo->search($terms, 'ajax');

            return Response::json($results);
        } else {
            $results = $this->couponRepo->search($terms);

            return View::make('couponPurchase/search', compact('results', 'terms'));
        }
    }



}