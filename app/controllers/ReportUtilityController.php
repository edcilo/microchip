<?php

use microchip\report\ReportUtilityRepo;
use microchip\sale\SaleRepo;
use microchip\report\ReportUtilityRegManager;

class ReportUtilityController extends \BaseController {

    protected $utilityRepo;
    protected $saleRepo;

    public function __construct(
        ReportUtilityRepo   $utilityRepo,
        SaleRepo            $saleRepo
    )
    {
        $this->utilityRepo  = $utilityRepo;
        $this->saleRepo     = $saleRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /reportutility
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Request::ajax()) {
            return $this->utilityRepo->getAll('all', 'id', 'DESC');
        }

        $reports = $this->utilityRepo->getAll('paginate', 'id', 'DESC');

		return View::make('reportUtility.index', compact('reports'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /reportutility/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $data      = Input::all();
        $date_init = date('Y-m-d');
        $date_end  = null;

        if (isset($data['date_init'])) {
            $date_init = $data['date_init'];

            if (!empty($data['date_end'])) {
                $date_end = $data['date_end'];
            }

            $val = $this->validate($data);

            if ($val) {
                return Redirect::back()->withInput()->withErrors($val);
            }
        }

        $sales = $this->saleRepo->getInRange($date_init, $date_end);
        $sale_global = $this->getDataGlobal($sales);

		return View::make('reportUtility.create', compact('sale_global', 'date_init', 'date_end', 'sales'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /reportutility
	 *
	 * @return Response
	 */
	public function store()
	{
		$report     = $this->utilityRepo->newRepor();
        $manager    = new ReportUtilityRegManager($report, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $report];

            return Response::json($response);
        }

        return Redirect::route('report.utility.show', $report->id);
	}

	/**
	 * Display the specified resource.
	 * GET /reportutility/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $report = $this->utilityRepo->find($id);
        $this->notFoundUnless($report);

        $date_init = $report->date_init;
        $date_end  = $report->date_end;

        $sales = $this->saleRepo->getInRange($date_init, $date_end);
        $sale_global = $this->getDataGlobal($sales);

        return View::make('reportUtility.show', compact('report', 'sale_global', 'date_init', 'date_end', 'sales'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /reportutility/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $report = $this->utilityRepo->find($id);
        $this->notFoundUnless($report);

        $data      = Input::all();
        $date_init = $report->date_init;
        $date_end  = $report->date_end;

        if (isset($data['date_init'])) {
            $date_init = $data['date_init'];

            if (!empty($data['date_end'])) {
                $date_end = $data['date_end'];
            }

            $val = $this->validate($data);

            if ($val) {
                return Redirect::back()->withInput()->withErrors($val);
            }
        }

        $sales = $this->saleRepo->getInRange($date_init, $date_end);
        $sale_global = $this->getDataGlobal($sales);

        return View::make('reportUtility.edit', compact('report', 'sale_global', 'date_init', 'date_end', 'sales'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /reportutility/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$report = $this->utilityRepo->find($id);
        $this->notFoundUnless($report);

        $manager = new ReportUtilityRegManager($report, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $report];

            return Response::json($response);
        }

        return Redirect::route('report.utility.show', $report->id);
	}

    public function validate($data)
    {
        $rules['date_init'] = 'date';

        if (isset($data['date_end'])) {
            $rules['date_end'] = 'date';
        } else {
            $data['date_end'] = null;
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $validator;
        } else {
            return false;
        }
    }

    public function getDataGlobal($sales)
    {
        $sale_global['total_purchase'] = 0;
        $sale_global['total_sale'] = 0;
        $sale_global['total_utility'] = 0;
        $sale_global['total_u_percentage'] = 0;

        foreach($sales as $sale)
        {
            $sale->utility = 0;
            $sale->u_percentage = 0;

            foreach($sale->movements as $movement) {
                $movement->utility = $movement->selling_price - $movement->purchase_price;

                if ($movement->purchase_price == 0) {
                    $movement->u_percentage = 100.00;
                }  else {
                    $movement->u_percentage = ($movement->selling_price / $movement->purchase_price - 1) * 100;
                }

                $sale->utility += $movement->utility;
                $sale->u_percentage += $movement->u_percentage;

                $sale_global['total_purchase']     += $movement->purchase_price;
                $sale_global['total_sale']         += $movement->selling_price;
                $sale_global['total_utility']      += $movement->utility;
                $sale_global['total_u_percentage'] += $movement->u_percentage;

                $movement->u_percentage = number_format($movement->u_percentage, 2, '.', ',');
            }
            $sale->u_percentage /= $sale->movements->count();
        }
        if ($sales->count()) {
            $sale_global['total_u_percentage'] /= $sales->count();
        }

        foreach($sale_global as $key => $value)
        {
            $sale_global[$key] = number_format($sale_global[$key], 2, '.', ',');
        }

        return $sale_global;
    }

}