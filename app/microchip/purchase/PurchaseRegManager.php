<?php namespace microchip\purchase;

use microchip\base\BaseManager;

class PurchaseRegManager extends BaseManager {

    public function getRules()
    {
        return $rules = [
            'folio'          => 'required',
            'date'           => 'required|date',
            'reception_date' => 'required|date',
            'iva'            => 'required|numeric',
            'provider_id'    => 'required|integer|exists:providers,id',
            'user_id'        => 'required|integer|exists:users,id',
        ];
    }

    public function prepareData($data)
    {
        $data['status']     = 'En proceso...';
        $data['progress_1'] = 0;
        $data['progress_2'] = 0;
        $data['progress_3'] = 1;
        $data['progress_4'] = 1;

        return $data;
    }

}