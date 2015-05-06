<?php

namespace microchip\cheque;

use microchip\base\BaseManager;

class ChequeUpdManager extends BaseManager
{
    public function getRules()
    {
        return $rules = [
            'payment_date' => 'required|date',
            'amount'       => 'required|numeric',
            'receiver'     => 'required|max:120',
            'concept'      => 'required|max:512',
            'status'       => 'required|in:Pagado,Post-fechado,Cancelado,Elaborado',
            'observations' => 'max:510',
            'message'      => 'in:0,1',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        if (!isset($data['message'])) {
            $data['message'] = 0;
        }

        return $data;
    }
}
