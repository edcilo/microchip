<?php

use microchip\bankCount\BankCountRepo;
use microchip\bank\BankRepo;
use microchip\pay\PayRepo;

use microchip\bankCount\BankCountRegManager;
use microchip\bankCount\BankCountUpdManager;

class BankCountController extends \BaseController {

    protected $countRepo;
    protected $bankRepo;
    protected $payRepo;

    public function __construct(
        BankCountRepo   $bankCountRepo,
        BankRepo        $bankRepo,
        PayRepo         $payRepo
    )
    {
        $this->countRepo    = $bankCountRepo;
        $this->bankRepo     = $bankRepo;
        $this->payRepo      = $payRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /bankcount
	 *
	 * @return Response
	 */
	public function index($bank_id)
	{
		$bank = $this->bankRepo->find($bank_id);
        $this->notFoundUnless($bank);

        $counts = $this->countRepo->getByBank($bank_id);
        $c_credit = $this->payRepo->getCreditCard();
        $c_cheques = $this->payRepo->getByMethod('Cheque');
        $c_transfer = $this->payRepo->getByMethod('Transferencia');

        return View::make('bankCount/index', compact('bank', 'counts', 'c_credit', 'c_cheques', 'c_transfer'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /bankcount/create
	 *
	 * @return Response
	 */
	public function create($bank_id)
	{
        $bank = $this->bankRepo->find($bank_id);
        $this->notFoundUnless($bank);

        return View::make('bankCount/create', compact('bank'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /bankcount
	 *
	 * @return Response
	 */
	public function store($bank_id)
	{
        $bank = $this->bankRepo->find($bank_id);
        $this->notFoundUnless($bank);

        $data = Input::all() + ['bank_id' => $bank_id];

        $count = $this->countRepo->newBankCount();
        $manager = new BankCountRegManager($count, $data);
        $manager->save();

        if(Request::ajax())
        {
            return Response::json($count);
        }

        return Redirect::route('bankCount.index', $bank_id);
	}

	/**
	 * Display the specified resource.
	 * GET /bankcount/{id}
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
	 * GET /bankcount/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$count = $this->countRepo->find($id);
        $this->notFoundUnless($count);

        $bank = $this->bankRepo->find($count->bank_id);

        return View::make('bankCount/edit', compact('bank', 'count'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /bankcount/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$count = $this->countRepo->find($id);
        $this->notFoundUnless($count);

        $manager = new BankCountUpdManager($count, Input::all());
        $manager->save();

        if(Request::ajax())
            return Response::json($this->msg200 + ['data' => $count]);

        return Redirect::route('bankCount.index', $count->bank_id);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /bankcount/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$count = $this->countRepo->find($id);
        $this->notFoundUnless($count);

        if(!is_null($count->cheque))
        {
            $count->cheque->bank_count_id = 0;
            $count->cheque->save();
        }

        $count->delete();

        if(Request::ajax())
            return Response::json($this->msg200 + ['data' => $count]);

        return Redirect::back()
            ->with('alert', "El movimiento de $count->status por $count->amount del día $count->date se elimino correctamente");
	}

}