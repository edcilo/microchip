<?php

namespace microchip\purchasePayment;

use microchip\base\BaseManager;

class PurchasePaymentRegManager extends BaseManager
{
    public function getRules()
    {
        $rules = [
            'purchase_id'  => 'required|integer|exists:purchases,id',
            'type'         => 'required|max:255',
            'cheque_id'    => 'required_if:type,Cheque|integer',
            'method'       => 'required|in:Contado,Crédito',
            'payment_date' => 'required|date',
            'status'       => 'required|in:Pagado,Pendiente',
        ];

        if (!empty($this->data['cheque_id'])) {
            $rules['cheque_id'] .= '|exists:cheques,id';
        }

        return $rules;
    }

    public function prepareData($data)
    {
        $this->stripTags($data);

        if ($data['type'] != 'Cheque') {
            $data['cheque_id']  = 0;
        }

        return $data;
    }
}
