<?php

use microchip\providerPhone\ProviderPhoneRepo;
use microchip\provider\ProviderRepo;

use microchip\providerPhone\ProviderPhoneRegManager;
use microchip\providerPhone\ProviderPhoneUpdManager;

class ProviderPhoneController extends \BaseController {

	protected $phoneRepo;
	protected $providerRepo;

	public function __construct(
		ProviderPhoneRepo	$providerPhoneRepo,
		ProviderRepo		$providerRepo
	)
	{
		$this->phoneRepo	= $providerPhoneRepo;
		$this->providerRepo	= $providerRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /providerphone
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::route('provider.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /providerphone/create
	 *
	 * @param  int $provider_id
	 * @return Response
	 */
	public function create($provider_id)
	{
		$provider = $this->providerRepo->find($provider_id);

		return View::make('providerPhone/create', compact('provider'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /providerphone
	 *
	 * @return Response
	 */
	public function store()
	{
		$phone		= $this->phoneRepo->newPhone();
		$manager	= new ProviderPhoneRegManager($phone, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $phone ];

			return Response::json($response);
		}

		return Redirect::route('provider.show', [$phone->provider->slug, $phone->provider->id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /providerphone/{id}/edit
	 *
	 * @param  int $provider_id
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, $provider_id)
	{
		$phone = $this->phoneRepo->find($id);
		$this->notFoundUnless($phone);

		$provider = $this->providerRepo->find($provider_id);

		return View::make('providerPhone/edit', compact('phone', 'provider'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /providerphone/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$phone = $this->phoneRepo->find($id);
		$this->notFoundUnless($phone);

		$manager = new ProviderPhoneUpdManager($phone, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $phone ];

			return Response::json($response);
		}

		return Redirect::route('provider.show', [$phone->provider->slug, $phone->provider->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /providerphone/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$phone = $this->phoneRepo->find($id);
		$this->notFoundUnless($phone);

		$this->phoneRepo->destroy($id);

		if ( Request::ajax() )
		{
			$response = $this->msg200 + [ 'data' => $phone ];

			return Response::json($response);
		}

		return Redirect::route('provider.show', [$phone->provider->slug, $phone->provider->id]);
	}

}