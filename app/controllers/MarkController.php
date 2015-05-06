<?php

use microchip\mark\MarkRepo;
use microchip\product\ProductRepo;
use microchip\mark\MarkRegManager;
use microchip\mark\MarkUpdManager;

class MarkController extends \BaseController
{
    protected $markRepo;
    protected $productRepo;

    public function __construct(
        MarkRepo    $markRepo,
        ProductRepo $productRepo
    ) {
        $this->markRepo        = $markRepo;
        $this->productRepo  = $productRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /mark.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->markRepo->getAll('all', 'name', 'ASC');
        }

        $marks = $this->markRepo->getAll('paginate', 'name', 'asc');

        foreach ($marks as $mark) {
            $mark->description = substr($mark->description, 0, 117).'...';
        }

        return View::make('mark/index', compact('marks'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /mark/create.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('mark/create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /mark.
     *
     * @return Response
     */
    public function store()
    {
        $mark        = $this->markRepo->newMark();
        $manager    = new MarkRegManager($mark, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $mark];

            return Response::json($response);
        }

        return Redirect::route('mark.show', [$mark->slug, $mark->id]);
    }

    /**
     * Display the specified resource.
     * GET /mark/{slug}/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug, $id)
    {
        $mark = $this->markRepo->find($id);
        $this->notFoundUnless($mark);

        if (Request::ajax()) {
            return Response::json($mark);
        }

        $products = $this->productRepo->getByMark($id);

        return View::make('mark/show', compact('mark', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /mark/{slug}/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $mark = $this->markRepo->find($id);
        $this->notFoundUnless($mark);

        return View::make('mark/edit', compact('mark'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /mark/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $mark = $this->markRepo->find($id);
        $this->notFoundUnless($mark);

        $manager = new MarkUpdManager($mark, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $mark];

            return Response::json($response);
        }

        return Redirect::route('mark.show', [$mark->slug, $mark->id]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /mark/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mark = $this->markRepo->find($id);
        $this->notFoundUnless($mark);

        $this->markRepo->destroy($id);

        $this->destroyFile($mark->image, 'default');

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $mark];

            return Response::json($response);
        }

        return Redirect::route('mark.index');
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            return $this->markRepo->search($terms, 'ajax');
        } else {
            $results = $this->markRepo->search($terms);

            foreach ($results as $mark) {
                $mark->description = substr($mark->description, 0, 117).'...';
            }

            return View::make('mark/search', compact('results', 'terms'));
        }
    }
}
