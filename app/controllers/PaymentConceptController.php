<?php

use microchip\paymentConcept\PaymentConceptRepo;
use microchip\paymentConcept\ConceptRegManager;

class PaymentConceptController extends \BaseController {

    protected $conceptRepo;

    public function __construct(PaymentConceptRepo $conceptRepo)
    {
        $this->conceptRepo  = $conceptRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /paymentconcept
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Request::ajax()) {
            return $this->conceptRepo->getAll('all', 'concept', 'ASC');
        }

        $concepts = $this->conceptRepo->getAll('paginate', 'concept', 'asc');

        return View::make('paymentConcept/index', compact('concepts'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /paymentconcept/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('paymentConcept/create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /paymentconcept
	 *
	 * @return Response
	 */
	public function store()
	{
        $concept    = $this->conceptRepo->newConcept();
        $manager    = new ConceptRegManager($concept, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $concept];

            return Response::json($response);
        }

        return Redirect::route('concept.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /paymentconcept/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $concept = $this->conceptRepo->find($id);
        $this->notFoundUnless($concept);

        return View::make('paymentConcept/edit', compact('concept'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /paymentconcept/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $concept = $this->conceptRepo->find($id);
        $this->notFoundUnless($concept);

        $manager = new ConceptRegManager($concept, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $concept];

            return Response::json($response);
        }

        return Redirect::route('concept.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /paymentconcept/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $concept = $this->conceptRepo->find($id);
        $this->notFoundUnless($concept);

        $this->conceptRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $concept];

            return Response::json($response);
        }

        return Redirect::route('concept.index');
	}

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            $results = $this->conceptRepo->search($terms, 'ajax');

            return Response::json($results);
        } else {
            $results = $this->conceptRepo->search($terms);

            return View::make('paymentConcept/search', compact('results', 'terms'));
        }
    }

}