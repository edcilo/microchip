<?php

namespace microchip\purchase;

use microchip\base\BaseManager;

class PurchaseUpdManager extends BaseManager
{
    public function getRules()
    {
        return [
            'folio'          => 'required',
            'date'           => 'required|date',
            'reception_date' => 'required|date',
            'iva'            => 'required|numeric',
            'provider_id'    => 'required|integer|exists:providers,id',
            'user_id'        => 'required|integer|exists:users,id',
        ];
    }
}