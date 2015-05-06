<?php

namespace microchip\pay;

use microchip\base\BaseManager;
use microchip\sale\SaleRepo;

class PayRegisterOutSaleManager extends BaseManager
{
    public function getRules()
    {
        $saleRepo = new SaleRepo();
        $sale = $saleRepo->getDocument($this->data['classification'], $this->data['folio']);
        $this->data['folio'] = (!is_null($sale)) ? $sale->folio : 'zzzzzzzzzz';
        $this->data['sale_id']  = (!is_null($sale)) ? $sale->id : 0;

        return [
            'classification'    => 'required|in:Venta,Servicio,Pedido,Cotización',
            'folio'             => 'required|exists:sales,folio',
            'amount'            => 'required|numeric',
            'change_check'      => 'boolean',
            'description'       => 'required|max:255',
            'date'              => 'required|date',
            'user_id'           => 'required|exists:users,id',
            'user_receiving_id' => 'required|exists:users,id',
        ];
    }

    public function prepareData($data)
    {
        $data['amount'] *= -1;
        $data['method'] = 'Efectivo';

        return $data;
    }
}
