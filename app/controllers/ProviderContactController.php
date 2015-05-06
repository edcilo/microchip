<?php

use microchip\providerContact\ProviderContactRepo;
use microchip\provider\ProviderRepo;
use microchip\providerContact\ProviderContactRegManager;
use microchip\providerContact\ProviderContactUpdManager;

class ProviderContactController extends \BaseController
{
    protected $contactRepo;
    protected $providerRepo;

    public function __construct(
        ProviderContactRepo    $providerContactRepo,
        ProviderRepo        $providerRepo
    ) {
        $this->contactRepo    = $providerContactRepo;
        $this->providerRepo    = $providerRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /providercontact.
     *
     * @return Response
     */
    public function index()
    {
        return Redirect::route('provider.index');
    }

    /**
     * Show the form for creating a new resource.
     * GET /providercontact/create.
     *
     * @param int $provider_id
     *
     * @return Response
     */
    public function create($provider_id)
    {
        $provider = $this->providerRepo->find($provider_id);

        return View::make('providerContact/create', compact('provider'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /providercontact.
     *
     * @return Response
     */
    public function store()
    {
        $contact    = $this->contactRepo->newContact();
        $manager    = new ProviderContactRegManager($contact, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $contact];

            return Response::json($response);
        }

        return Redirect::route('provider.show', [$contact->provider->slug, $contact->provider->id]);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /providercontact/{id}/edit.
     *
     * @param int $id
     * @param int $provider_id
     *
     * @return Response
     */
    public function edit($id, $provider_id)
    {
        $contact = $this->contactRepo->find($id);
        $this->notFoundUnless($contact);

        $provider = $this->providerRepo->find($provider_id);

        return View::make('providerContact/edit', compact('contact', 'provider'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /providercontact/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $contact = $this->contactRepo->find($id);
        $this->notFoundUnless($contact);

        $manager = new ProviderContactUpdManager($contact, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $contact];

            return Response::json($response);
        }

        return Redirect::route('provider.show', [$contact->provider->slug, $contact->provider->id]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /providercontact/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepo->find($id);
        $this->notFoundUnless($contact);

        $this->contactRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $contact];

            return Response::json($response);
        }

        return Redirect::route('provider.show', [$contact->provider->slug, $contact->provider->id]);
    }
}
