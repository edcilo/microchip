<?php

use microchip\purchasePayment\PurchasePaymentRepo;
use microchip\pay\PayRepo;
use microchip\report\ReportCorteRepo;
use microchip\report\ReportCorteRegManager;
use microchip\pay\PayRegisterInManager;
use microchip\user\UserRepo;

class ReportController extends \BaseController {

    protected $purchasePayRepo;
    protected $payRepo;
    protected $corteRepo;
    protected $userRepo;

    public function __construct(
        PayRepo             $payRepo,
        PurchasePaymentRepo $paymentRepo,
        ReportCorteRepo     $corteRepo,
        UserRepo            $userRepo
    )
    {
        $this->purchasePayRepo  = $paymentRepo;
        $this->payRepo          = $payRepo;
        $this->corteRepo        = $corteRepo;
        $this->userRepo         = $userRepo;
    }

    public function index()
    {
        if (Request::ajax()) {
            return $this->corteRepo->getAll('all', 'id', 'DESC');
        }

        $reports = $this->corteRepo->getAll('paginate', 'id', 'DESC');

        return View::make('report/index', compact('reports'));
    }

	public function money()
    {
        $data       = Input::all();
        $date_end   = empty(Input::get('date_end'))  ? null : Input::get('date_end');
        $time_end   = empty(Input::get('time_end'))  ? null : Input::get('time_end');
        $report     = [];
        $pays       = [];

        if ( empty(Input::get('date_init')) ) {
            $report = $this->corteRepo->findLast();
            if ($report) {
                $date_init = $report->date_end;
                $time_init = substr($report->time_end, 0, 5);
            } else {
                $date_init = date('Y-m-d');
                $time_init = empty(Input::get('time_init'))  ? null : Input::get('time_init');
            }
        } else {
            $date_init = Input::get('date_init');
            $time_init = Input::get('time_init');
        }

        if (!empty($date_init)) {
            $val = $this->validate($data);

            if ($val) {
                return Redirect::back()->withInput()->withErrors($val);
            }

            $users = $this->userRepo->getPaysByRange($date_init, $time_init, $date_end, $time_end);
            $result = $this->getData($date_init, $time_init, $date_end, $time_end);
            $report = $result[0];
            $pays   = $result[1];
        }

        return View::make('report.money', compact('date_init', 'time_init', 'date_end', 'time_end', 'report', 'pays', 'users'));
    }

    public function moneyStore()
    {
        $data = Input::all();
        $denominations = Input::only(
            'quantity_r_1000', 'quantity_r_500',
            'quantity_r_200', 'quantity_r_100',
            'quantity_r_50', 'quantity_r_20',
            'quantity_r_10', 'quantity_r_5',
            'quantity_r_2', 'quantity_r_1', 'quantity_r_05'
        );

        $total_out = $this->getDenominations($denominations, 'quantity_r_05', 11);

        if ($total_out[1] > 0) {
            $pay_data['user_id']     = Auth::user()->id;
            $pay_data['amount']      = $total_out[1] * -1;
            $pay_data['description'] = 'Salida por corte de caja';
            $pay_data['date']        = date('Y-m-d H:i:s');

            $pay = $this->payRepo->newPay();
            $manager = new PayRegisterInManager($pay, $pay_data);
            $manager->save();

            $data['pay_id'] = $pay->id;
        }

        $corte      = $this->corteRepo->newCorte();
        $manager    = new ReportCorteRegManager($corte, $data);
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $corte];

