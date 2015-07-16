<?php

use microchip\purchasePayment\PurchasePaymentRepo;
use microchip\pay\PayRepo;
use microchip\report\ReportCorteRepo;
use microchip\report\ReportCorteRegManager;
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
        $date_init  = date('Y-m-d');
        $date_end   = null;
        $report     = [];

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

        if (isset($data['date_init'])) {
            $result = $this->getData($data['date_init'], $data['date_end']);
            $report = $result[0];
            $pays   = $result[1];
        }

        return View::make('report.money', compact('date_init', 'date_end', 'report', 'pays'));
    }

    public function moneyStore()
    {
        // TODO registrar la salida de caja
        $corte      = $this->corteRepo->newCorte();
        $manager    = new ReportCorteRegManager($corte, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $corte];

            return Response::json($response);
        }

        return Redirect::route('report.money');
    }

    public function show($id)
    {
        $report_money = $this->corteRepo->find($id);
        $this->notFoundUnless($report_money);

        if (Request::ajax()) {
            return Response::json($report_money);
        }

        $data = $report_money->toArray();

        $result = $this->getData($data['date_init'], $data['date_end']);
        $report = $result[0];
        $pays   = $result[1];

        $users = $this->userRepo->getPaysByRange($data['date_init'], $data['date_end']);

        $denominations = ['quantity_1000'=>$data['quantity_1000'], 'quantity_500'=>$data['quantity_500'], 'quantity_200'=>$data['quantity_200'], 'quantity_100'=>$data['quantity_100'], 'quantity_50'=>$data['quantity_50'], 'quantity_20'=>$data['quantity_20'], 'quantity_10'=>$data['quantity_10'], 'quantity_5'=>$data['quantity_5'], 'quantity_2'=>$data['quantity_2'], 'quantity_1'=>$data['quantity_1'], 'quantity_05'=>$data['quantity_05']];
        $result = $this->getDenominations($denominations, 'quantity_05', 9);
        $total_denomination = $result[0];
        $total_calculate    = $result[1];

        $denominations_r = ['quantity_r_1000'=>$data['quantity_r_1000'], 'quantity_r_500'=>$data['quantity_r_500'], 'quantity_r_200'=>$data['quantity_r_200'], 'quantity_r_100'=>$data['quantity_r_100'], 'quantity_r_50'=>$data['quantity_r_50'], 'quantity_r_20'=>$data['quantity_r_20'], 'quantity_r_10'=>$data['quantity_r_10'], 'quantity_r_5'=>$data['quantity_r_5'], 'quantity_r_2'=>$data['quantity_r_2'], 'quantity_r_1'=>$data['quantity_r_1'], 'quantity_r_05'=>$data['quantity_r_05']];
        $result = $this->getDenominations($denominations_r, 'quantity_r_05', 11);
        $total_denomination += $result[0];
        $total_calculate_r = $result[1];

        return View::make('report.show', compact('total_calculate', 'total_calculate_r', 'total_denomination', 'report', 'pays', 'users', 'report_money'));
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
        $date_end   = $data['date_end'];

        $result = $this->getData($data['date_init'], $data['date_end']);
        $report = $result[0];
        $pays   = $result[1];

        $users = $this->userRepo->getPaysByRange($data['date_init'], $data['date_end']);

        $denominations = ['quantity_1000'=>$data['quantity_1000'], 'quantity_500'=>$data['quantity_500'], 'quantity_200'=>$data['quantity_200'], 'quantity_100'=>$data['quantity_100'], 'quantity_50'=>$data['quantity_50'], 'quantity_20'=>$data['quantity_20'], 'quantity_10'=>$data['quantity_10'], 'quantity_5'=>$data['quantity_5'], 'quantity_2'=>$data['quantity_2'], 'quantity_1'=>$data['quantity_1'], 'quantity_05'=>$data['quantity_05']];
        $result = $this->getDenominations($denominations, 'quantity_05', 9);
        $total_denomination = $result[0];
        $total_calculate    = $result[1];

        $denominations_r = ['quantity_r_1000'=>$data['quantity_r_1000'], 'quantity_r_500'=>$data['quantity_r_500'], 'quantity_r_200'=>$data['quantity_r_200'], 'quantity_r_100'=>$data['quantity_r_100'], 'quantity_r_50'=>$data['quantity_r_50'], 'quantity_r_20'=>$data['quantity_r_20'], 'quantity_r_10'=>$data['quantity_r_10'], 'quantity_r_5'=>$data['quantity_r_5'], 'quantity_r_2'=>$data['quantity_r_2'], 'quantity_r_1'=>$data['quantity_r_1'], 'quantity_r_05'=>$data['quantity_r_05']];
        $result = $this->getDenominations($denominations_r, 'quantity_r_05', 11);
        $total_denomination += $result[0];
        $total_calculate_r = $result[1];

        return View::make('report.edit', compact('date_init', 'date_end', 'total_calculate', 'total_calculate_r', 'total_denomination', 'report', 'pays', 'users', 'report_money'));
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


    public function getData($date_init, $date_end)
    {
        $report['caja_anterior']  = $this->payRepo->getCajaAnetrior($date_init);

        $pays = $this->payRepo->getInRange($date_init, $date_end);

        $report['total_cash']        = $this->payRepo->getTotalByMethod($pays, 'Efectivo');
        $report['total_credit_card'] = $this->payRepo->getTotalByMethod($pays, 'Tarjeta de crédito/débito');
        $report['total_cheques']     = $this->payRepo->getTotalByMethod($pays, 'Cheque');
        $report['total_coupons']     = $this->payRepo->getTotalByMethod($pays, 'Vale');
        $report['total_card']        = $this->payRepo->getTotalByMethod($pays, 'Monedero');
        $report['total_transfers']   = $this->payRepo->getTotalByMethod($pays, 'Transferencia');

        $report['total_expenses']    = $this->payRepo->getTotalInRange($date_init, $date_end, '-');

        $report['total_box']         = $report['caja_anterior'] + $report['total_cash'] + $report['total_expenses'];

        return [$report, $pays];
    }

    public function getDenominations($denominations, $key50, $lenth)
    {
        $total_denomination = [];
        $total_calculate = 0;

        foreach ($denominations as $key => $value) {
            if ($key == $key50) {
                $denomination = 0.5;
            } else {
                $denomination = (int)substr($key, $lenth);
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