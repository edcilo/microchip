<?php

use microchip\sale\SaleRepo;
use microchip\report\ReportServiceRepo;
use microchip\report\ReportServiceRegManager;

class ReportServiceController extends \BaseController {

    protected $saleRepo;
    protected $reportRepo;

    public function __construct(
        SaleRepo            $saleRepo,
        ReportServiceRepo   $serviceRepo
    )
    {
        $this->saleRepo   = $saleRepo;
        $this->reportRepo = $serviceRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /reportservice
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Request::ajax()) {
            return $this->reportRepo->getAll('all', 'id', 'DESC');
        }

        $reports = $this->reportRepo->getAll('paginate', 'id', 'DESC');

		return View::make('reportService.index', compact('reports'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /reportservice/create
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

        $services = $this->saleRepo->getServicesInRange($date_init, $date_end);

        $this->getData($services);

        return View::make('reportService.create', compact('date_init', 'date_end', 'services'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /reportservice
	 *
	 * @return Response
	 */
	public function store()
	{
        $report     = $this->reportRepo->newReport();
        $manager    = new ReportServiceRegManager($report, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $report];

            return Response::json($response);
        }

        return Redirect::route('report.service.show', $report->id);
	}

	/**
	 * Display the specified resource.
	 * GET /reportservice/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $report = $this->reportRepo->find($id);
        $this->notFoundUnless($report);

        $date_init = $report->date_init;
        $date_end  = $report->date_end;

        $services = $this->saleRepo->getServicesInRange($date_init, $date_end);
        $this->getData($services);

        return View::make('reportService.show', compact('date_init', 'date_end', 'services', 'report'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /reportservice/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $report = $this->reportRepo->find($id);
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

        $services = $this->saleRepo->getServicesInRange($date_init, $date_end);

        $this->getData($services);

        return View::make('reportService.edit', compact('date_init', 'date_end', 'services', 'report'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /reportservice/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $report = $this->reportRepo->find($id);
        $this->notFoundUnless($report);

        $manager = new ReportServiceRegManager($report, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $report];

            return Response::json($response);
        }

        return Redirect::route('report.service.show', $report->id);
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

    public function getTotalGlobal(&$services)
    {
        $total = 0;

        foreach($services as $service)
        {
            $total += $service->total;
            $service->staff = [];

            if ($service->comments->count()) {
                foreach ($service->comments as $comment) {
                    $services->service->staff[] = $comment->user->profile->name;
                }
            }
        }

        $services->total = $total;
    }

    public function getData(&$services)
    {
        $total = 0;
        foreach($services as $service)
        {
            $total += $service->total_services;
            $service->staff = [];

            if ($service->comments->count()) {
                foreach ($service->comments as $comment) {
                    $user = $comment->user->profile->full_name;

                    if (!in_array($user, $service->staff)) {
                        $service->staff = array_add($service->staff, $comment->id, $user);
                    }
                }
            }
        }
        $services->total = $total;
    }


}