<?php

use microchip\bank\BankRepo;
use microchip\cheque\ChequeRepo;
use microchip\bank\BankRegManager;
use microchip\bank\BankUpdManager;

class BankController extends \BaseController
{
    protected $bankRepo;
    protected $chequeRepo;
    protected $status_list = ['0' => 'Seleccione...', 'Disponible' => 'Disponible', 'Pagado' => 'Pagado', 'Post-fechado' => 'Post-fechado', 'Cancelado' => 'Cancelado', 'Elaborado' => 'Elaborado' ,'Parcial' => 'Parcial'];

    public function __construct(
        BankRepo    $bankRepo,
        ChequeRepo    $chequeRepo
    ) {
        $this->bankRepo        = $bankRepo;
        $this->chequeRepo    = $chequeRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /bank.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->bankRepo->getActive(1, 'all', 'name', 'ASC');
        }

        $banks = $this->bankRepo->getActive(1, 'paginate', 'name', 'asc');

        return View::make('bank/index', compact('banks'));
    }

    /**
     * Muestra una lista de los registros enviados a papelera.
     */
    public function trash()
    {
        if (Request::ajax()) {
            return $this->bankRepo->getActive(0, 'all', 'name', 'ASC');
        }

        $banks = $this->bankRepo->getActive(0, 'paginate', 'name', 'asc');

        return View::make('bank/trash', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /bank/create.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('bank/create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /bank.
     *
     * @return Response
     */
    public function store()
    {
        $bank        = $this->bankRepo->newBank();
        $manager    = new BankRegManager($bank, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $bank];

            return Response::json($response);
        }

        return Redirect::route('bank.show', [1, $bank->slug, $bank->id]);
    }

    /**
     * Display the specified resource.
     * GET /bank/{id}.
     *
     * @param int    $list
     * @param string $slug
     * @param int    $id
     *
     * @return Response
     */
    public function show($list, $slug, $id)
    {
        $bank = $this->bankRepo->find($id);
        $this->notFoundUnless($bank);

        if (Request::ajax()) {
            return Response::json($bank);
        }

        $cheques        = ($list) ? $this->chequeRepo->getByBank($bank->id, 'folio', 'asc') : $this->chequeRepo->getByBank($bank->id, 'folio', 'asc', 0);
        $status_list    = $this->status_list;
        $data_strip     = ['status' => '', 'provider_id' => '', 'date_start' => '', 'date_end' => ''];

        return View::make('bank.show', compact('bank', 'cheques', 'list', 'status_list', 'data_strip'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /bank/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $bank = $this->bankRepo->find($id);
        $this->notFoundUnless($bank);

        if ($bank->active) {
            return View::make('bank/edit', compact('bank'));
        }

        return Redirect::route('bank.show', [1, $bank->slug, $bank->id]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /bank/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $bank = $this->bankRepo->find($id);
        $this->notFoundUnless($bank);

        $manager = new BankUpdManager($bank, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $bank];

            return Response::json($response);
        }

        return Redirect::route('bank.show', [1, $bank->slug, $bank->id]);
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
        $bank = $this->bankRepo->find($id);
        $this->notFoundUnless($bank);

        $bank->active = 0;
        $bank->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $bank];

            return Response::json($response);
        }

        return Redirect::back()->with('message', 'El banco ' . $bank->name . ' fue enviado a la papelera exitosamente');
    }

    public function restore($id)
    {
        $bank = $this->bankRepo->find($id);
        $this->notFoundUnless($bank);

        $bank->active = 1;
        $bank->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $bank];

            return Response::json($response);
        }

        return Redirect::back()->with('message', 'El banco ' . $bank->name . ' se recupero de la papelera exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /bank/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bank = $this->bankRepo->find($id);
        $this->notFoundUnless($bank);

        $this->bankRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $bank];

            return Response::json($response);
        }

        return Redirect::route('bank.trash');
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            return $this->bankRepo->search($terms, 'ajax');
        } else {
            $results = $this->bankRepo->search($terms);

            return View::make('bank/search', compact('results', 'terms'));
        }
    }
}
