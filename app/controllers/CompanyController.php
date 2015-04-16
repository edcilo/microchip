<?php

use microchip\company\CompanyRepo;

use microchip\company\CompanyRegManager;
use microchip\company\CompanyUpdManager;

class CompanyController extends \BaseController {

	protected $companyRepo;

	public function __construct(
		CompanyRepo	$companyRepo
	)
	{
		$this->companyRepo	= $companyRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /company
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /company/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$company = $this->companyRepo->find(1);

		if( ! is_null($company) )
			return Redirect::route('company.show', [1]);

		return View::make('company/create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /company
	 *
	 * @return Response
	 */
	public function store()
	{
		$company	= $this->companyRepo->newCompany();
		$manager	= new CompanyRegManager($company, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $company ];

			return Response::json($response);
		}

		return Redirect::route('company.show', [$company->id]);
	}

	/**
	 * Display the specified resource.
	 * GET /company/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$company = $this->companyRepo->find(1);

		if ( is_null($company) )
			return Redirect::route('company.create');

		if ( Request::ajax() ) return Response::json($company);

		if ( isset($company->services) )
			$services = explode(';', $company->services);

		return View::make('company/show', compact('company', 'services'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /company/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$company = $this->companyRepo->find(1);
		$this->notFoundUnless($company);

		return View::make('company/edit', compact('company'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /company/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$company = $this->companyRepo->find(1);
		$this->notFoundUnless($company);

		$manager = new CompanyUpdManager($company, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $company ];

			return Response::json($response);
		}

		return Redirect::route('company.show', [$company->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /company/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}