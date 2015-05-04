<?php

use microchip\coupon\CouponRepo;
use microchip\company\CompanyRepo;
use microchip\helpers\NumberToLetter;
use microchip\configuration\ConfigurationRepo;

class CouponController extends \BaseController {

    protected $couponRepo;
    protected $companyRepo;
    protected $confRepo;

    public function __construct(
        CouponRepo  $couponRepo,
        CompanyRepo $companyRepo,
        ConfigurationRepo   $configurationRepo
    )
    {
        $this->couponRepo   = $couponRepo;
        $this->companyRepo  = $companyRepo;
        $this->confRepo     = $configurationRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /coupon
	 *
	 * @return Response
	 */
	public function index()
	{
        if ( Request::ajax() ) return $this->couponRepo->getAll('all', 'folio', 'DESC');

        $coupons = $this->couponRepo->getAll('paginate', 'folio', 'DESC');

        return View::make('coupon/index', compact('coupons'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /coupon/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /coupon
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /coupon/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /coupon/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /coupon/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /coupon/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $coupon = $this->couponRepo->find($id);
        $this->notFoundUnless($coupon);

        $this->couponRepo->destroy($id);

        if ( Request::ajax() )
        {
            $response = $this->msg200 + [ 'data' => $coupon ];

            return Response::json($response);
        }

        return Redirect::route('coupon.index');
	}

    public function generatePrint($id)
    {
        $coupon = $this->couponRepo->find($id);
        $this->notFoundUnless($coupon);

        $company	= $this->companyRepo->find(1);

        $no2letter          = new NumberToLetter();
        $coupon->value_text = strtoupper( $no2letter->ValorEnLetras($coupon->value, 'pesos') );
        $coupon->coupon_terms_use = $this->confRepo->find(1)->coupon_terms_use;

        $pdf = PDF::loadView('coupon/layout_print', compact('company', 'coupon'))->setPaper('letter');
        return $pdf->stream();
    }

}