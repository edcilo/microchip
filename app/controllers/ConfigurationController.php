<?php

use microchip\configuration\ConfigurationRepo;

use microchip\configuration\ConfigurationUpdManager;

class ConfigurationController extends \BaseController {

	protected $configurationRepo;

	public function __construct(
		ConfigurationRepo	$configurationRepo
	)
	{
		$this->configurationRepo	= $configurationRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /configuration
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /configuration/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /configuration
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /configuration/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$configuration = $this->configurationRepo->find(1);
		$this->notFoundUnless($configuration);

		if ( Request::ajax() ) return Response::json($configuration);

		return View::make('configuration/show', compact('configuration'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /configuration/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$configuration = $this->configurationRepo->find(1);
		$this->notFoundUnless($configuration);

		return View::make('configuration/edit', compact('configuration'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /configuration/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$configuration = $this->configurationRepo->find(1);
		$this->notFoundUnless($configuration);

		$manager = new ConfigurationUpdManager($configuration, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $configuration ];

			return Response::json($response);
		}

		return Redirect::route('configuration.show', [$configuration->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /configuration/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}