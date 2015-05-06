<?php

namespace microchip\bankCount;

use microchip\base\BaseManager;

class BankCountRegManager extends BaseManager
{
    public function getRules()
    {
        return [
            'amount'        => 'required|numeric',
            'status'        => 'required|in:Entrada,Salida',
            'date'          => 'required|date',
            'description'   => 'max:255',
            'bank_id'       => 'required|exists:banks,id',
        ];
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        return $data;
    }
}
