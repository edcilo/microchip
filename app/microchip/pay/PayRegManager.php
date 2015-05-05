<?php namespace microchip\pay;

use microchip\base\BaseManager;

class PayRegManager extends BaseManager {

    public function getRules()
    {
        return [
            'amount'        => 'required|numeric',
            'change'        => 'required|numeric',
            'description'   => 'max:255',
            'method'        => 'required|in:Efectivo,Tarjeta de crédito/débito,Cheque,Transferencia,Vale',
            'reference'     => 'required_if:method,Tarjeta de crédito/débito,Cheque,Transferencia',
            'entity'        => 'required_if:method,Tarjeta de crédito/débito,Cheque,Transferencia',
            'sale_id'       => 'required|exists:sales,id',
            'user_id'       => 'required|exists:users,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['change'] = ($data['amount'] > $data['total']) ? $data['amount'] - $data['total'] : 0;
        $data['date']   = date('Y-m-d');

        if ($data['method'] == 'Efectivo' OR $data['method'] == 'Vale') {
            $data['reference'] = '';
            $data['entity'] = '';
        }

        return $data;
    }

}