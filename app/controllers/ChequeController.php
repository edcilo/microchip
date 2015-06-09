<?php

use microchip\cheque\ChequeRepo;
use microchip\bank\BankRepo;
use microchip\bankCount\BankCountRepo;
use microchip\cheque\ChequeRegManager;
use microchip\cheque\ChequeUpdManager;
use microchip\bankCount\BankCountRegManager;

class ChequeController extends \BaseController
{
    protected $chequeRepo;
    protected $bankRepo;
    protected $countRepo;
    protected $status_list = ['Pagado' => 'Pagado','Post-fechado' => 'Post-fechado','Cancelado' => 'Cancelado','Elaborado' => 'Elaborado'];

    public function __construct(
        ChequeRepo      $chequeRepo,
        BankRepo        $bankRepo,
        BankCountRepo   $bankCountRepo
    ) {
        $this->chequeRepo   = $chequeRepo;
        $this->bankRepo     = $bankRepo;
        $this->countRepo    = $bankCountRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /cheque.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /cheque/create.
     *
     * @return Response
     */
    public function create($bank_id)
    {
        $bank = $this->bankRepo->find($bank_id);

        return View::make('cheque/create', compact('bank'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /cheque.
     *
     * @return Response
     */
    public function store()
    {
        $start   = (int) Input::get('folio_start');
        $end     = (int) Input::get('folio_end');
        $bank_id = Input::get('bank_id');

        if ($start <= $end) {
            for ($folio = $start; $folio <= $end; $folio++) {
                $data = compact('folio', 'bank_id');

                $cheque = $this->chequeRepo->newCheque();
                $manager = new ChequeRegManager($cheque, $data);
                $manager->save();
            }

            if (Request::ajax()) {
                $response = $this->msg200 + ['data' => 'Registro exitoso.'];

                return Response::json($response);
            }

            return Redirect::route('bank.show', [1, $cheque->bank->slug, $cheque->bank->id]);
        }

        if (Request::ajax()) {
            $response = $this->msg304 + ['data' => 'El folio inicial no puede ser menor que el folio final'];

            return Response::json($response);
        }

        return Redirect::back()->with('msg', 'El folio inicial no puede ser menor que el folio final');
    }

    /**
     * Display the specified resource.
     * GET /cheque/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug, $id)
    {
        $cheque = $this->chequeRepo->find($id);
        $this->notFoundUnless($cheque);

        if (Request::ajax()) {
            return Response::json($cheque);
        }

        return View::make('cheque/show', compact('cheque'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /cheque/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $cheque = $this->chequeRepo->find($id);

        $status_list = $this->status_list;

        return View::make('cheque.edit', compact('cheque', 'status_list'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /cheque/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $cheque = $this->chequeRepo->find($id);
        $this->notFoundUnless($cheque);

        $manager = new ChequeUpdManager($cheque, Input::all());
        $manager->save();

        $now = \Carbon\Carbon::today();
        $payment_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cheque->payment_date.' 00:00:00');

        if (is_null($cheque->bankCount)) {
            if ($now->eq($payment_date)) {
                $data = [
                    'amount'        => $cheque->amount,
                    'status'        => 'Salida',
                    'date'          => $cheque->payment_date,
                    'description'   => 'Pago con cheque no. '.$cheque->folio,
                    'bank_id'       => $cheque->bank_id,
                ];

                $count   = $this->countRepo->newBankCount();
                $manager = new BankCountRegManager($count, $data);
                $manager->save();

                $cheque->bank_count_id = $count->id;
                $cheque->save();
            }
        } else {
            if ($now->eq($payment_date)) {
                $cheque->bankCount->amount = $cheque->amount;
                $cheque->bankCount->save();
            } else {
                $cheque->bankCount->delete();
                $cheque->bank_count_id = 0;
                $cheque->save();
            }
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $cheque];

            return Response::json($response);
        }

        return Redirect::route('cheque.show', [$cheque->folio, $cheque->id]);
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
        $cheque = $this->chequeRepo->find($id);
        $this->notFoundUnless($cheque);

        $cheque->active = 0;
        $cheque->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $cheque];

            return Response::json($response);
        }

        return Redirect::route('bank.show', [1, $cheque->bank->slug, $cheque->bank->id]);
    }

    public function restore($id)
    {
        $cheque = $this->chequeRepo->find($id);
        $this->notFoundUnless($cheque);

        $cheque->active = 1;
        $cheque->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $cheque];

            return Response::json($response);
        }

        return Redirect::route('cheque.show', [$cheque->bank->slug, $cheque->bank->id, 0]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /cheque/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function filter()
    {
        $list        = 1;
        $date_start = Input::get('date_start');
        $date_end   = Input::get('date_end');

        $cheque    = $this->chequeRepo->newCheque();
        $data_strip = array_only(Input::all(), $cheque->getFillable()) + ['date_start' => $date_start, 'date_end' => $date_end];

        $bank        = $this->bankRepo->find(Input::get('bank_id'));
        $cheques    = $this->chequeRepo->filter($data_strip);

        $status_list = ['0' => 'Seleccione...', 'Disponible' => 'Disponible', 'Pagado' => 'Pagado', 'Post-fechado' => 'Post-fechado', 'Cancelado' => 'Cancelado', 'Elaborado' => 'Elaborado' ,'Parcial' => 'Parcial'];

        return View::make('bank.show', compact('bank', 'cheques', 'provider_list', 'status_list', 'data_strip', 'list'));
    }

    public function generateBankCount($id)
    {
        $cheque = $this->chequeRepo->find($id);
        $this->notFoundUnless($cheque);

        $data = [
            'amount'        => $cheque->amount,
            'status'        => 'Salida',
            'date'          => $cheque->payment_date,
            'description'   => 'Pago con cheque no. '.$cheque->folio,
            'bank_id'       => $cheque->bank_id,
        ];

        $count = $this->countRepo->newBankCount();
        $manager = new BankCountRegManager($count, $data);
        $manager->save();

        $cheque->bank_count_id = $count->id;
        $cheque->save();

        if (Request::ajax()) {
            return Response::json($this->msg200 + ['data' => $count]);
        }

        return Redirect::back()->with('success', 'El movimiento se creo correctamente.');
    }
}
