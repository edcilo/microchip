<?php

use microchip\purchasePayment\PurchasePaymentRepo;
use microchip\pay\PayRepo;

class ReportController extends \BaseController {

    protected $purchasePayRepo;
    protected $payRepo;

    public function __construct(
        PayRepo             $payRepo,
        PurchasePaymentRepo $paymentRepo
    )
    {
        $this->purchasePayRepo  = $paymentRepo;
        $this->payRepo          = $payRepo;
    }

	public function money()
    {
        $data = Input::all();
        $date_init = date('Y-m-d');
        $date_end  = null;
        $report = [];

        if (isset($data['date_init'])) {
            $date_init = $data['date_init'];

            $rules['date_init'] = 'date';

            if (!empty($data['date_end'])) {
                $rules['date_end'] = 'date';
                $date_end = $data['date_end'];
            } else {
                $data['date_end'] = null;
            }

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $report['caja_anterior']  = $this->payRepo->getCajaAnetrior($data['date_init']);

            $pays = $this->payRepo->getInRange($data['date_init'], $data['date_end']);
            $report['total_cash']        = $this->payRepo->getTotalByMethod($pays, 'Efectivo');
            $report['total_credit_card'] = $this->payRepo->getTotalByMethod($pays, 'Tarjeta de crédito/débito');
            $report['total_cheques']     = $this->payRepo->getTotalByMethod($pays, 'Cheque');
            $report['total_coupons']     = $this->payRepo->getTotalByMethod($pays, 'Vale');
            $report['total_card']        = $this->payRepo->getTotalByMethod($pays, 'Monedero');
            $report['total_transfers']   = $this->payRepo->getTotalByMethod($pays, 'Transferencia');
            $report['total_expenses']    = $this->payRepo->getTotalInRange($data['date_init'], $data['date_end'], '-');
            $report['total_box']         = $report['caja_anterior'] + $report['total_cash'] + $report['total_expenses'];
        }

        $total_calculate = 0;
        $total_denomination = [];
        if (isset($data['calculate'])) {
            $denominations = Input::only('quantity_1000', 'quantity_500', 'quantity_200', 'quantity_100', 'quantity_50', 'quantity_20', 'quantity_10', 'quantity_5', 'quantity_2', 'quantity_1', 'quantity_05');

            foreach ($denominations as $key => $value) {
                if ($key == 'quantity_05') {
                    $denomination = 0.5;
                } else {
                    $denomination = (int)substr($key, 9);
                }
                $total = $denomination * $value;
                $total_denomination[$key] = $total;

                $total_calculate += $total;
            }
        }

        return View::make('report.money', compact('date_init', 'date_end', 'total_calculate', 'total_denomination', 'report', 'pays'));
    }

}