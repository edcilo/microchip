<?php

use microchip\warranty\WarrantyRepo;
use microchip\warranty\WarrantyRegManager;
use microchip\series\SeriesRepo;

class WarrantyController extends \BaseController
{
    protected $warrantyRepo;
    protected $seriesRepo;

    public function __construct(
        WarrantyRepo    $warrantyRepo,
        SeriesRepo      $seriesRepo
    ) {
        $this->warrantyRepo = $warrantyRepo;
        $this->seriesRepo   = $seriesRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /warranty.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->warrantyRepo->getAll('all', 'created_at', 'ASC');
        }

        $warranties = $this->warrantyRepo->getAll('paginate', 'created_at', 'desc');

        return View::make('warranty/index', compact('warranties'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /warranty/create.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('warranty.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /warranty.
     *
     * @return Response
     */
    public function store()
    {
        $ns = Input::get('series');

        $series = $this->seriesRepo->findBySeriesForWarranty($ns);

        if (is_null($series)) {
            return Redirect::back()->withInput()->withErrors(['series' => 'El producto no se encuentra registrado o ya esta en garantía.']);
        }

        if (count($series->movement->purchases) == 0) {
            return Redirect::back()->withInput()->withErrors(['series' => 'Este producto no puede ser enviado a garantía.']);
        }

        $series->status = 'Garantía';
        $series->save();

        $data = [
            'description'   => Input::get('description'),
            'series_id'     => $series->id,
            'purchase_id'   => $series->movement->purchases[0]->id,
            'created_by'    => Auth::user()->id
        ];

        $warranty = $this->warrantyRepo->newWarranty();
        $manager = new WarrantyRegManager($warranty, $data);
        $manager->save();

        $message = ['success' => 'Se registro correctamente la garantía.'];

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $warranty];

            return Response::json($response);
        }

        return Redirect::route('warranty.index')->with($message);
    }

    public function show($id)
    {
        $warranty = $this->warrantyRepo->find($id);
        $this->notFoundUnless($warranty);

        return View::make('warranty.show', compact('warranty'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /warranty/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $warranty = $this->warrantyRepo->find($id);
        $this->notFoundUnless($warranty);

        $warranty->series->status =
        $this->warrantyRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $warranty];

            return Response::json($response);
        }

        return Redirect::route('warranty.index');
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            $results = $this->warrantyRepo->search($terms, 'ajax');

            return Response::json($results);
        } else {
            $results = $this->warrantyRepo->search($terms);

            return View::make('warranty/search', compact('results', 'terms'));
        }
    }
}
