<?php

namespace microchip\pay;

use microchip\base\BaseManager;

class PayUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'amount'        => 'required|numeric',
            'change'        => 'required|numeric',
            'description'   => 'max:255',
            'method'        => 'required|in:Efectivo,Tarjeta de crédito/débito,Cheque,Transferencia,Nota de crédito',
            'reference'     => 'required_if:method,Tarjeta de crédito/débito,Cheque,Transferencia',
            'entity'        => 'required_if:method,Tarjeta de crédito/débito,Cheque,Transferencia',
            'user_id'       => 'required|exists:users,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        $data['sale_id']    = $this->entity->sale_id;

        $data['date']   = date('Y-m-d');

        if ($data['method'] == 'Efectivo' or $data['method'] == 'Nota de crédito') {
            $data['reference'] = '';
            $data['entity'] = '';
        }

        return $data;
    }
}
