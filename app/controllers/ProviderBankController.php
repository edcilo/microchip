<?php

use microchip\providerBank\ProviderBankRepo;
use microchip\provider\ProviderRepo;

use microchip\providerBank\ProviderBankRegManager;
use microchip\providerBank\ProviderBankUpdManager;

class ProviderBankController extends \BaseController {

	protected $bankRepo;
	protected $providerRepo;

	public function __construct(
		ProviderBankRepo	$providerBankRepo,
		ProviderRepo		$providerRepo
	)
	{
		$this->bankRepo		= $providerBankRepo;
		$this->providerRepo	= $providerRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /providerbank
	 *
	 * @return Response
	 */
	public function index()
	{
		return Redirect::route('provider.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /providerbank/create
	 *
	 * @param  int $provider_id
	 * @return Response
	 */
	public function create($provider_id)
	{
		$provider = $this->providerRepo->find($provider_id);

		return View::make('providerBank/create', compact('provider'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /providerbank
	 *
	 * @return Response
	 */
	public function store()
	{
		$bank		= $this->bankRepo->newBank();
		$manager	= new ProviderBankRegManager($bank, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $bank ];

			return Response::json($response);
		}

		return Redirect::route('provider.show', [$bank->provider->slug, $bank->provider->id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /providerbank/{id}/edit
	 *
	 * @param  int  $id
	 * @param  int  $provider_id
	 * @return Response
	 */
	public function edit($id, $provider_id)
	{
		$bank = $this->bankRepo->find($id);
		$this->notFoundUnless($bank);

		$provider = $this->providerRepo->find($provider_id);

		return View::make('providerBank/edit', compact('bank', 'provider'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /providerbank/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$bank = $this->bankRepo->find($id);
		$this->notFoundUnless($bank);

		$manager = new ProviderBankUpdManager($bank, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $bank ];

			return Response::json($response);
		}

		return Redirect::route('provider.show', [$bank->provider->slug, $bank->provider->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /providerbank/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$bank = $this->bankRepo->find($id);
		$this->notFoundUnless($bank);

		$this->bankRepo->destroy($id);

		if ( Request::ajax() )
		{
			$response = $this->msg200 + [ 'data' => $bank ];

			return Response::json($response);
		}

		return Redirect::route('provider.show', [$bank->provider->slug, $bank->provider->id]);
	}

}