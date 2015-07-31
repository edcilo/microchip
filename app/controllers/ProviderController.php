<?php

use microchip\provider\ProviderRepo;
use microchip\provider\ProviderFormat;
use microchip\provider\ProviderRegManager;
use microchip\provider\ProviderUpdManager;

class ProviderController extends \BaseController
{
    protected $providerRepo;
    protected $providerFormat;

    public function __construct(
        ProviderRepo    $providerRepo,
        ProviderFormat    $providerFormat
    ) {
        $this->providerRepo        = $providerRepo;
        $this->providerFormat    = $providerFormat;
    }

    /**
     * Display a listing of the resource.
     * GET /provider.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->providerRepo->getActive(1, 'all', 'name', 'ASC');
        }

        $providers = $this->providerRepo->getActive(1, 'paginate', 'name', 'asc');
        foreach ($providers as $provider) {
            $this->providerFormat->formatData($provider);
        }

        return View::make('provider/index', compact('providers'));
    }

    /**
     * Muestra una lista de los registros enviados a papelera.
     */
    public function trash()
    {
        if (Request::ajax()) {
            return $this->providerRepo->getActive(0, 'all', 'name', 'ASC');
        }

        $providers = $this->providerRepo->getActive(0, 'paginate', 'name', 'asc');
        foreach ($providers as $provider) {
            $this->providerFormat->formatData($provider);
        }

        return View::make('provider/trash', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /provider/create.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('provider/create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /provider.
     *
     * @return Response
     */
    public function store()
    {
        $provider = $this->providerRepo->newProvider();
        $manager  = new ProviderRegManager($provider, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $provider];

            return Response::json($response);
        }

        if (Input::get('back'))
            return Redirect::back()->with('message', "El proveedor $provider->name se creo correctamente.");
        else
            return Redirect::route('provider.show', [$provider->slug, $provider->id]);
    }

    /**
     * Display the specified resource.
     * GET /provider/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug, $id)
    {
        $provider = $this->providerRepo->find($id);
        $this->notFoundUnless($provider);
        $this->providerFormat->formatData($provider);

        if (Request::ajax()) {
            return Response::json($provider);
        }

        return View::make('provider/show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /provider/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $provider = $this->providerRepo->find($id);
        $this->notFoundUnless($provider);
        $this->providerFormat->formatData($provider);

        return View::make('provider/edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /provider/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $provider = $this->providerRepo->find($id);
        $this->notFoundUnless($provider);

        $manager = new ProviderUpdManager($provider, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $provider];

            return Response::json($response);
        }

        return Redirect::route('provider.show', [$provider->slug, $provider->id]);
    }

    /**
     * Elimina de forma temporal a un degistro
     * GET /provider/{id}/softDelete.
     *
     * @param int $id
     *
     * @return Response
     */
    public function softDelete($id)
    {
        $provider = $this->providerRepo->find($id);
        $this->notFoundUnless($provider);

        $provider->active = 0;
        $provider->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $provider];

            return Response::json($response);
        }

        return Redirect::back();
    }

    public function restore($id)
    {
        $provider = $this->providerRepo->find($id);
        $this->notFoundUnless($provider);

        $provider->active = 1;
        $provider->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $provider];

            return Response::json($response);
        }

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /provider/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $provider = $this->providerRepo->find($id);
        $this->notFoundUnless($provider);

        $this->providerRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $provider];

            return Response::json($response);
        }

        return Redirect::route('provider.trash');
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            return Response::json($this->providerRepo->search($terms, 'ajax'));
        } else {
            $results = $this->providerRepo->search($terms);

            foreach ($results as $provider) {
                $this->providerFormat->formatData($provider);
            }

            return View::make('provider/search', compact('results', 'terms'));
        }
    }
}
