<?php

namespace microchip\cheque;

use microchip\base\BaseManager;

class ChequeRegManager extends BaseManager
{
    public function getRules()
    {
        return $rules = [
            'folio'        => 'required|integer|digits_between:1,8',
            'bank_id'      => 'integer|exists:banks,id',
        ];
    }

    public function prepareData($data)
    {
        $data['folio']  = str_pad($data['folio'], 7, '0', STR_PAD_LEFT);

        $data['status'] = 'Disponible';
        $data['active'] = 1;

        return $data;
    }
}
