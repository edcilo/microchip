<?php

use microchip\customerReferral\CustomerReferralRepo;

use microchip\customerReferral\CustomerReferralUpdManager;

class CustomerReferrerController extends \BaseController {

	protected $referralRepo;

	public function __construct(
		CustomerReferralRepo	$customerReferralRepo
	)
	{
		$this->referralRepo	= $customerReferralRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /customerreferrer
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customerreferrer/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customerreferrer
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /customerreferrer/{id}
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
	 * GET /customerreferrer/{id}/edit
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
	 * PUT /customerreferrer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$referrer = $this->referralRepo->find($id);
		$this->notFoundUnless($referrer);

		$manager = new CustomerReferralUpdManager($referrer, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $referrer ];

			return Response::json($response);
		}

		return Redirect::back();
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /customerreferrer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $referrer = $this->referralRepo->find($id);
        $this->notFoundUnless($referrer);

        $customer = $referrer->referenced;

        $this->referralRepo->destroy($id);

        if ( Request::ajax() )
        {
            $response = $this->msg200 + [ 'data' => $customer ];

            return Response::json($response);
        }

        return Redirect::back();
	}

}