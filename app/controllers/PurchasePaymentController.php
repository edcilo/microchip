<?php

use microchip\purchasePayment\PurchasePaymentRepo;
use microchip\purchase\PurchaseRepo;

use microchip\purchasePayment\PurchasePaymentRegManager;

class PurchasePaymentController extends \BaseController {

	protected $paymentRepo;
	protected $purchaseRepo;

	public function __construct(
		PurchasePaymentRepo	$purchasePaymentRepo,
		PurchaseRepo		$purchaseRepo
	)
	{
		$this->paymentRepo	= $purchasePaymentRepo;
		$this->purchaseRepo	= $purchaseRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /purchasepayment
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /purchasepayment/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /purchasepayment
	 *
	 * @return Response
	 */
	public function store()
	{
		$data       = \Input::all();

		$data += ['status'=>'Pagado'];

		$payment = $this->paymentRepo->newPayment();
		$manager = new PurchasePaymentRegManager($payment, $data);
		$manager->save();

		$purchase = $this->purchaseRepo->find($payment->purchase_id);
		$purchase->status		= 'Pagado';
		$purchase->progress_1	= 1;
		$purchase->save();

		return Redirect::route('purchase.show', [$purchase->folio, $purchase->id]);
	}

	/**
	 * Display the specified resource.
	 * GET /purchasepayment/{id}
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
	 * GET /purchasepayment/{id}/edit
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
	 * PUT /purchasepayment/{id}
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
	 * DELETE /purchasepayment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}