            return Response::json($response);
        }

        return Redirect::route('report.money');
    }

    public function show($id)
    {
        $corte = $this->corteRepo->find($id);
        $this->notFoundUnless($corte);

        if (Request::ajax()) {
            return Response::json($corte);
        }

        $result = $this->getData($corte->date_init, $corte->time_init, $corte->date_end, $corte->time_end);
        $report = $result[0];
        $pays   = $result[1];

        $users = $this->userRepo->getPaysByRange($corte->date_init, $corte->time_init, $corte->date_end, $corte->time_end);

        $denominations = ['quantity_1000'=>$corte->quantity_1000, 'quantity_500'=>$corte->quantity_500, 'quantity_200'=>$corte->quantity_200, 'quantity_100'=>$corte->quantity_100, 'quantity_50'=>$corte->quantity_50, 'quantity_20'=>$corte->quantity_20, 'quantity_10'=>$corte->quantity_10, 'quantity_5'=>$corte->quantity_5, 'quantity_2'=>$corte->quantity_2, 'quantity_1'=>$corte->quantity_1, 'quantity_05'=>$corte->quantity_05];
        $result = $this->getDenominations($denominations, 'quantity_05', 9);
        $total_denomination = $result[0];
        $total_calculate    = $result[1];

        $denominations_r = ['quantity_r_1000'=>$corte->quantity_r_1000, 'quantity_r_500'=>$corte->quantity_r_500, 'quantity_r_200'=>$corte->quantity_r_200, 'quantity_r_100'=>$corte->quantity_r_100, 'quantity_r_50'=>$corte->quantity_r_50, 'quantity_r_20'=>$corte->quantity_r_20, 'quantity_r_10'=>$corte->quantity_r_10, 'quantity_r_5'=>$corte->quantity_r_5, 'quantity_r_2'=>$corte->quantity_r_2, 'quantity_r_1'=>$corte->quantity_r_1, 'quantity_r_05'=>$corte->quantity_r_05];
        $result = $this->getDenominations($denominations_r, 'quantity_r_05', 11);
        $total_denomination += $result[0];
        $total_calculate_r = $result[1];

        return View::make('report.show', compact('total_calculate', 'total_calculate_r', 'total_denomination', 'report', 'pays', 'users', 'corte'));
    }

    public function edit($id)
    {
        $report_money = $this->corteRepo->find($id);
        $this->notFoundUnless($report_money);

        $data = $report_money->toArray();
        $input = Input::all();
        if (!empty($input)) {
            $data = array_replace($data, $input);
        }

        $date_init  = $data['date_init'];
        $time_init  = $data['time_init'];
        $date_end   = $data['date_end'];
        $time_end   = $data['time_end'];

        $result = $this->getData($data['date_init'], $data['time_init'], $data['date_end'], $data['time_end']);
        $report = $result[0];
        $pays   = $result[1];

        $users = $this->userRepo->getPaysByRange($data['date_init'], $data['time_init'], $data['date_end'], $data['time_end']);

        $denominations = ['quantity_1000'=>$data['quantity_1000'], 'quantity_500'=>$data['quantity_500'], 'quantity_200'=>$data['quantity_200'], 'quantity_100'=>$data['quantity_100'], 'quantity_50'=>$data['quantity_50'], 'quantity_20'=>$data['quantity_20'], 'quantity_10'=>$data['quantity_10'], 'quantity_5'=>$data['quantity_5'], 'quantity_2'=>$data['quantity_2'], 'quantity_1'=>$data['quantity_1'], 'quantity_05'=>$data['quantity_05']];
        $result = $this->getDenominations($denominations, 'quantity_05', 9);
        $total_denomination = $result[0];
        $total_calculate    = $result[1];

        $denominations_r = ['quantity_r_1000'=>$data['quantity_r_1000'], 'quantity_r_500'=>$data['quantity_r_500'], 'quantity_r_200'=>$data['quantity_r_200'], 'quantity_r_100'=>$data['quantity_r_100'], 'quantity_r_50'=>$data['quantity_r_50'], 'quantity_r_20'=>$data['quantity_r_20'], 'quantity_r_10'=>$data['quantity_r_10'], 'quantity_r_5'=>$data['quantity_r_5'], 'quantity_r_2'=>$data['quantity_r_2'], 'quantity_r_1'=>$data['quantity_r_1'], 'quantity_r_05'=>$data['quantity_r_05']];
        $result = $this->getDenominations($denominations_r, 'quantity_r_05', 11);
        $total_denomination += $result[0];
        $total_calculate_r = $result[1];

        return View::make('report.edit', compact('date_init', 'time_init', 'date_end', 'time_end', 'total_calculate', 'total_calculate_r', 'total_denomination', 'report', 'pays', 'users', 'report_money'));
    }

    public function update($id)
    {
        $corte = $this->corteRepo->find($id);
        $this->notFoundUnless($corte);

        $manager = new ReportCorteRegManager($corte, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $corte];

            return Response::json($response);
        }

        return Redirect::route('report.money.show', $corte->id);
    }


    public function getData($date_init, $time_init, $date_end, $time_end)
    {
        $report['caja_anterior']  = $this->payRepo->getCajaAnetrior($date_init, $time_init);

        $pays = $this->payRepo->getInRange($date_init, $time_init, $date_end, $time_end);

        $report['total_cash']        = $this->payRepo->getTotalByMethod($pays, 'Efectivo');
        $report['total_credit_card'] = $this->payRepo->getTotalByMethod($pays, 'Tarjeta de crédito/débito');
        $report['total_cheques']     = $this->payRepo->getTotalByMethod($pays, 'Cheque');
        $report['total_coupons']     = $this->payRepo->getTotalByMethod($pays, 'Vale');
        $report['total_card']        = $this->payRepo->getTotalByMethod($pays, 'Monedero');
        $report['total_transfers']   = $this->payRepo->getTotalByMethod($pays, 'Transferencia');

        $report['total_expenses']    = $this->payRepo->getTotalInRange($date_init, $time_init, $date_end, $time_end, '-');

        $report['total_box']         = $report['caja_anterior'] + $report['total_cash'] + $report['total_expenses'];

        return [$report, $pays];
    }

    public function getDenominations($denominations, $key50, $length)
    {
        $total_denomination = [];
        $total_calculate = 0;

        foreach ($denominations as $key => $value) {
            if ($key == $key50) {
                $denomination = 0.5;
            } else {
                $denomination = (int)substr($key, $length);
            }
            $total = $denomination * $value;
            $total_denomination[$key] = $total;

            $total_calculate += $total;
        }

        return [$total_denomination, $total_calculate];
    }

    public function validate($data)
    {
        $rules['date_init'] = 'date';

        if (!empty($data['date_end'])) {
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

}