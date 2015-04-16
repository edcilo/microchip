<?php

use microchip\customerContact\CustomerContactRepo;

use microchip\customerContact\CustomerContactRegManager;

class CustomerContactController extends \BaseController {

	protected $contactRepo;

	public function __construct(CustomerContactRepo $customerContactRepo)
	{
		$this->contactRepo = $customerContactRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /customercontact
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customercontact/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customercontact
	 *
	 * @return Response
	 */
	public function store($customer_id)
	{
		$data = Input::all() + ['customer_id'=>$customer_id];

		$contact = $this->contactRepo->newContact();
		$manager = new CustomerContactRegManager($contact, $data);
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $contact ];

			return Response::json($response);
		}

		return Redirect::back();
	}

	/**
	 * Display the specified resource.
	 * GET /customercontact/{id}
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
	 * GET /customercontact/{id}/edit
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
	 * PUT /customercontact/{id}
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
	 * DELETE /customercontact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$contact = $this->contactRepo->find($id);
		$contact->delete();

		if ( Request::ajax() )
		{
			return Response::json([
				'success' => true,
				'msg' => 'El contacto se ha eliminado correctamente.'
			]);
		}
		else
		{
			return Redirect::back();
		}
	}

}